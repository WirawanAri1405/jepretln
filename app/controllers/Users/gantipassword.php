<?php

class GantiPassword extends Controller {
    public function index() {
        $data['judul'] = 'Lupa Password';  
        $this->view('users/gantipassword/GantiPassword', $data); 
    }

    public function reset() {
        $email = $_POST['email'];
        $passwordBaru = $_POST['password_baru'];
        $konfirmasi = $_POST['konfirmasi_password'];

        // 1. Cek apakah password cocok
        if ($passwordBaru !== $konfirmasi) {
            Flasher::setFlash('Konfirmasi password', 'tidak cocok.', 'danger');
            header('Location: ' . BASEURL . '/Users/gantipassword');
            exit;
        }

        // 2. Ambil user dari database
        $user = $this->model('User_model')->getUserByEmail($email);
        if (!$user) {
            Flasher::setFlash('Email', 'tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/Users/gantipassword');
            exit;
        }

        // 3. Hash dan update password
        $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $update = $this->model('User_model')->updatePassword($user['id'], $hash);

        if ($update > 0) {
            Flasher::setFlash('Password', 'berhasil diperbarui.', 'success');
            header('Location: ' . BASEURL . '/users/login');
            exit;
        } else {
            Flasher::setFlash('Password', 'gagal diperbarui.', 'danger');
            header('Location: ' . BASEURL . '/Users/gantipassword');
            exit;
        }
    }
}
