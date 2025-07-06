<?php

class Checkout extends Controller {

    public function index($productSlug = '') {
        // Keamanan: Hanya user yang login bisa checkout
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Gagal', 'Anda harus login untuk melanjutkan.', 'danger');
            header('Location: ' . BASEURL . '/users/login');
            exit;
        }

        if (empty($productSlug)) {
            header('Location: ' . BASEURL);
            exit;
        }

        // Memuat model yang dibutuhkan
        $productModel = $this->model('Product_model');
        $locationModel = $this->model('Lokasi_model');
        $kategoriModel = $this->model('Kategori_model');

        // Ambil data produk yang akan dicheckout
        $product = $productModel->getProdukBySlugWithImages($productSlug);

        if (!$product) {
            echo "Produk tidak ditemukan.";
            exit;
        }

        // Menyiapkan data untuk view
        $data['judul'] = 'Checkout';
        $data['product'] = $product;
        $data['locations'] = $locationModel->getAllLocation(); // Ambil semua lokasi
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        $this->view('templates/header', $data);
        $this->view('checkout/index', $data); // View baru untuk checkout
        $this->view('templates/footer');
    }
}