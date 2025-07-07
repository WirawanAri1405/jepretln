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
        public function chooseMethod() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $paymentModel = $this->model('Payment_model');
        $orderId = $_POST['order_id'];
        $paymentMethod = $_POST['payment_method'];

        // Panggil model untuk update metode pembayaran di database
        $paymentId = $paymentModel->getPaymentByOrderId($orderId)['id'] ?? null;
        if ($paymentId) {
            $paymentModel->updatePaymentMethod($paymentId, $paymentMethod);
            
            // Arahkan ke halaman sukses dengan ID pesanan
            header('Location: ' . BASEURL . '/payment/success/' . $orderId);
            exit;
        } else {
            Flasher::setFlash('Error', 'Gagal menemukan data pembayaran untuk pesanan ini.', 'danger');
            header('Location: ' . BASEURL . '/Users/profile/orders');
            exit;
        }
    }

    /**
     * Method baru untuk menampilkan halaman konfirmasi akhir.
     */
    public function success($orderId = 0) {
        if (!isset($_SESSION['user_id']) || $orderId == 0) {
            header('Location: ' . BASEURL);
            exit;
        }
        
        $orderModel = $this->model('Order_model');
        $data['order'] = $orderModel->getOrderById($orderId);

        if (!$data['order'] || $data['order']['user_id'] != $_SESSION['user_id']) {
            Flasher::setFlash('Error', 'Pesanan tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/Users/profile/orders');
            exit;
        }

        $data['judul'] = 'Konfirmasi Pembayaran';
        $kategoriModel = $this->model('Kategori_model');
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0);

        $this->view('templates/header', $data);
        $this->view('payment/success', $data); // View baru untuk halaman sukses
        $this->view('templates/footer');
    }
}