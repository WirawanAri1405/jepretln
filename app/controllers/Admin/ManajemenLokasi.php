<?php

class ManajemenLokasi extends Controller
{

    public function index()
    {
        // Ambil model
        $lokasi_model = $this->model('Lokasi_model');

          $lokasi_model = $this->model('Lokasi_model');

        // Ambil parameter filter dan pencarian dari URL
        $status_filter = $_GET['statusFilter'] ?? 'Semua';
        $search_term = $_GET['search'] ?? null;

        // --- DATA UNTUK NAVBAR DAN VIEW ---
        $data['search_action'] = BASEURL . '/Admin/ManajemenLokasi';
        $data['search_placeholder'] = 'Cari nama atau alamat lokasi...';
        $data['status_aktif'] = $status_filter;
        $data['search_term'] = $search_term;
        // ------------------------------------

        // --- LOGIKA PAGINASI ---
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Dapatkan total hasil berdasarkan filter DAN pencarian
        $total_results = $lokasi_model->countAllLokasi($status_filter, $search_term);
        $total_pages = ceil($total_results / $results_per_page);
        
        // Dapatkan data untuk halaman saat ini berdasarkan filter DAN pencarian
        $data['lokasi'] = $lokasi_model->getAllLokasiByStatus($status_filter, $search_term, $results_per_page, $offset);

        // Kirim data paginasi ke view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar',$data);
        $this->view('admin/manajemenLokasi/index', $data);
        $this->view('admin/manajemenLokasi/form_modal');
        $this->view('admin/templates/footer');
    }

    public function detail($id)
    {
        $data['lokasi'] = $this->model('Lokasi_model')->getLocationById($id);
        $this->view('admin/templates/header');
        $this->view('admin/manajemenLokasi/detail', $data);
        $this->view('admin/templates/footer');
    }
    public function tambah()
    {
        if ($this->model('Lokasi_model')->tambahDataLokasi($_POST) > 0) {
            // Menyiapkan pesan sukses
            Flasher::setFlash('Data Lokasi', 'berhasil ditambahkan', 'success');
        } else {
            // Menyiapkan pesan gagal
            Flasher::setFlash('Data Lokasi', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenLokasi');
        exit;
    }
    public function hapus($id){
        if ($this->model('Lokasi_model')->hapusDataLokasi($id) > 0) {
            // Menyiapkan pesan sukses
            Flasher::setFlash('Data Lokasi', 'berhasil dihapus', 'success');
        } else {
            // Menyiapkan pesan gagal
            Flasher::setFlash('Data Lokasi', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenLokasi');
        exit;
    }
        public function edit($id)
    {
        $data['judul'] = 'Edit Lokasi';
        $data['lokasi'] = $this->model('Lokasi_model')->getLocationById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenLokasi/edit', $data);
        $this->view('admin/templates/footer');
    }
    public function update()
    {
        if ($this->model('Lokasi_model')->updateDataLokasi($_POST) > 0) {
            Flasher::setFlash('Data Lokasi', 'berhasil diubah', 'success');
        } else {
            Flasher::setFlash('Data Lokasi', 'gagal diubah', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenLokasi');
        exit;
    }
}
