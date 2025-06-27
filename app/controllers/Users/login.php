<?php

class Login extends Controller {

    public function index() {
        // Jika pengguna SUDAH login, jangan tampilkan form login lagi, arahkan ke profil.
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ' . BASEURL . '/Users/profile');
            exit;
        }
        
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('users/login/login', $data);
        $this->view('templates/footer');
    }

    public function prosesLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->model('User_model')->checkLogin($_POST);

            if ($user) {
                // Jika login berhasil, buat sesi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['logged_in'] = true;

                // Arahkan ke controller Profile
                header('Location: ' . BASEURL . '/Users/profile');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Email atau Password salah.', 'danger');
                header('Location: ' . BASEURL . '/Users/login');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/Users/login');
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/Users/login');
        exit;
    }
}