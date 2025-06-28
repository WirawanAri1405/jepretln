<?php

class Profile extends Controller {

    public function index() {
        // Keamanan: Cek apakah pengguna sudah login
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            Flasher::setFlash('gagal', 'Anda harus login untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASEURL . '/users/login');
            exit;
        }

        // Ambil data pengguna dari model berdasarkan ID di sesi
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);
        
        if (!$data['user']) {
            // Jika data tidak ditemukan, paksa logout
            header('Location: ' . BASEURL . '/users/login/logout');
            exit;
        }
        
        $data['judul'] = 'Profil Pengguna';
        $this->view('users/profile/ProfileUser', $data); 
    }

    public function edit() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            Flasher::setFlash('gagal', 'Anda harus login untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASEURL . '/users/login');
            exit;
        }

        // Ambil data terbaru dari user untuk ditampilkan di form
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);
        $data['judul'] = 'Edit Profil';

        // Tampilkan view form edit profil
        $this->view('users/profile/EditProfile', $data); 
    }

    public function update() {
        // Cek apakah ada request POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Panggil method di model untuk update data, dan cek hasilnya
            if ($this->model('User_model')->updateUser($_POST, $_FILES) > 0) {
                // Jika berhasil, beri pesan sukses dan arahkan kembali ke halaman profil
                Flasher::setFlash('berhasil', 'Profil berhasil diperbarui.', 'success');
                header('Location: ' . BASEURL . '/users/profile');
                exit;
            } else {
                // Jika gagal (atau tidak ada data yang berubah), beri pesan
                Flasher::setFlash('gagal', 'Tidak ada perubahan yang disimpan.', 'info');
                header('Location: ' . BASEURL . '/users/profile/edit');
                exit;
            }
        } else {
            // Jika diakses tanpa POST, tendang kembali
            header('Location: ' . BASEURL . '/users/profile');
            exit;
        }
    }
}