<?php
class Lokasi_model
{
    
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllLocation()
    {
        $this->db->query('SELECT * FROM locations');
        return $this->db->resultSet();
    }

    public function getLocationById($id)
    {
        $this->db->query('SELECT * FROM locations WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
private function buildWhereClause($status, $searchTerm, &$bindings)
    {
        $conditions = [];
        if ($status !== null && $status !== 'Semua') {
            $conditions[] = "is_active = :is_active";
            $bindings['is_active'] = ['value' => $status, 'type' => PDO::PARAM_INT];
        }
        if ($searchTerm !== null && !empty($searchTerm)) {
            $conditions[] = "(name LIKE :searchTerm OR address LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if (empty($conditions)) {
            return "";
        }
        return " WHERE " . implode(' AND ', $conditions);
    }

    public function countAllLokasi($status = null, $searchTerm = null)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($status, $searchTerm, $bindings);
        $query = "SELECT COUNT(*) as total FROM locations" . $whereClause;
        
        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        $result = $this->db->single();
        return $result['total'];
    }

    public function getAllLokasiByStatus($status = null, $searchTerm = null, $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($status, $searchTerm, $bindings);
        $query = "SELECT * FROM locations" . $whereClause . " LIMIT :limit OFFSET :offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        
        $this->db->bind('limit', $limit, PDO::PARAM_INT);
        $this->db->bind('offset', $offset, PDO::PARAM_INT);

        return $this->db->resultSet();
    }
    public function tambahDataLokasi($data)
    {
        $query = "INSERT INTO locations (name,address, is_active) VALUES (:name,:address,:is_active)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('is_active', $data['is_active']);

        $this->db->execute();

        return $this->db->rowCount();
    }
        public function hapusDataLokasi($id)
    {
        $query = "DELETE FROM locations WHERE id =:id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateDataLokasi($data)
    {
        $query = "UPDATE locations SET 
                    name = :name, 
                    address = :address, 
                    is_active = :is_active 
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('name', $data['name']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('is_active', $data['is_active'], PDO::PARAM_INT);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
