<?php

class Pengguna_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Mengambil semua pengguna dengan filter dan paginasi
    public function getAllPengguna($status = 'semua', $searchTerm = null, $limit = 10, $offset = 0)
    {
        // Password tidak pernah diambil di list view
        $query = "SELECT id, name, email, phone_number, status, created_at FROM " . $this->table;

        $conditions = [];
        $bindings = [];

        if ($status !== 'semua') {
            $conditions[] = "status = :status";
            $bindings['status'] = ['value' => $status, 'type' => PDO::PARAM_STR];
        }
        if (!empty($searchTerm)) {
            $conditions[] = "(name LIKE :searchTerm OR email LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $query .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->resultSet();
    }

    // Menghitung total pengguna untuk paginasi
    public function countAllPengguna($status = 'semua', $searchTerm = null)
    {
        // ... Logika count dengan filter yang sama seperti di atas ...
        return 10; // Placeholder
    }

    // Mengambil data satu pengguna berdasarkan ID
    public function getPenggunaById($id)
    {
        // Password juga tidak diambil di sini untuk keamanan saat menampilkan di form edit
        $this->db->query('SELECT id, name, email, phone_number, address, status FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    // Menambah data pengguna baru
    public function tambahDataPengguna($data)
    {
        $query = "INSERT INTO users (name, email, password, phone_number, address, status) 
                  VALUES (:name, :email, :password, :phone_number, :address, :status)";

        $this->db->query($query);

        // Hashing password sebelum disimpan
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $hashedPassword);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Mengubah data pengguna
    public function ubahDataPengguna($data)
    {
        // Logika untuk update password: hanya jika diisi
        if (!empty($data['password'])) {
            $query = "UPDATE users SET name = :name, email = :email, password = :password, phone_number = :phone_number, address = :address, status = :status WHERE id = :id";
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            $query = "UPDATE users SET name = :name, email = :email, phone_number = :phone_number, address = :address, status = :status WHERE id = :id";
        }

        $this->db->query($query);

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('status', $data['status']);

        if (!empty($data['password'])) {
            $this->db->bind('password', $hashedPassword);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Menghapus data pengguna
    public function hapusDataPengguna($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
