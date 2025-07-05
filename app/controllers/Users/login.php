<?php

class Login extends Controller {

    public function index() {
        // Jika sudah login, langsung arahkan ke home
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ' . BASEURL . '/home/index');
            exit;
        }

        $data['judul'] = 'Login';
        $this->view('users/login/login', $data);
    }

    public function prosesLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->model('User_model')->checkLogin($_POST);

            if ($user) {
                // Simpan ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['profile_picture'] = $user['profile_picture'] ?? '';
                $_SESSION['logged_in'] = true;

                // Tambahkan cart count jika kamu pakai keranjang
               // $_SESSION['cart_count'] = $this->model('Keranjang_model')->hitungJumlahItem($user['id']);

                // ✅ Redirect ke halaman home
                header('Location: ' . BASEURL . '/home/index');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Email atau Password salah.', 'danger');
                header('Location: ' . BASEURL . '/users/login');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/users/login');
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/users/login');
        exit;
    }
}
