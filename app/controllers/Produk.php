<?php

class Produk extends Controller
{

    public function detail($slug = '')
    {
        if (empty($slug)) {
            header('Location: ' . BASEURL);
            exit;
        }

        $productModel = $this->model('Product_model');
        $kategoriModel = $this->model('Kategori_model');
        $orderModel = $this->model('Order_model');

        $product = $productModel->getProdukBySlugWithImages($slug);

        if (!$product) {
            echo "Produk tidak ditemukan.";
            return;
        }
        $data['eligible_to_review'] = false;
        if (isset($_SESSION['user_id'])) {
            $completedOrderId = $orderModel->hasUserCompletedOrderForProduct($_SESSION['user_id'], $product['id']);
            if ($completedOrderId) {
                $data['eligible_to_review'] = true;
                $data['completed_order_id'] = $completedOrderId;
            }
        }

        // Ambil ulasan untuk produk ini
        $reviewModel = $this->model('Review_model');
        $data['reviews'] = $reviewModel->getReviewsByProductId($product['id']);

        $data['judul'] = htmlspecialchars($product['product_name']);
        $data['product'] = $product;
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        $this->view('templates/header', $data);
        $this->view('produk/detail', $data);
        $this->view('templates/footer');
    }

    public function ulasan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $reviewModel = $this->model('Review_model');
            $_POST['user_id'] = $_SESSION['user_id']; // Tambahkan user_id dari sesi

            if ($reviewModel->tambahUlasan($_POST) > 0) {
                Flasher::setFlash('Ulasan', 'berhasil ditambahkan.', 'success');
            } else {
                Flasher::setFlash('Ulasan', 'gagal ditambahkan.', 'danger');
            }

            // Arahkan kembali ke halaman produk sebelumnya
            $productSlug = $_POST['product_slug'] ?? '';
            header('Location: ' . BASEURL . '/produk/index/' . $productSlug);
            exit;
        } else {
            // Jika tidak login atau bukan POST, arahkan ke home
            header('Location: ' . BASEURL);
            exit;
        }
    }
}
