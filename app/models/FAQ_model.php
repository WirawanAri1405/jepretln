<?php

class FAQ_model
{
    private $table = 'faqs';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getFAQById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    private function buildWhereClause($searchTerm, $status, &$bindings)
    {
        $conditions = [];
        if (!empty($searchTerm)) {
            // Pencarian akan dilakukan pada kolom 'question' dan 'answer'
            $conditions[] = "(question LIKE :searchTerm OR answer LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        // Filter berdasarkan status 'is_published' (1 untuk published, 0 untuk draft)
        if ($status !== 'semua' && $status !== null) {
            $conditions[] = "is_published = :status";
            $bindings['status'] = ['value' => $status, 'type' => PDO::PARAM_INT];
        }

        if (empty($conditions)) {
            return "";
        }
        return " WHERE " . implode(' AND ', $conditions);
    }

    public function countAllFAQs($searchTerm = null, $status = 'semua')
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);
        $query = "SELECT COUNT(*) as total FROM " . $this->table . $whereClause;
        
        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        $result = $this->db->single();
        return $result['total'];
    }
    
    public function getAllFAQs($searchTerm = null, $status = 'semua', $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);

        $limit = (int) $limit;
        $offset = (int) $offset;

        $query = "SELECT * FROM " . $this->table . $whereClause . " ORDER BY sort_order ASC, id DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->resultSet();
    }
    public function tambahDataFAQ($data)
    {
        $query = "INSERT INTO faqs (question, answer, is_published, sort_order) 
                  VALUES (:question, :answer, :is_published, :sort_order)";

        $this->db->query($query);
        $this->db->bind('question', $data['question']);
        $this->db->bind('answer', $data['answer']);
        $this->db->bind('is_published', $data['is_published'], PDO::PARAM_INT);
        $this->db->bind('sort_order', $data['sort_order'], PDO::PARAM_INT);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataFAQ($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateDataFAQ($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                    question = :question,
                    answer = :answer,
                    is_published = :is_published,
                    sort_order = :sort_order
                  WHERE id = :id";
                  
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('question', $data['question']);
        $this->db->bind('answer', $data['answer']);
        $this->db->bind('is_published', $data['is_published']);
        $this->db->bind('sort_order', $data['sort_order']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}