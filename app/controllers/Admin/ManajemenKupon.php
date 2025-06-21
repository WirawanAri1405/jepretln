<?php

class ManajemenKupon extends Controller{
    public function index(){
   $data['judul'] = 'Manajemen Kupon';
        $kupon_model = $this->model('Kupon_model');

        // Mengubah nama parameter dari 'status' menjadi 'statusFilter'
        $status_filter = $_GET['statusFilter'] ?? 'semua';
        $search_term = $_GET['search'] ?? null;

        // --- DATA UNTUK NAVBAR DAN VIEW ---
        $data['search_action'] = BASEURL . '/Admin/ManajemenKupon';
        $data['search_placeholder'] = 'Cari berdasarkan kode kupon...';
        $data['search_term'] = $search_term;
        $data['status_aktif'] = $status_filter;
        // ------------------------------------

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        // Dapatkan total hasil dan data berdasarkan FILTER dan PENCARIAN
        $total_results = $kupon_model->countAllCoupons($search_term, $status_filter);
        $total_pages = ceil($total_results / $results_per_page);
        $data['coupons'] = $kupon_model->getAllCoupons($search_term, $status_filter, $results_per_page, $offset);

        // Kirim data paginasi ke view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua bagian halaman
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenKupon/index', $data);
        $this->view('admin/manajemenKupon/form_modal', $data);
        $this->view('admin/templates/footer');
    }
        public function detail($id)
    {
         $data['judul'] = 'Detail Kupon';
        $data['kupon'] = $this->model('Kupon_model')->getKuponById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKupon/detail', $data);
        $this->view('admin/templates/footer');
    }
    public function tambah()
    {
        if ($this->model('Kupon_model')->tambahDataKupon($_POST) > 0) {
            Flasher::setFlash('Data Kupon', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Data Kupon', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKupon');
        exit;
    }
     public function hapus($id)
    {
        if ($this->model('Kupon_model')->hapusDataKupon($id) > 0) {
            Flasher::setFlash('Data Kupon', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Data Kupon', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKupon');
        exit;
    }
    public function edit($id)
    {
        $data['judul'] = 'Edit Kupon';
        $data['kupon'] = $this->model('Kupon_model')->getKuponById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar'); // Navbar tidak perlu info search di halaman edit
        $this->view('admin/manajemenKupon/edit', $data);
        $this->view('admin/templates/footer');
    }

    public function update()
    {
        // Panggil metode updateDataKupon di model
        if ($this->model('Kupon_model')->updateDataKupon($_POST) > 0) {
            Flasher::setFlash('Data Kupon', 'berhasil diubah', 'success');
        } else {
            Flasher::setFlash('Data Kupon', 'berhasil diubah (tidak ada perubahan data)', 'info');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKupon');
        exit;
    }

}