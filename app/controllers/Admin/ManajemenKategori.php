<?php

class ManajemenKategori extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Kategori';
        $kategori_model = $this->model('Kategori_model');

        // Ambil parameter pencarian dari URL
        $search_term = $_GET['search'] ?? null;

        // Data untuk view (termasuk navbar dinamis)
        $data['search_action'] = BASEURL . '/Admin/ManajemenKategori';
        $data['search_placeholder'] = 'Cari nama atau slug kategori...';
        $data['search_term'] = $search_term;
        
        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        // Ambil total data dan data per halaman dari model
        $total_results = $kategori_model->countAllKategori($search_term);
        $total_pages = ceil($total_results / $results_per_page);
        $data['kategori'] = $kategori_model->getAllKategori($search_term, $results_per_page, $offset);

        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua view
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenKategori/index', $data);
        $this->view('admin/manajemenKategori/form_modal', $data);
        $this->view('admin/templates/footer');
    }
    public function tambah()
    {
        // Membuat slug secara otomatis dari nama kategori
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        
        // Menambahkan slug ke dalam data yang akan dikirim ke model
        $data = [
            'name' => $_POST['name'],
            'slug' => $slug
        ];

        if ($this->model('Kategori_model')->tambahDataKategori($data) > 0) {
            Flasher::setFlash('Kategori', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Kategori', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
    public function hapus($id)
    {
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('Kategori', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Kategori', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
    public function detail()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/detail');
        $this->view('admin/templates/footer');
    }
    public function edit()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/edit');
        $this->view('admin/templates/footer');
    }
}
