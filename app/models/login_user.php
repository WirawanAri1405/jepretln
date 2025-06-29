<?php

class User_model {
    private $table = 'users'; // Ganti 'users' dengan nama tabel pengguna Anda
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function checkLogin($data) {
        $email = $data['email'];
        $password = $data['password'];

        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind('email', $email);

        $user = $this->db->single();

        // Jika user dengan email tersebut ditemukan
        if ($user) {
            // Verifikasi password yang di-hash
            if (password_verify($password, $user['password'])) {
                return $user; // Login berhasil, kembalikan data user
            } else {
                return false; // Password salah
            }
        } else {
            return false; // Email tidak ditemukan
        }
    }
    
    // Anda bisa tambahkan fungsi lain di sini, misalnya untuk registrasi
    // public function registerUser($data) { ... }
}