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
        $this->view('templates/header', $data);
        $this->view('users/profile/ProfileUser', $data); 
        $this->view('templates/footer');
    }

    public function edit() {
        // Tambahkan logika untuk halaman edit profil di sini
    }
}