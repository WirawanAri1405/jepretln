<?php

class Kategori extends Controller {

    public function index($kategoriSlug = '') {
        // 1. Validasi Awal
        if (empty($kategoriSlug)) {
            header('Location: ' . BASEURL);
            exit;
        }

        // 2. Memuat Model yang Diperlukan
        $productModel = $this->model('Product_model');
        $kategoriModel = $this->model('Kategori_model'); 

        // 3. Mengambil Data Kategori dari Database berdasarkan slug
        $kategori = $kategoriModel->getCategoryBySlug($kategoriSlug);

        if (!$kategori) {
            echo "Kategori tidak ditemukan.";
            return;
        }

        // 4. Mengambil Data Produk Berdasarkan ID Kategori
        $filters = ['category_id' => $kategori['id']];
        // Mengambil semua gambar dengan memanggil fungsi getProdukByIdWithImages untuk setiap produk
        $productsData = $productModel->getAllProducts(null, $filters, 999, 0);
        $products = [];
        foreach ($productsData as $p) {
            $products[] = $productModel->getProdukByIdWithImages($p['id']);
        }

        // 5. Menyiapkan Data untuk View
        $data['judul'] = 'Kategori: ' . htmlspecialchars($kategori['name']);
        $data['kategori'] = $kategori;
        $data['products'] = $products;

        // !!! TAMBAHAN: Ambil data untuk navigasi header !!!
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        // 6. Memuat View
        $this->view('templates/header', $data);
        $this->view('kategori/index', $data); 
        $this->view('templates/footer');
    }
}