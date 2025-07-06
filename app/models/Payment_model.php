<?php

class Payment_model
{
    private $table = 'payments';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    private function buildWhereClause($searchTerm, $status, &$bindings)
    {
        $conditions = [];
        if (!empty($searchTerm)) {
            $conditions[] = "o.order_number LIKE :searchTerm";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if ($status !== 'semua' && !empty($status)) {
            $conditions[] = "p.status = :status";
            $bindings['status'] = ['value' => $status, 'type' => PDO::PARAM_STR];
        }

        return empty($conditions) ? "" : " WHERE " . implode(' AND ', $conditions);
    }

    public function getAllPayments($searchTerm = null, $status = 'semua', $limit = 10, $offset = 0)
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);

        $query = "SELECT p.*, o.order_number 
                  FROM " . $this->table . " p
                  JOIN orders o ON p.order_id = o.id"
            . $whereClause .
            " ORDER BY p.created_at DESC LIMIT $limit OFFSET $offset";

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->resultSet();
    }

    public function countAllPayments($searchTerm = null, $status = 'semua')
    {
        $bindings = [];
        $whereClause = $this->buildWhereClause($searchTerm, $status, $bindings);
        $query = "SELECT COUNT(p.id) as total 
                  FROM " . $this->table . " p
                  JOIN orders o ON p.order_id = o.id"
            . $whereClause;

        $this->db->query($query);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }
        return $this->db->single()['total'];
    }

    public function updatePaymentStatus($paymentId, $status)
    {
        $this->db->query("UPDATE " . $this->table . " SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $paymentId);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}
