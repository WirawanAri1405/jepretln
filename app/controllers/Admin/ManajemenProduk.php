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

    public function tambah()
    {
        // 1. Ambil model dan buat slug terlebih dahulu
        $product_model = $this->model('Product_model');
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));

        // 2. Cek apakah slug sudah ada di database
        if ($product_model->isSlugExists($slug)) {
            // Jika slug sudah ada, kirim pesan error dan redirect kembali
            Flasher::setFlash('Produk', 'gagal ditambahkan. Nama produk sudah digunakan (slug duplikat).', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }

        // 3. Jika slug unik, baru lanjutkan proses penambahan data

        // Encode spesifikasi (jika ada)
        if (isset($_POST['specifications']) && is_array($_POST['specifications'])) {
            $_POST['specifications'] = json_encode($_POST['specifications']);
        } else {
            $_POST['specifications'] = null;
        }

        // Panggil model untuk menambah data. Kita tidak perlu mengirim slug lagi karena model akan membuatnya sendiri.
        if ($this->model('Product_model')->tambahDataProduk($_POST) > 0) {
            Flasher::setFlash('Produk', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal ditambahkan karena kesalahan teknis.', 'danger');
        }

        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Cek dan encode data spesifikasi, sama seperti di fungsi tambah()
            if (isset($_POST['specifications']) && is_array($_POST['specifications'])) {
                $_POST['specifications'] = json_encode($_POST['specifications']);
            } else {
                $_POST['specifications'] = null;
            }

            $result = $this->model('Product_model')->ubahDataProduk($_POST);

            if ($result > 0) {
                Flasher::setFlash('Produk', 'berhasil diperbarui', 'success');
            } else {
                Flasher::setFlash('Produk', 'tidak ada perubahan data.', 'info');
            }
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }
    }
}
