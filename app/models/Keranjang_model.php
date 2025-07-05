<?php

class Keranjang_model {
    private $table = 'keranjang';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getKeranjangByUser($userId) {
        $this->db->query("SELECT k.id, k.durasi, k.total, 
                                 p.nama_produk, p.gambar, p.harga 
                          FROM keranjang k 
                          JOIN produk p ON k.produk_id = p.id 
                          WHERE k.user_id = :user_id");
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }
}
