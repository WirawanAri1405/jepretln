<?php

class Payment extends Controller {

    public function index($orderId = 0) {
        // Keamanan: Pastikan user login dan orderId ada
        if (!isset($_SESSION['user_id']) || $orderId == 0) {
            header('Location: ' . BASEURL);
            exit;
        }

        $orderModel = $this->model('Order_model');
        $kategoriModel = $this->model('Kategori_model');

        // Ambil detail pesanan
        $order = $orderModel->getOrderById($orderId);

        // Pastikan pesanan itu milik user yang sedang login
        if (!$order || $order['user_id'] != $_SESSION['user_id']) {
            Flasher::setFlash('Error', 'Pesanan tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/Users/profile/orders');
            exit;
        }

        $data['judul'] = 'Pembayaran';
        $data['order'] = $order;
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        $this->view('templates/header', $data);
        $this->view('payment/index', $data); // View baru untuk pembayaran
        $this->view('templates/footer');
    }
}