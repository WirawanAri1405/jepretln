<?php

class ManajemenFAQ extends Controller{
    public function index()
    {
        $data['judul'] = 'Manajemen FAQ';
        $faq_model = $this->model('FAQ_model');

        // Mengubah 'status' menjadi 'statusFilter' agar sesuai dengan form baru
        $status_filter = $_GET['statusFilter'] ?? 'semua';
        $search_term = $_GET['search'] ?? null;

        // Data untuk view
        $data['search_action'] = BASEURL . '/Admin/ManajemenFAQ';
        $data['search_placeholder'] = 'Cari pertanyaan atau jawaban...';
        $data['search_term'] = $search_term;
        $data['status_aktif'] = $status_filter; // Tetap 'status_aktif' untuk konsistensi

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        // Panggil model dengan parameter yang sudah diperbarui
        $total_results = $faq_model->countAllFAQs($search_term, $status_filter);
        $total_pages = ceil($total_results / $results_per_page);
        $data['faqs'] = $faq_model->getAllFAQs($search_term, $status_filter, $results_per_page, $offset);

        // ... sisa kode untuk paginasi dan memuat view tidak berubah ...
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenFAQ/index', $data);
        $this->view('admin/manajemenFAQ/form_modal', $data);
        $this->view('admin/templates/footer');
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail FAQ';
        $data['faq'] = $this->model('FAQ_model')->getFAQById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/manajemenFAQ/detail', $data);
        $this->view('admin/templates/footer');
    }
    public function tambah()
    {
        if ($this->model('FAQ_model')->tambahDataFAQ($_POST) > 0) {
            Flasher::setFlash('FAQ', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('FAQ', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenFAQ');
        exit;
    }
    public function hapus($id)
    {
        if ($this->model('FAQ_model')->hapusDataFAQ($id) > 0) {
            Flasher::setFlash('FAQ', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('FAQ', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenFAQ');
        exit;
    }
}