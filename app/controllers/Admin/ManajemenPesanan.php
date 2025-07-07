<?php

class ManajemenPesanan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Pesanan';
        $order_model = $this->model('Order_model');

        // Mengambil parameter dari URL
        $search_term = $_GET['search'] ?? null;
        $filters = [
            'status' => $_GET['status'] ?? null
        ];

        // Menyiapkan data untuk View (termasuk navbar dan form filter)
        $data['search_action'] = BASEURL . '/Admin/ManajemenPesanan';
        $data['search_placeholder'] = 'Cari berdasarkan nama pelanggan atau nomor pesanan...';
        $data['search_term'] = $search_term;
        $data['active_filters'] = $filters;

        // Mendapatkan semua kemungkinan status pesanan untuk filter
        $data['order_statuses'] = ['pending_payment', 'paid', 'ready_for_pickup', 'rented', 'returned', 'completed', 'cancelled'];

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Memanggil model untuk mendapatkan data pesanan
        $total_results = $order_model->countAllOrders($search_term, $filters);
        $total_pages = ceil($total_results / $results_per_page);
        $data['orders'] = $order_model->getAllOrders($search_term, $filters, $results_per_page, $offset);

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
        $this->view('admin/manajemenPesanan/index', $data);
        $this->view('admin/templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Pesanan';
        $order_model = $this->model('Order_model');

        $order = $order_model->getOrderById($id);

        if ($order === false) {
            Flasher::setFlash('Pesanan', 'tidak ditemukan dengan ID ' . htmlspecialchars($id), 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
            exit;
        }

        $data['order'] = $order;
        // Data status untuk dropdown di view detail
        $data['order_statuses'] = ['pending_payment', 'paid', 'ready_for_pickup', 'rented', 'returned', 'completed', 'cancelled'];


        // Memuat view
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenPesanan/detail', $data);
        $this->view('admin/templates/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_model = $this->model('Order_model');

            // Mengambil data dari form
            $orderId = $_POST['order_id'];
            $newStatus = $_POST['status'];
            $internalNotes = $_POST['internal_notes'];

            if ($order_model->updateOrderStatus($orderId, $newStatus, $internalNotes)) {
                Flasher::setFlash('Status Pesanan', 'berhasil diperbarui', 'success');
            } else {
                Flasher::setFlash('Status Pesanan', 'gagal diperbarui', 'danger');
            }
        }
        // Kembali ke halaman detail atau halaman list
        header('Location: ' . BASEURL . '/Admin/ManajemenPesanan/detail/' . $orderId);
        exit;
    }
    public function hapus($id)
    {
        // Panggil model untuk menghapus data
        if ($this->model('Order_model')->hapusDataPesanan($id) > 0) {
            // Set flash message jika berhasil
            Flasher::setFlash('Pesanan', 'berhasil dihapus', 'success');
        } else {
            // Set flash message jika gagal
            Flasher::setFlash('Pesanan', 'gagal dihapus', 'danger');
        }
        // Redirect kembali ke halaman utama manajemen pesanan
        header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
        exit;
    }
}
