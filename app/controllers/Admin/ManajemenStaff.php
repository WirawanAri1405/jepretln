<?php

class ManajemenStaff extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Staff';
        $staff_model = $this->model('Staff_model');

        // Ambil parameter dari URL
        $search_term = $_GET['search'] ?? null;
        $role_filter = $_GET['roleFilter'] ?? 'semua';

        // Data untuk view
        $data['search_action'] = BASEURL . '/Admin/ManajemenStaff';
        $data['search_placeholder'] = 'Cari nama atau email staff...';
        $data['search_term'] = $search_term;
        $data['role_aktif'] = $role_filter;
        $data['roles'] = $staff_model->getStaffRoles(); // Untuk mengisi dropdown filter

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Ambil data dari model
        $total_results = $staff_model->countAllStaff($search_term, $role_filter);
        $total_pages = ceil($total_results / $results_per_page);
        $data['staff'] = $staff_model->getAllStaff($search_term, $role_filter, $results_per_page, $offset);

        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat view
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenStaff/index', $data);
        $this->view('admin/manajemenStaff/form_modal', $data);
        $this->view('admin/templates/footer');
    }
    public function tambah()
    {
        // Cek jika data yang dikirim tidak kosong
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            // Hashing password untuk keamanan
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if ($this->model('Staff_model')->tambahDataStaff($_POST) > 0) {
                Flasher::setFlash('Staff', 'berhasil ditambahkan', 'success');
            } else {
                Flasher::setFlash('Staff', 'gagal ditambahkan', 'danger');
            }
        } else {
            Flasher::setFlash('Gagal', 'semua field wajib diisi', 'danger');
        }

        header('Location: ' . BASEURL . '/Admin/ManajemenStaff');
        exit;
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail Staff';
        $data['staff'] = $this->model('Staff_model')->getStaffById($id);

        if (!$data['staff']) {
            Flasher::setFlash('Staff', 'tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenStaff');
            exit;
        }

        $this->view('admin/templates/header', $data);
        $this->view('admin/manajemenStaff/detail', $data);
        $this->view('admin/templates/footer');
    }
        public function edit($id)
    {
        $data['judul'] = 'Edit Staff';
        $staff_model = $this->model('Staff_model');
        
        // Ambil data staff yang akan diedit
        $data['staff'] = $staff_model->getStaffById($id);
        if (!$data['staff']) {
            Flasher::setFlash('Staff', 'tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenStaff');
            exit;
        }

        // Ambil daftar peran/jabatan untuk dropdown
        $data['roles'] = $staff_model->getStaffRoles();

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenStaff/edit', $data);
        $this->view('admin/templates/footer');
    }

    public function update()
    {
        // Cek jika ada password baru yang dimasukkan
        if (!empty($_POST['password'])) {
            // Jika ada, hash password baru
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            // Jika tidak, jangan sertakan kolom password dalam update
            unset($_POST['password']);
        }
        
        if ($this->model('Staff_model')->updateDataStaff($_POST) >= 0) {
            Flasher::setFlash('Staff', 'berhasil diupdate', 'success');
        } else {
            Flasher::setFlash('Staff', 'gagal diupdate', 'danger');
        }
        
        header('Location: ' . BASEURL . '/Admin/ManajemenStaff');
        exit;
    }
    public function hapus($id)
    {
        // Panggil model untuk menghapus data berdasarkan ID
        if ($this->model('Staff_model')->hapusDataStaff($id) > 0) {
            // Jika berhasil, set flash message sukses
            Flasher::setFlash('Staff', 'berhasil dihapus', 'success');
        } else {
            // Jika gagal, set flash message gagal
            Flasher::setFlash('Staff', 'gagal dihapus', 'danger');
        }
        
        // Arahkan kembali ke halaman utama
        header('Location: ' . BASEURL . '/Admin/ManajemenStaff');
        exit;
    }
}
