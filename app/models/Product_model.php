<?php

class Product_model
{
    private $table = 'products';
    private $tabelProduk = 'products';
    private $tabelGambar = 'product_images';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Mengambil semua produk dengan filter, paginasi, dan join ke tabel lain.
     */
    public function getAllProducts($searchTerm = null, $filters = [], $limit = 10, $offset = 0)
    {
        $bindings = [];
        // SELECT clause dengan alias untuk nama kategori dan merek
        $sql = "SELECT 
                    products.*, 
                    categories.name AS category_name, 
                    brands.name AS brand_name 
                FROM " . $this->table . "
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN brands ON products.brand_id = brands.id";

        $whereClause = $this->buildWhereClause($searchTerm, $filters, $bindings);
        $sql .= $whereClause;

        $sql .= " ORDER BY products.id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($sql);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->resultSet();
    }

    /**
     * Menghitung total produk berdasarkan filter.
     */
    public function countAllProducts($searchTerm = null, $filters = [])
    {
        $bindings = [];
        $sql = "SELECT COUNT(products.id) as total 
                FROM " . $this->table . "
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN brands ON products.brand_id = brands.id";

        $whereClause = $this->buildWhereClause($searchTerm, $filters, $bindings);
        $sql .= $whereClause;

        $this->db->query($sql);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->single()['total'];
    }

    /**
     * Helper untuk membangun klausa WHERE secara dinamis.
     */
    private function buildWhereClause($searchTerm, $filters, &$bindings)
    {
        $conditions = [];
        if (!empty($searchTerm)) {
            $conditions[] = "(products.name LIKE :searchTerm OR products.description LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if (!empty($filters['brand_id'])) {
            $conditions[] = "products.brand_id = :brand_id";
            $bindings['brand_id'] = ['value' => $filters['brand_id'], 'type' => PDO::PARAM_INT];
        }

        if (!empty($filters['category_id'])) {
            $conditions[] = "products.category_id = :category_id";
            $bindings['category_id'] = ['value' => $filters['category_id'], 'type' => PDO::PARAM_INT];
        }

        return empty($conditions) ? "" : " WHERE " . implode(' AND ', $conditions);
    }

    public function getProdukByIdWithImages($id)
    {
        // Query Pertama: Ambil data utama produk dengan JOIN
        $queryProduk = "SELECT 
                            p.id, p.name as product_name, p.slug, p.description, 
                            p.specifications, p.stock_quantity, p.daily_rental_price,
                            c.name as category_name, c.spec_template,
                            b.name as brand_name,
                            p.category_id, p.brand_id
                        FROM " . $this->table . " p 
                        LEFT JOIN categories c ON p.category_id = c.id
                        LEFT JOIN brands b ON p.brand_id = b.id
                        WHERE p.id = :id";

        $this->db->query($queryProduk);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $produk = $this->db->single();

        // Jika produk tidak ditemukan, langsung kembalikan false
        if ($produk === false) {
            return false;
        }

        // Query Kedua: Ambil semua gambar untuk produk tersebut
        $queryImages = "SELECT id, image_path, is_primary 
                        FROM product_images 
                        WHERE product_id = :product_id 
                        ORDER BY is_primary DESC, id ASC";
        $this->db->query($queryImages);
        $this->db->bind('product_id', $id, PDO::PARAM_INT);

        // Gabungkan hasil query gambar ke dalam array produk
        $produk['images'] = $this->db->resultSet();

        return $produk;
    }



