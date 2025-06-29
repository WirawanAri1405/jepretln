<?php

class Login extends Controller {

    /**
     * Menampilkan halaman login.
     * Jika user sudah login, langsung arahkan ke dashboard admin.
     */
    public function index()
    {
        // Pengecekan sesi untuk mencegah user yang sudah login melihat halaman ini lagi
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
            header('Location: ' . BASEURL . '/Admin/LaporanKinerja');
            exit;
        }

        $data['judul'] = 'Login Admin Panel';
        $this->view('admin/login/login', $data); 
    
    }

    /**
     * Memproses data login dari form.
     */
    public function prosesLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user_model = $this->model('User_model');
            $user_ditemukan = $user_model->cekLogin($email, $password);

            if ($user_ditemukan) {
                $user_model->buatSesiLogin($user_ditemukan);
                header('Location: ' . BASEURL . '/Admin/LaporanKinerja');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Email atau Password Salah', 'danger');
                header('Location: ' . BASEURL . '/admin/login');
                exit;
            }
        } else {
            Flasher::setFlash('Gagal', 'Email atau Password Salah', 'danger');
            header('Location: ' . BASEURL . '/admin/login');
            exit;
        }
    }

    /**
     * Proses logout admin.
     */
    public function logout()
    {
        // Always start the session to access it.
        session_start();
        
        // Unset all session variables.
        session_unset();

        // Destroy the session.
        session_destroy();
        
        // Redirect to the correct admin login page.
        header('Location: ' . BASEURL . '/admin/login');
        exit;
    }
}