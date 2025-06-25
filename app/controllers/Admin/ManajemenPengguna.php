<?php

class ManajemenPengguna extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Pengguna';
        $pengguna_model = $this->model('Pengguna_model');

        // --- PERUBAHAN DIMULAI DI SINI ---

        // Mengambil parameter filter dan pencarian dari URL
        $status_filter = $_GET['status'] ?? 'semua';
        $search_term = $_GET['search'] ?? null;

        // Menyiapkan data untuk dikirim ke view (agar nilai filter tetap ada)
        $data['search_action'] = BASEURL . '/Admin/ManajemenPengguna';
        $data['search_placeholder'] = 'Cari nama atau email pengguna...';
        $data['search_term'] = $search_term;
        $data['status_aktif'] = $status_filter;

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Memanggil model dengan parameter filter dan pencarian
        $total_results = $pengguna_model->countAllPengguna($status_filter, $search_term);
        $total_pages = ceil($total_results / $results_per_page);
        $data['pengguna'] = $pengguna_model->getAllPengguna($status_filter, $search_term, $results_per_page, $offset);

        // Menyiapkan data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // --- PERUBAHAN SELESAI ---

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data); // Navbar membutuhkan data pencarian
        $this->view('admin/manajemenPengguna/index', $data);
        $this->view('admin/templates/footer');
    }

    public function hapus($id)
    {
        if ($this->model('Pengguna_model')->hapusDataPengguna($id) > 0) {
            Flasher::setFlash('Pengguna', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Pengguna', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenPengguna');
        exit;
    }


    public function edit($id)
    {
        $data['judul'] = 'Edit Pengguna';
        $data['pengguna'] = $this->model('Pengguna_model')->getPenggunaById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenPengguna/edit', $data);
        $this->view('admin/templates/footer');
    }

    public function update()
    {
        if ($this->model('Pengguna_model')->ubahDataPengguna($_POST) > 0) {
            Flasher::setFlash('Pengguna', 'berhasil diperbarui', 'success');
        } else {
            Flasher::setFlash('Pengguna', 'gagal diperbarui atau tidak ada perubahan', 'info');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenPengguna');
        exit;
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Pengguna';
        $data['pengguna'] = $this->model('Pengguna_model')->getPenggunaById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenPengguna/detail', $data);
        $this->view('admin/templates/footer');
    }
}
