<?php

class Login extends Controller
{

    public function index()
    {
        // Jika sudah login, langsung arahkan ke home
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ' . BASEURL . '/home/index');
            exit;
        }

        $data['judul'] = 'Login';
        $this->view('users/login/login', $data);
    }

    public function prosesLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User_model');
            $user = $userModel->checkLogin($_POST);

            if ($user) {
                // Jika login berhasil, buat sesi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['logged_in'] = true;

                // !!! TAMBAHAN KRUSIAL: Ambil dan simpan peran ke sesi !!!
                $role = $userModel->getUserRole($user['id']);
                $_SESSION['role'] = $role ? $role['name'] : null; // Simpan nama peran, misal: 'customer'

                // Arahkan ke controller Profile
                header('Location: ' . BASEURL . '/home');
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

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/home');
        exit;
    }
}
