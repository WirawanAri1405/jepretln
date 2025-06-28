<?php

class Product_model
{
    private $table = 'products';
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

    /**
     * Mengambil detail satu produk berdasarkan ID.
     */
    public function getProductById($id)
    {
        // Query ini mengambil semua data yang dibutuhkan untuk halaman detail dan edit
        $query = "SELECT 
                    p.*, 
                    c.name AS category_name, 
                    b.name AS brand_name
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id
                  LEFT JOIN brands b ON p.brand_id = b.id
                  WHERE p.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function isSlugExists($slug, $excludeId = null)
    {
        $query = "SELECT id FROM " . $this->table . " WHERE slug = :slug";
        if ($excludeId !== null) {
            $query .= " AND id != :excludeId";
        }

        $this->db->query($query);
        $this->db->bind('slug', $slug);
        if ($excludeId !== null) {
            $this->db->bind('excludeId', $excludeId, PDO::PARAM_INT);
        }

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function tambahDataProduk($data)
    {
        // ... (kode fungsi tambahDataProduk Anda tidak perlu diubah) ...
        // Pastikan di dalam fungsi ini ada pembuatan slug
        $query = "INSERT INTO products (name, slug, description, specifications, stock_quantity, daily_rental_price, category_id, brand_id, status) VALUES (:name, :slug, :description, :specifications, :stock_quantity, :daily_rental_price, :category_id, :brand_id, :status)";

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'])));

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('slug', $slug); // slug dibuat di sini
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

    /**
     * Menghapus data produk.
     */
    public function hapusDataProduk($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
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
}
