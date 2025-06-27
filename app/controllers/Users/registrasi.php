<?php

class Registrasi extends Controller {
    
    public function index() {
        $data['judul'] = 'Registrasi';
        $this->view('templates/header', $data);
        $this->view('users/registrasi/registrasi'); 
        $this->view('templates/footer');
    }

    public function proses() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['password'] !== $_POST['confirmPassword']) {
                Flasher::setFlash('gagal', 'Konfirmasi password tidak cocok.', 'danger');
                header('Location: ' . BASEURL . '/Registrasi');
                exit;
            }

            // Panggil model untuk tambah user
            $hasil = $this->model('User_model')->tambahUser($_POST);

            // Cek apakah model mengembalikan hasil yang valid (bukan false atau 0)
            if ($hasil) {
                // Berhasil, arahkan ke halaman sukses
                header('Location: ' . BASEURL . '/Users/registrasiBerhasil');
                exit;
            } else {
                // Gagal, kemungkinan email sudah ada
                Flasher::setFlash('gagal', 'Registrasi gagal. Email mungkin sudah terdaftar.', 'danger');
                header('Location: ' . BASEURL . '/Users/Registrasi');
                exit;
            }
        } else {
            // Jika bukan POST, tendang kembali
            header('Location: ' . BASEURL . '/users/Registrasi');
            exit;
        }
    }

    public function registrasiBerhasil() {
        $data['judul'] = 'Registrasi Berhasil';
        $this->view('templates/header', $data);
        $this->view('users/registrasiBerhasil');
        $this->view('templates/footer');
    }
}