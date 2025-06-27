<?php

class Login extends Controller {
    public function index() {
        if (isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/users/profile'); // Arahkan ke dashboard jika sudah login
            exit;
        }
        $data['judul'] = 'Masuk'; 
        $this->view('users/login/login', $data); // Memuat view dan data
    }

    public function prosesLogin() {
        $user = $this->model('User_model')->checkLogin($_POST);
        if ($user) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_nama'] = $user['name']; // Pastikan nama kolom 'name'
            header('Location: ' . BASEURL . '/users/profile'); // Arahkan ke dashboard setelah login
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Emai atau Password salah', 'danger');
            header('Location: ' . BASEURL . '/users/login');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        session_unset();
        header('Location: ' . BASEURL . '/Users/login');
        exit;
    }
}