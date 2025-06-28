<?php

class Staff_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    private function buildWhereClause($searchTerm, $roleId, &$bindings)
    {
        // Kondisi dasar: hanya tampilkan user yang bukan 'customer'
        $conditions = ["r.name != 'customer'"];

        if (!empty($searchTerm)) {
            $conditions[] = "(u.name LIKE :searchTerm OR u.email LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if (!empty($roleId) && $roleId !== 'semua') {
            $conditions[] = "r.id = :role_id";
            $bindings['role_id'] = ['value' => $roleId, 'type' => PDO::PARAM_INT];
        }

        return " WHERE " . implode(' AND ', $conditions);
    }

    public function getAllStaff($searchTerm = null, $roleId = 'semua', $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $roleId, $bindings);

        $query = "SELECT u.id, u.name, u.email, u.phone_number, r.display_name as jabatan
                  FROM users u
                  JOIN user_roles ur ON u.id = ur.user_id
                  JOIN roles r ON ur.role_id = r.id"
            . $whereClause .
            " ORDER BY u.id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->resultSet();
    }

    public function countAllStaff($searchTerm = null, $roleId = 'semua')
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $roleId, $bindings);
        $query = "SELECT COUNT(u.id) as total 
                  FROM users u
                  JOIN user_roles ur ON u.id = ur.user_id
                  JOIN roles r ON ur.role_id = r.id"
            . $whereClause;

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->single()['total'];
    }

    // Fungsi untuk mengambil semua role yang bukan customer (untuk dropdown filter)
    public function getStaffRoles()
    {
        $this->db->query("SELECT id, display_name FROM roles WHERE name != 'customer' ORDER BY id");
        return $this->db->resultSet();
    }
    public function tambahDataStaff($data)
    {
        $this->db->beginTransaction();
        try {
            // 1. Insert ke tabel 'users'
            $queryUser = "INSERT INTO users (name, email, password, phone_number, address, status) 
                      VALUES (:name, :email, :password, :phone_number, :address, 'active')";

            $this->db->query($queryUser);
            $this->db->bind('name', $data['name']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('password', $data['password']);
            $this->db->bind('phone_number', $data['phone_number']);
            $this->db->bind('address', $data['address']);
            $this->db->execute();

            // Ambil ID dari user yang baru saja dibuat
            $userId = $this->db->lastInsertId();
            if (!$userId) throw new \Exception("Gagal mendapatkan ID user baru.");

            // 2. Insert ke tabel 'user_roles' untuk menghubungkan user dengan perannya
            $queryRole = "INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)";
            $this->db->query($queryRole);
            $this->db->bind('user_id', $userId);
            $this->db->bind('role_id', $data['role_id']);
            $this->db->execute();

            // Jika semua berhasil, simpan perubahan
            $this->db->commit();
            return $this->db->rowCount();
        } catch (\Exception $e) {
            // Jika ada error, batalkan semua query
            $this->db->rollBack();
            error_log("Error di tambahDataStaff: " . $e->getMessage());
            return 0;
        }
    }

    public function getStaffById($id)
    {
        $query = "SELECT u.*, r.id as role_id, r.display_name as jabatan 
                  FROM users u
                  JOIN user_roles ur ON u.id = ur.user_id
                  JOIN roles r ON ur.role_id = r.id
                  WHERE u.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateDataStaff($data)
    {
        $this->db->beginTransaction();
        try {
            // 1. Bangun query untuk update tabel 'users'
            // Password hanya akan diupdate jika ada di dalam array $data
            $queryUser = "UPDATE users SET 
                            name = :name, 
                            email = :email, 
                            phone_number = :phone_number, 
                            address = :address" .
                (isset($data['password']) ? ", password = :password" : "") .
                " WHERE id = :id";

            $this->db->query($queryUser);
            $this->db->bind('id', $data['id']);
            $this->db->bind('name', $data['name']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('phone_number', $data['phone_number']);
            $this->db->bind('address', $data['address']);
            if (isset($data['password'])) {
                $this->db->bind('password', $data['password']);
            }
            $this->db->execute();

            // 2. Update data peran di tabel 'user_roles'
            $queryRole = "UPDATE user_roles SET role_id = :role_id WHERE user_id = :user_id";
            $this->db->query($queryRole);
            $this->db->bind('role_id', $data['role_id']);
            $this->db->bind('user_id', $data['id']);
            $this->db->execute();

            $this->db->commit();
            return $this->db->rowCount();
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Error di updateDataStaff: " . $e->getMessage());
            return -1;
        }
    }
    public function hapusDataStaff($id)
    {
        $query = "DELETE FROM users WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
