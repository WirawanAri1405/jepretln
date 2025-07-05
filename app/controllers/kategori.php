<?php

class Kategori extends Controller {

    public function index($kategoriSlug = '') {
        // 1. Validasi Awal
        if (empty($kategoriSlug)) {
            header('Location: ' . BASEURL);
            exit;
        }

        // 2. Memuat Model
        $productModel = $this->model('Product_model');
        $kategoriModel = $this->model('Kategori_model'); 

        // 3. Mengambil Data Kategori
        $kategori = $kategoriModel->getCategoryBySlug($kategoriSlug);

        if (!$kategori) {
            echo "Kategori tidak ditemukan.";
            return;
        }
        
        // --- AWAL LOGIKA PAGINASI PRODUK ---
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products_per_page = 12; // Tampilkan 12 produk per halaman
        $offset = ($page - 1) * $products_per_page;
        
        $filters = ['category_id' => $kategori['id']];

        // Menghitung total produk dalam kategori ini untuk paginasi
        $total_products = $productModel->countAllProducts(null, $filters);
        $total_pages = ceil($total_products / $products_per_page);
        
        // Mengambil produk untuk halaman saat ini saja
        $productsData = $productModel->getAllProducts(null, $filters, $products_per_page, $offset);
        
        $products = [];
        foreach ($productsData as $p) {
            $products[] = $productModel->getProdukByIdWithImages($p['id']);
        }
        // --- AKHIR LOGIKA PAGINASI PRODUK ---

        // 5. Menyiapkan Data untuk View
        $data['judul'] = 'Kategori: ' . htmlspecialchars($kategori['name']);
        $data['kategori'] = $kategori;
        $data['products'] = $products;
        
        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;

        // Data untuk navigasi header
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        // 6. Memuat View
        $this->view('templates/header', $data);
        $this->view('kategori/index', $data); 
        $this->view('templates/footer');
    }
}