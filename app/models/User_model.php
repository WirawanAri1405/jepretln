<?php

class User_model {
    private $table = 'users'; 
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tambahUser($data) {
        // Cek duplikasi email, bagian ini tetap sama
        $queryCheck = "SELECT id FROM " . $this->table . " WHERE email = :email";
        $this->db->query($queryCheck);
        $this->db->bind('email', $data['email']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return false; // Email sudah terdaftar
        }

        // Hash password, bagian ini tetap sama
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // Query INSERT, bagian ini tetap sama
        $query = "INSERT INTO " . $this->table . 
                 " (name, email, password, phone_number, status, created_at, updated_at) 
                  VALUES 
                  (:name, :email, :password, :phone_number, :status, :created_at, :updated_at)";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $hashedPassword);
        $this->db->bind('phone_number', $data['nomor']);
        $this->db->bind('status', 'active');
        $this->db->bind('created_at', date('Y-m-d H:i:s'));
        $this->db->bind('updated_at', date('Y-m-d H:i:s'));

        $this->db->execute();

        // --- PERUBAHAN UTAMA DI SINI ---
        // Cek apakah proses INSERT berhasil
        if ($this->db->rowCount() > 0) {
            // Jika berhasil, panggil method lain untuk mencari user berdasarkan email
            $newUser = $this->getUserByEmail($data['email']);
            // Lalu kembalikan ID dari user yang baru ditemukan itu
            return $newUser['id'];
        } else {
            // Jika INSERT gagal
            return false;
        }
    }

    /**
     * Mengambil data satu user berdasarkan ID-nya.
     */
    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Mengambil data satu user berdasarkan email-nya.
     * Method ini kita butuhkan untuk membantu tambahUser().
     */
    public function getUserByEmail($email) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function checkLogin($data) {
        $email = $data['email'];
        $password = $data['password'];

        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind('email', $email);
        $user = $this->db->single();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user; // Sukses, kembalikan data user
            }
        }
        return false; // Gagal (email tidak ada atau password salah)
    }

    public function updateUser($data, $file) {
        // Logika untuk upload file gambar
        $namaFileGambar = $this->uploadProfilePicture($file);
        
        // Jika upload gagal, jangan update nama file di database
        if ($namaFileGambar === false) {
            // Ambil nama gambar lama dari input hidden jika ada
            $namaFileGambar = $data['gambar_lama'];
        }

        // Siapkan query UPDATE
        $query = "UPDATE users SET 
                    name = :name,
                    email = :email,
                    phone_number = :phone_number,
                    address = :address,
                    profile_picture = :profile_picture -- kolom untuk gambar
                  WHERE id = :id";
        
        $this->db->query($query);
        
        // Bind data dari form
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('phone_number', $data['nomor']);
        $this->db->bind('address', $data['lokasi']);
        $this->db->bind('profile_picture', $namaFileGambar);
        $this->db->bind('id', $data['id']); // Ambil id dari input hidden

        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * Helper function untuk menangani upload gambar profil
     */
    public function uploadProfilePicture($file) {
        // Cek apakah ada file yang diupload
        if (isset($file['profile_picture']) && $file['profile_picture']['error'] === 0) {
            $namaFile = $file['profile_picture']['name'];
            $ukuranFile = $file['profile_picture']['size'];
            $tmpName = $file['profile_picture']['tmp_name'];

            // Validasi ekstensi file
            $ekstensiValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiValid)) {
                return false; // Ekstensi tidak valid
            }

            // Validasi ukuran file (misal: maks 2MB)
            if ($ukuranFile > 2000000) {
                return false; // Ukuran terlalu besar
            }

            // Generate nama file baru yang unik
            $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

            // Pindahkan file ke folder tujuan (pastikan folder 'img/profile' ada di dalam folder 'public')
            move_uploaded_file($tmpName, 'assets/profile/' . $namaFileBaru);

            return $namaFileBaru;
        }
        return false; // Tidak ada file yang diupload atau terjadi error
    }

    public function updatePassword($id, $hashedPassword) {
        $query = "UPDATE users SET password = :password, updated_at = :updated_at WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('password', $hashedPassword);
        $this->db->bind('updated_at', date('Y-m-d H:i:s'));
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}