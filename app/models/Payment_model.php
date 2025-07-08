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


    public function updatePaymentStatus($paymentId, $newPaymentStatus)
    {
        // Mulai transaksi untuk memastikan data tetap konsisten
        $this->db->beginTransaction();

        try {
            // 1. Ambil dulu order_id dari pembayaran yang akan diubah
            $this->db->query("SELECT order_id FROM " . $this->table . " WHERE id = :payment_id");
            $this->db->bind('payment_id', $paymentId);
            $payment = $this->db->single();

            if (!$payment) {
                throw new Exception("Pembayaran tidak ditemukan.");
            }
            $orderId = $payment['order_id'];

            // 2. Update status di tabel 'payments'
            $queryPayment = "UPDATE " . $this->table . " SET status = :status, payment_date = NOW() WHERE id = :id";
            $this->db->query($queryPayment);
            $this->db->bind('status', $newPaymentStatus);
            $this->db->bind('id', $paymentId);
            $this->db->execute();

            // 3. Tentukan status pesanan baru berdasarkan status pembayaran
            $newOrderStatus = null;
            switch ($newPaymentStatus) {
                case 'success':
                    $newOrderStatus = 'paid'; // Pesanan siap diproses/disiapkan
                    break;
                case 'failed':
                    $newOrderStatus = 'cancelled';
                    break;
                case 'refunded':
                    $newOrderStatus = 'cancelled';
                    break;
            }

            // 4. Jika ada status pesanan baru, update tabel 'orders'
            if ($newOrderStatus !== null) {
                $queryOrder = "UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :order_id";
                $this->db->query($queryOrder);
                $this->db->bind('status', $newOrderStatus);
                $this->db->bind('order_id', $orderId);
                $this->db->execute();
            }

            // Jika semua berhasil, simpan perubahan
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Jika ada error, batalkan semua perubahan
            $this->db->rollBack();
            error_log('Payment status update failed: ' . $e->getMessage());
            return false;
        }
    }
    public function getPaymentByOrderId($orderId)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE order_id = :order_id LIMIT 1");
        $this->db->bind('order_id', $orderId);
        return $this->db->single();
    }

    public function updatePaymentMethod($paymentId, $method)
    {
        // Juga update tanggal pembayaran jika statusnya menjadi sukses
        $query = "UPDATE " . $this->table . " SET payment_method = :method, payment_date = IF(:method = 'Cash di Tempat', NOW(), NULL) WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('method', $method);
        $this->db->bind('id', $paymentId);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
