<?php

class Order_model
{
    private $table = 'orders';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Helper untuk membangun klausa WHERE secara dinamis.
     */
    private function buildWhereClause($searchTerm, $filters, &$bindings)
    {
        $conditions = [];
        if (!empty($searchTerm)) {
            $conditions[] = "(users.name LIKE :searchTerm OR orders.order_number LIKE :searchTerm)";
            $bindings['searchTerm'] = ['value' => "%$searchTerm%", 'type' => PDO::PARAM_STR];
        }

        if (!empty($filters['status'])) {
            $conditions[] = "orders.status = :status";
            $bindings['status'] = ['value' => $filters['status'], 'type' => PDO::PARAM_STR];
        }

        return empty($conditions) ? "" : " WHERE " . implode(' AND ', $conditions);
    }

    /**
     * Mengambil semua pesanan dengan filter dan paginasi.
     */
    public function getAllOrders($searchTerm = null, $filters = [], $limit = 10, $offset = 0)
    {
        $bindings = [];
        $sql = "SELECT 
                    orders.id,
                    orders.order_number,
                    users.name as customer_name,
                    orders.rental_start_date,
                    orders.rental_end_date,
                    orders.total_amount,
                    orders.status,
                    orders.created_at
                FROM " . $this->table . "
                LEFT JOIN users ON orders.user_id = users.id";

        $whereClause = $this->buildWhereClause($searchTerm, $filters, $bindings);
        $sql .= $whereClause;
        $sql .= " ORDER BY orders.created_at DESC LIMIT $limit OFFSET $offset";

        $this->db->query($sql);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->resultSet();
    }

    /**
     * Menghitung total pesanan berdasarkan filter.
     */
    public function countAllOrders($searchTerm = null, $filters = [])
    {
        $bindings = [];
        $sql = "SELECT COUNT(orders.id) as total 
                FROM " . $this->table . "
                LEFT JOIN users ON orders.user_id = users.id";

        $whereClause = $this->buildWhereClause($searchTerm, $filters, $bindings);
        $sql .= $whereClause;

        $this->db->query($sql);
        foreach ($bindings as $key => $param) {
            $this->db->bind($key, $param['value'], $param['type']);
        }

        return $this->db->single()['total'];
    }

    /**
     * Mengambil detail lengkap satu pesanan berdasarkan ID.
     */
    public function getOrderById($id)
    {
        // 1. Ambil data utama pesanan
        $queryOrder = "SELECT 
                        o.*, 
                        u.name as customer_name,
                        u.email as customer_email,
                        u.phone_number as customer_phone,
                        u.address as customer_address,
                        pickup.name as pickup_location_name,
                        ret.name as return_location_name,
                        c.code as coupon_code
                    FROM " . $this->table . " o
                    LEFT JOIN users u ON o.user_id = u.id
                    LEFT JOIN locations pickup ON o.pickup_location_id = pickup.id
                    LEFT JOIN locations ret ON o.return_location_id = ret.id
                    LEFT JOIN coupons c ON o.coupon_id = c.id
                    WHERE o.id = :id";
        $this->db->query($queryOrder);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $order = $this->db->single();

        if ($order === false) {
            return false;
        }

        // 2. Ambil item-item produk yang dipesan
        $queryItems = "SELECT
                        oi.quantity,
                        oi.price_at_purchase,
                        p.name as product_name,
                        p.slug as product_slug,
                        pi.image_path as product_image
                       FROM order_items oi
                       JOIN products p ON oi.product_id = p.id
                       LEFT JOIN (
                           SELECT product_id, image_path FROM product_images WHERE is_primary = 1
                       ) pi ON p.id = pi.product_id
                       WHERE oi.order_id = :order_id";
        $this->db->query($queryItems);
        $this->db->bind('order_id', $id, PDO::PARAM_INT);
        $order['items'] = $this->db->resultSet();

        return $order;
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateOrderStatus($orderId, $newStatus, $internalNotes)
    {
        $query = "UPDATE " . $this->table . " SET status = :status, internal_notes = :internal_notes WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('status', $newStatus);
        $this->db->bind('internal_notes', $internalNotes);
        $this->db->bind('id', $orderId, PDO::PARAM_INT);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataPesanan($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
