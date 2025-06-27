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
                header('Location: ' . BASEURL . '/users/registrasi'); // Benar
                exit;
            }

            if ($this->model('User_model')->tambahUser($_POST) > 0) {
                header('Location: ' . BASEURL . '/users/registrasi/registrasiBerhasil'); // Benar
                exit;
            } else {
                Flasher::setFlash('gagal', 'Registrasi gagal. Email mungkin sudah terdaftar.', 'danger');
                header('Location: ' . BASEURL . '/users/registrasi'); // Benar
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/users/registrasi'); // Benar
            exit;
        }
    }

    public function registrasiBerhasil() {
        $data['judul'] = 'Registrasi Berhasil';
        $this->view('templates/header', $data);
        $this->view('users/registrasi/registrasiBerhasil');
        $this->view('templates/footer');
    }
}