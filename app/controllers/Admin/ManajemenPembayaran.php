<?php

class ManajemenPembayaran extends Controller {

    public function index() {
        $data['judul'] = 'Manajemen Pembayaran';
        $paymentModel = $this->model('Payment_model');

        // Mengambil parameter filter dan pencarian dari URL
        $status_filter = $_GET['status'] ?? 'semua';
        $search_term = $_GET['search'] ?? null;

        // Data untuk view
        $data['search_action'] = BASEURL . '/Admin/ManajemenPembayaran';
        $data['search_placeholder'] = 'Cari berdasarkan No. Pesanan...';
        $data['search_term'] = $search_term;
        $data['status_aktif'] = $status_filter;
        $data['statuses'] = ['pending', 'success', 'failed', 'refunded']; // Status yang mungkin untuk filter

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Panggil model untuk mengambil data
        $total_results = $paymentModel->countAllPayments($search_term, $status_filter);
        $total_pages = ceil($total_results / $results_per_page);
        $data['payments'] = $paymentModel->getAllPayments($search_term, $status_filter, $results_per_page, $offset);

        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenPembayaran/index', $data);
        $this->view('admin/templates/footer');
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_id']) && isset($_POST['status'])) {
            $paymentModel = $this->model('Payment_model');
            if ($paymentModel->updatePaymentStatus($_POST['payment_id'], $_POST['status'])) {
                Flasher::setFlash('Status Pembayaran', 'berhasil diperbarui.', 'success');
            } else {
                Flasher::setFlash('Status Pembayaran', 'gagal diperbarui.', 'danger');
            }
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenPembayaran');
        exit;
    }
}