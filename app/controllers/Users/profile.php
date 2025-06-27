<?php

class Profile extends Controller {

    public function index() {
        
        // 1. Keamanan: Cek apakah pengguna sudah login atau belum.
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Jika belum login, siapkan pesan error dan tendang ke halaman login.
            Flasher::setFlash('gagal', 'Anda harus login untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASEURL . '/Users/login');
            exit;
        }

        // 2. Ambil ID pengguna dari Sesi yang sudah kita buat saat registrasi/login.
        $userId = $_SESSION['user_id'];

        // 3. Panggil Model untuk mengambil semua data pengguna berdasarkan ID.
        $data['user'] = $this->model('User_model')->getUserById($userId);
        
        // Jika karena suatu hal data pengguna tidak ada di database, paksa logout.
        if (!$data['user']) {
            // Ini bisa terjadi jika user dihapus tapi sesinya masih ada.
            header('Location: ' . BASEURL . '/Users/logout');
            exit;
        }
        
        // 4. Siapkan data judul dan kirim data pengguna ke View untuk ditampilkan.
        $data['judul'] = 'Profil Pengguna';
        
        $this->view('templates/header', $data);
        // Menggunakan path view yang Anda tentukan
        $this->view('users/profile/ProfileUser', $data); 
        $this->view('templates/footer');
    }

    // Anda bisa menambahkan method lain di sini nanti, misalnya 'edit'
    public function edit() {
        // ...
    }
}