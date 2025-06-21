<?php

class Kupon_model{
 private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
     public function getKuponById($id)
    {
        $query = "SELECT * FROM coupons" . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

       private function buildWhereClause($searchTerm, $status, &$bindings)
    {
        $conditions = [];
        if (!empty($searchTerm)) {
            $conditions[] = "code LIKE :searchTerm";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        // Logika untuk filter status
        switch ($status) {
            case 'aktif':
                $conditions[] = "(expiry_date >= CURDATE() AND (max_uses IS NULL OR uses_count < max_uses))";
                break;
            case 'expired':
                $conditions[] = "expiry_date < CURDATE()";
                break;
            case 'habis':
                $conditions[] = "(max_uses IS NOT NULL AND uses_count >= max_uses)";
                break;
        }

        if (empty($conditions)) {
            return "";
        }
        return " WHERE " . implode(' AND ', $conditions);
    }

    public function countAllCoupons($searchTerm = null, $status = 'semua')
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);
        $query = "SELECT COUNT(*) as total FROM coupons"  . $whereClause;
        
        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        $result = $this->db->single();
        return $result['total'];
    }
    
    public function getAllCoupons($searchTerm = null, $status = 'semua', $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);

        // Perbaikan bug PDO untuk LIMIT dan OFFSET
        $limit = (int) $limit;
        $offset = (int) $offset;

        $query = "SELECT * FROM coupons"  . $whereClause . " ORDER BY id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->resultSet();
    }
    public function tambahDataKupon($data)
    {
        $query = "INSERT INTO coupons (code, discount_type, value,description, expiry_date)
                  VALUES (:code, :discount_type, :value,:description, :expiry_date)";

        $this->db->query($query);
        $this->db->bind('code', $data['code']);
        $this->db->bind('discount_type', $data['discount_type']);
        $this->db->bind('value', $data['value']);
        $this->db->bind('description', $data['description']);


        // Jika tanggal atau batas penggunaan tidak diisi, kirim NULL ke database
        $this->db->bind('expiry_date', !empty($data['expiry_date']) ? $data['expiry_date'] : null);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataKupon($id)
    {
        $query = "DELETE FROM coupons" . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateDataKupon($data)
    {
        // Query disesuaikan dengan nama kolom dari form Anda
        $query = "UPDATE coupons SET 
                    code = :code, 
                    description = :description,
                    discount_type = :discount_type, 
                    value = :value, 
                    expiry_date = :expiry_date
                  WHERE id = :id";

        $this->db->query($query);
        
        // Binding disesuaikan dengan nama input dari form Anda
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('code', $data['code']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('discount_type', $data['discount_type']);
        $this->db->bind('value', $data['value']);
        $this->db->bind('expiry_date', !empty($data['expiry_date']) ? $data['expiry_date'] : null);

        $this->db->execute();

        return $this->db->rowCount();
    }
}