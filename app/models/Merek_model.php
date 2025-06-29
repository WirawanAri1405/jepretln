<?php

class Merek_model
{
    private $table = 'brands';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    private function buildWhereClause($searchTerm, &$bindings)
    {
        if (!empty($searchTerm)) {
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
            return " WHERE name LIKE :searchTerm OR slug LIKE :searchTerm";
        }
        return "";
    }

    public function getAllMerek($searchTerm = null, $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $bindings);
        $limit = (int) $limit;
        $offset = (int) $offset;

        $query = "SELECT * FROM " . $this->table . $whereClause . " ORDER BY id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->resultSet();
    }

    public function countAllMerek($searchTerm = null)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $bindings);
        $query = "SELECT COUNT(*) as total FROM " . $this->table . $whereClause;
        
        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->single()['total'];
    }

    public function getMerekById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMerek($data)
    {
        $query = "INSERT INTO " . $this->table . " (name, slug) VALUES (:name, :slug)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('slug', $data['slug']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataMerek($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateDataMerek($data)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, slug = :slug WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('slug', $data['slug']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}