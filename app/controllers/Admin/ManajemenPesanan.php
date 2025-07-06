<?php

class ManajemenPesanan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Pesanan';
        $orderModel = $this->model('Order_model');

        // Mengambil parameter filter dan pencarian dari URL
        $searchTerm = $_GET['search'] ?? null;
        $filters = [
            'status' => $_GET['status'] ?? 'semua',
        ];

        // Menyiapkan data untuk view (agar nilai filter dan pencarian tetap ada)
        $data['search_action'] = BASEURL . '/Admin/ManajemenPesanan';
        $data['search_placeholder'] = 'Cari No. Pesanan atau Nama Pelanggan...';
        $data['search_term'] = $searchTerm;
        $data['active_filters'] = $filters;
        $data['statuses'] = $orderModel->getPossibleStatuses(); // Mengambil daftar status dari model

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10; // Jumlah pesanan per halaman
        $offset = ($page - 1) * $results_per_page;

        // Mengambil data pesanan dari model
        $total_results = $orderModel->countAllOrders($searchTerm, $filters);
        $total_pages = ceil($total_results / $results_per_page);
        $data['orders'] = $orderModel->getAllOrders($searchTerm, $filters, $results_per_page, $offset);

        // Mengirim data paginasi ke view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua view yang diperlukan
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data); // Navbar membutuhkan data pencarian
        $this->view('admin/manajemenPesanan/index', $data);
        $this->view('admin/manajemenPesanan/form_modal', $data);
        $this->view('admin/templates/footer');
    }


    public function detail($id = 0)
    {
        if ($id == 0) {
            header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
            exit;
        }

        $orderModel = $this->model('Order_model');
        $data['order'] = $orderModel->getOrderById($id);

        if (!$data['order']) {
            Flasher::setFlash('Error', 'Pesanan tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
            exit;
        }

        $data['judul'] = 'Detail Pesanan ' . $data['order']['order_number'];
        $data['items'] = $orderModel->getOrderItemsByOrderId($id); // Ambil item-item pesanan

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPesanan/detail', $data);
        $this->view('admin/templates/footer');
    }

    public function edit($id = 0)
    {
        if ($id == 0) {
            header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
            exit;
        }

        $orderModel = $this->model('Order_model');
        $data['order'] = $orderModel->getOrderById($id);

        if (!$data['order']) {
            Flasher::setFlash('Error', 'Pesanan tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
            exit;
        }

        $data['judul'] = 'Edit Pesanan ' . $data['order']['order_number'];
        $data['statuses'] = $orderModel->getPossibleStatuses();
        $data['locations'] = $this->model('Lokasi_model')->getAllLocation();

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPesanan/edit', $data);
        $this->view('admin/templates/footer');
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderModel = $this->model('Order_model');
            // Cek apakah update berhasil atau tidak ada perubahan (>= 0)
            if ($orderModel->updateOrder($_POST) >= 0) {
                Flasher::setFlash('Pesanan', 'berhasil diperbarui.', 'success');
                header('Location: ' . BASEURL . '/Admin/ManajemenPesanan/detail/' . $_POST['id']);
                exit;
            }
        }
        Flasher::setFlash('Gagal', 'Pesanan gagal diperbarui.', 'danger');
        header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
        exit;
    }
        public function updateStatus()
    {
        // Pastikan ini adalah request POST dan data yang dibutuhkan ada
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
            $orderModel = $this->model('Order_model');
            
            // Panggil method di model untuk update status
            $success = $orderModel->updateOrderStatus($_POST['order_id'], $_POST['status']);
            
            if ($success) {
                Flasher::setFlash('Status Pesanan', 'berhasil diperbarui.', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Status pesanan gagal diperbarui atau tidak ada perubahan.', 'info');
            }
        }
        
        // Arahkan kembali ke halaman daftar pesanan
        header('Location: ' . BASEURL . '/Admin/ManajemenPesanan');
        exit;
    }
}
