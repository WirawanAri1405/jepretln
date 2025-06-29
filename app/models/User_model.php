<?php

class User_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Memeriksa kredensial, verifikasi password, dan memastikan peran user adalah 'admin'.
     * @return mixed - Mengembalikan array data user jika sukses, atau boolean false jika gagal.
     */
    public function cekLogin($email, $password)
    {
        // Langkah 1: Cari user berdasarkan email
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind('email', $email);
        $user = $this->db->single();

        // Jika user tidak ditemukan, langsung hentikan
        if (!$user) {
            return false;
        }

        // Langkah 2: Verifikasi password input dengan hash di database
        if (password_verify($password, $user['password'])) {
            
            // Langkah 3: Jika password cocok, pastikan perannya adalah 'admin'
            // -- THIS IS THE CORRECTED, MORE ROBUST LOGIC --
            $this->db->query(
                'SELECT roles.name FROM user_roles 
                 INNER JOIN roles ON user_roles.role_id = roles.id 
                 WHERE user_roles.user_id = :user_id AND roles.name = :role_name'
            );
            $this->db->bind('user_id', $user['id']);
            $this->db->bind('role_name', 'admin');
            
            // Fetch the result of the role check
            $isAdmin = $this->db->single();

            // If $isAdmin contains data, it means the query found the 'admin' role.
            if ($isAdmin) {
                // SUKSES: Email ada, password cocok, dan peran adalah admin.
                return $user; 
            }
        }

        // Gagal jika password salah atau user bukan admin
        return false;
    }

    /**
     * Membuat data sesi setelah login berhasil.
     */
    public function buatSesiLogin($user)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = 'admin';
        $_SESSION['is_logged_in'] = true;
    }
}