    // Menggunakan satu versi 'tambahDataProduk' yang sudah diperbaiki
    public function tambahProduk($data)
    {
        $this->db->beginTransaction();
        try {
            // --- PERBAIKAN UTAMA ADA DI QUERY INI ---
            // Pastikan semua kolom dari form ada di sini
            $queryProduk = "INSERT INTO " . $this->table . " 
                            (name, slug, description, specifications, stock_quantity, daily_rental_price, category_id, brand_id, status) 
                            VALUES 
                            (:name, :slug, :description, :specifications, :stock_quantity, :daily_rental_price, :category_id, :brand_id, 'available')";

            $this->db->query($queryProduk);

            // --- DAN DI PROSES BINDING INI ---
            $this->db->bind('name', $data['name']);
            $this->db->bind('slug', $data['slug']);
            $this->db->bind('description', $data['description']);
            $this->db->bind('specifications', $data['specifications']);
            $this->db->bind('stock_quantity', $data['stock_quantity']);
            $this->db->bind('daily_rental_price', $data['daily_rental_price']);
            $this->db->bind('category_id', $data['category_id']);
            $this->db->bind('brand_id', $data['brand_id']);

            $this->db->execute();

            $productId = $this->db->lastInsertId();
            if (!$productId) {
                throw new \Exception("Gagal mendapatkan ID produk yang baru.");
            }

            // Proses penyimpanan gambar (kode ini sudah benar dan tidak perlu diubah)
            if (!empty($data['images']) && is_array($data['images'])) {
                $queryGambar = "INSERT INTO product_images (product_id, image_path, is_primary) 
                                VALUES (:product_id, :image_path, :is_primary)";

                foreach ($data['images'] as $index => $imageName) {
                    $this->db->query($queryGambar);
                    $this->db->bind('product_id', $productId);
                    $this->db->bind('image_path', $imageName);
                    $this->db->bind('is_primary', ($index === 0) ? 1 : 0, PDO::PARAM_INT);
                    $this->db->execute();
                }
            }

            $this->db->commit();
            return 1;
        } catch (\Exception $e) {
            $this->db->rollBack();
            // Untuk debugging, Anda bisa melihat error pastinya di log PHP
            error_log("Error di tambahDataProduk: " . $e->getMessage());
            return 0;
        }
    }
    public function getGambarByProdukId($id)
    {
        $this->db->query("SELECT * FROM {$this->tabelGambar} WHERE product_id = :id");
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    /**
     * Menghapus data produk.
     */
    public function hapusDataProduk($id)
    {
        $query = "DELETE FROM {$this->tabelProduk} WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Fungsi tambahan untuk mengisi dropdown di form
    public function getAllBrands()
    {
        $this->db->query("SELECT id, name FROM brands ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function getAllCategories()
    {
        // Tambahkan spec_template ke dalam query SELECT
        $this->db->query("SELECT id, name, spec_template FROM categories ORDER BY name ASC");
        return $this->db->resultSet();
    }
    // Menggunakan satu versi 'ubahDataProduk' yang sudah diperbaiki
    public function ubahDataProduk($data)
    {
        if (!empty($data['specifications'])) {
            json_decode($data['specifications']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
        }

        $query = "UPDATE products SET name = :name, slug = :slug, description = :description, specifications = :specifications, stock_quantity = :stock_quantity, daily_rental_price = :daily_rental_price, category_id = :category_id, brand_id = :brand_id, status = :status WHERE id = :id";
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'])));

        $this->db->query($query);
        // ... (binding semua data)
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('name', $data['name']);
        $this->db->bind('slug', $slug);
        $this->db->bind('description', $data['description']);
        $this->db->bind('specifications', $data['specifications']);
        $this->db->bind('stock_quantity', $data['stock_quantity'], PDO::PARAM_INT);
        $this->db->bind('daily_rental_price', $data['daily_rental_price']);
        $this->db->bind('category_id', $data['category_id'], PDO::PARAM_INT);
        $this->db->bind('brand_id', $data['brand_id'], PDO::PARAM_INT);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getGambarById($id)
    {
        $this->db->query("SELECT * FROM product_images WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function hapusGambarById($id)
    {
        $this->db->query("DELETE FROM product_images WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateDataProduk($data)
    {
        $this->db->beginTransaction();
        try {
            // 1. Update data utama di tabel 'products'
            $queryProduk = "UPDATE {$this->tabelProduk} SET 
                                name = :name, 
                                slug = :slug, 
                                description = :description, 
                                specifications = :specifications, 
                                stock_quantity = :stock_quantity, 
                                daily_rental_price = :daily_rental_price, 
                                category_id = :category_id, 
                                brand_id = :brand_id
                            WHERE id = :id";

            $this->db->query($queryProduk);
            $this->db->bind('id', $data['id']);
            $this->db->bind('name', $data['name']);
            $this->db->bind('slug', $data['slug']);
            $this->db->bind('description', $data['description']);
            $this->db->bind('specifications', $data['specifications']);
            $this->db->bind('stock_quantity', $data['stock_quantity']);
            $this->db->bind('daily_rental_price', $data['daily_rental_price']);
            $this->db->bind('category_id', $data['category_id']);
            $this->db->bind('brand_id', $data['brand_id']);
            $this->db->execute();

            // 2. Tambahkan gambar baru jika ada yang di-upload
            if (!empty($data['new_images']) && is_array($data['new_images'])) {
                // Cek dulu apakah sudah ada gambar utama untuk produk ini
                $queryCekUtama = "SELECT COUNT(id) as total FROM {$this->tabelGambar} WHERE product_id = :id AND is_primary = 1";
                $this->db->query($queryCekUtama);
                $this->db->bind('id', $data['id']);
                $hasPrimary = $this->db->single()['total'] > 0;

                $queryGambar = "INSERT INTO {$this->tabelGambar} (product_id, image_path, is_primary) VALUES (:pid, :path, :primary)";
                foreach ($data['new_images'] as $imageName) {
                    $this->db->query($queryGambar);
                    $this->db->bind('pid', $data['id']);
                    $this->db->bind('path', $imageName);
                    // Jadikan gambar baru sebagai utama HANYA jika belum ada gambar utama sebelumnya
                    $this->db->bind('primary', !$hasPrimary ? 1 : 0);
                    $this->db->execute();
                    $hasPrimary = true; // Set agar gambar berikutnya tidak menjadi utama
                }
            }

            $this->db->commit();
            return $this->db->rowCount();
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Error di updateDataProduk: " . $e->getMessage());
            return 0;
        }
    }
    public function getProdukBySlugWithImages($slug)
    {
        $queryProduk = "SELECT 
                        p.id, p.name as product_name, p.slug, p.description, 
                        p.specifications, p.stock_quantity, p.daily_rental_price,
                        c.name as category_name, c.spec_template,
                        b.name as brand_name,
                        p.category_id, p.brand_id
                    FROM " . $this->tabelProduk . " p 
                    LEFT JOIN categories c ON p.category_id = c.id
                    LEFT JOIN brands b ON p.brand_id = b.id
                    WHERE p.slug = :slug";

        $this->db->query($queryProduk);
        $this->db->bind('slug', $slug);
        $produk = $this->db->single();

        if ($produk == false) {
            return false;
        }

        $queryImages = "SELECT id, image_path, is_primary 
                    FROM product_images 
                    WHERE product_id = :product_id 
                    ORDER BY is_primary DESC, id ASC";
        $this->db->query($queryImages);
        $this->db->bind('product_id', $produk['id']);

        $produk['images'] = $this->db->resultSet();

        return $produk;
    }
}
