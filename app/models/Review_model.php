<?php

class Review_model {
    private $table = 'reviews';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getReviewsByProductId($productId) {
        // Join dengan tabel users untuk mendapatkan nama pengguna
        $this->db->query(
            "SELECT r.*, u.name as user_name 
             FROM " . $this->table . " r
             JOIN users u ON r.user_id = u.id
             WHERE r.product_id = :product_id 
             ORDER BY r.created_at DESC"
        );
        $this->db->bind('product_id', $productId);
        return $this->db->resultSet();
    }

    public function tambahUlasan($data) {
        $query = "INSERT INTO " . $this->table . " (product_id, user_id, rating, comment, created_at) 
                  VALUES (:product_id, :user_id, :rating, :comment, :created_at)";

        $this->db->query($query);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('rating', $data['rating']);
        $this->db->bind('comment', $data['comment']);
        $this->db->bind('created_at', date('Y-m-d H:i:s'));

        $this->db->execute();
        return $this->db->rowCount();
    }
}