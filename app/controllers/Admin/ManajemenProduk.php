<?php

class ManajemenProduk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Produk';
        $product_model = $this->model('Product_model');

        // Mengambil parameter dari URL (Cukup sekali)
        $search_term = $_GET['search'] ?? null;
        $filters = [
            'brand_id' => $_GET['brand_id'] ?? null,
            'category_id' => $_GET['category_id'] ?? null
        ];

        // Menyiapkan data untuk View (termasuk navbar dan form filter)
        $data['search_action'] = BASEURL . '/Admin/ManajemenProduk';
        $data['search_placeholder'] = 'Cari produk...';
        $data['search_term'] = $search_term;
        $data['active_filters'] = $filters;

        // Mengambil data untuk pilihan filter
        $data['brands'] = $product_model->getAllBrands();
        $data['categories'] = $product_model->getAllCategories();

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Memanggil model dengan parameter yang benar
        $total_results = $product_model->countAllProducts($search_term, $filters);
        $total_pages = ceil($total_results / $results_per_page);
        $data['products'] = $product_model->getAllProducts($search_term, $filters, $results_per_page, $offset);

        // Menyiapkan data paginasi untuk View
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua View
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenProduk/index', $data);
        $this->view('admin/manajemenProduk/form_modal', $data);
        $this->view('admin/templates/footer');
    }


     private function uploadMultipleImages()
    {
        // Pastikan ada file yang dikirim
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            Flasher::setFlash('Upload Gagal', 'Anda harus memilih setidaknya satu gambar.', 'danger');
            return false;
        }

        $uploadedFiles = [];
        $files = $_FILES['images'];
        $fileCount = count($files['name']);
        $uploadPath = dirname(__DIR__, 3) . '/public/assets/produk/';

        // Pastikan direktori tujuan ada, jika tidak, coba buat
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        for ($i = 0; $i < $fileCount; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue; // Lewati jika ada error pada file ini
            }

            $tmpName = $files['tmp_name'][$i];
            $namaFile = $files['name'][$i];

            // Validasi Ekstensi
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                Flasher::setFlash('Upload Gagal', "Format file '$namaFile' tidak didukung (hanya JPG, JPEG, PNG).", 'danger');
                return false;
            }

            // Generate nama unik untuk file
            $namaFileBaru = uniqid('produk-', true) . '.' . $ekstensiGambar;

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($tmpName, $uploadPath . $namaFileBaru)) {
                $uploadedFiles[] = $namaFileBaru;
            } else {
                Flasher::setFlash('Upload Gagal', "Gagal memindahkan file '$namaFile'.", 'danger');
                return false;
            }
        }
        return $uploadedFiles;
    }

    /**
     * Memproses data dari form tambah produk.
     */
    public function tambah()
    {
        // 1. Proses upload semua gambar
        $uploadedImages = $this->uploadMultipleImages();

        // 2. Jika upload gagal, hentikan proses dan kembali
        if ($uploadedImages === false) {
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }

        // 3. Siapkan semua data untuk dikirim ke model
        $data = [
            'name' => $_POST['name'],
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']))),
            'category_id' => $_POST['category_id'],
            'brand_id' => $_POST['brand_id'],
            'daily_rental_price' => $_POST['daily_rental_price'],
            'stock_quantity' => $_POST['stock_quantity'],
            'description' => $_POST['description'],
            'images' => $uploadedImages // Array berisi nama-nama file yang berhasil di-upload
        ];

        // 4. Panggil model untuk menyimpan data ke database
        if ($this->model('Product_model')->tambahProduk($data) > 0) {
            Flasher::setFlash('Produk', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal ditambahkan ke database', 'danger');
        }
        
        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }

    public function hapus($id)
    {
        if ($this->model('Product_model')->hapusDataProduk($id) > 0) {
            Flasher::setFlash('Produk', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }

    // Anda bisa menambahkan method 'detail($id)', 'edit($id)', dan 'update()' di sini
    public function detail($id)
    {
        $data['judul'] = 'Detail Produk';
        $data['product'] = $this->model('Product_model')->getProductById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenProduk/detail', $data); // Memuat view detail
        $this->view('admin/templates/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Produk';
        $product_model = $this->model('Product_model');

        // Mengambil data spesifik produk untuk di-passing ke form
        $data['product'] = $product_model->getProductById($id);

        // Mengambil semua kategori dan merek untuk mengisi dropdown
        $data['categories'] = $product_model->getAllCategories();
        $data['brands'] = $product_model->getAllBrands();

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenProduk/edit', $data); // Memuat view edit
        $this->view('admin/templates/footer');
    }

    // Ganti method update lama Anda dengan yang ini
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Panggil model untuk mencoba mengubah data
            $result = $this->model('Product_model')->ubahDataProduk($_POST);

            if ($result === false) {
                // Ini terjadi jika validasi JSON di model gagal
                Flasher::setFlash('Produk', 'gagal diperbarui. Format JSON pada spesifikasi tidak valid.', 'danger');
                // Redirect KEMBALI ke halaman edit, bukan ke index, agar user bisa memperbaiki
                header('Location: ' . BASEURL . '/Admin/ManajemenProduk/edit/' . $_POST['id']);
                exit;
            } elseif ($result > 0) {
                // Jika berhasil (ada baris yang ter-update)
                Flasher::setFlash('Produk', 'berhasil diperbarui', 'success');
                header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
                exit;
            } else {
                // Jika tidak ada yang berubah (user klik simpan tanpa mengubah apapun)
                Flasher::setFlash('Produk', 'tidak ada perubahan data.', 'info');
                header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
                exit;
            }
        }
    }
}
