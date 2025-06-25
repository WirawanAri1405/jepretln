<?php

class ManajemenMerek extends Controller
{
   // Menampilkan halaman utama dengan daftar merek
    public function index()
    {
        $data['judul'] = 'Manajemen Merek';
        $merek_model = $this->model('Merek_model');

        $search_term = $_GET['search'] ?? null;
        $data['search_action'] = BASEURL . '/Admin/ManajemenMerek';
        $data['search_placeholder'] = 'Cari nama atau slug merek...';
        $data['search_term'] = $search_term;
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        $total_results = $merek_model->countAllMerek($search_term);
        $total_pages = ceil($total_results / $results_per_page);
        $data['merek'] = $merek_model->getAllMerek($search_term, $results_per_page, $offset);

        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenMerek/index', $data);
        $this->view('admin/manajemenMerek/form_modal', $data);
        $this->view('admin/templates/footer');
    }

    // Memproses penambahan data merek baru
    public function tambah()
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        $data = ['name' => $_POST['name'], 'slug' => $slug];

        if ($this->model('Merek_model')->tambahDataMerek($data) > 0) {
            Flasher::setFlash('Merek', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Merek', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenMerek');
        exit;
    }

    // Memproses penghapusan data merek
    public function hapus($id)
    {
        if ($this->model('Merek_model')->hapusDataMerek($id) > 0) {
            Flasher::setFlash('Merek', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Merek', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenMerek');
        exit;
    }

    // Menampilkan halaman form edit
    public function edit($id)
    {
        $data['judul'] = 'Edit Merek';
        $data['merek'] = $this->model('Merek_model')->getMerekById($id);
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenMerek/edit', $data);
        $this->view('admin/templates/footer');
    }

    // Memproses pembaruan data merek
    public function update()
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        $data = ['id' => $_POST['id'], 'name' => $_POST['name'], 'slug' => $slug];
        
        if ($this->model('Merek_model')->updateDataMerek($data) > 0) {
            Flasher::setFlash('Merek', 'berhasil diubah', 'success');
        } else {
            Flasher::setFlash('Merek', 'gagal diubah', 'info');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenMerek');
        exit;
    }
    public function detail()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenMerek/detail');
        $this->view('admin/templates/footer');
    }
}
