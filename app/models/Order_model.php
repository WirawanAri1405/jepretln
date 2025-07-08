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

        $sql = "SELECT 
                o.*, 
                u.name as customer_name,
                u.email as customer_email,
                u.phone_number as customer_phone,
                pickup_loc.name as pickup_location_name,
                return_loc.name as return_location_name,
                pay.payment_method 
            FROM orders o
            JOIN users u ON o.user_id = u.id
            LEFT JOIN locations pickup_loc ON o.pickup_location_id = pickup_loc.id
            LEFT JOIN locations return_loc ON o.return_location_id = return_loc.id
            LEFT JOIN payments pay ON o.id = pay.order_id 
            WHERE o.id = :id";


        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    /**
     * Mengambil semua item produk dalam satu pesanan.
     */
    public function getOrderItemsByOrderId($order_id)
    {
        $sql = "SELECT 
                    oi.quantity, oi.price_at_purchase,
                    p.name as product_name, p.id as product_id
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";

        $this->db->query($sql);
        $this->db->bind(':order_id', $order_id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }


    // Fungsi lain seperti get all users, locations, dll jika diperlukan untuk form
    public function getAllSimple($tableName)
    {
        $this->db->query("SELECT id, name FROM " . $tableName);
        return $this->db->resultSet();
    }

    // Mendapatkan daftar status dari ENUM di database
    public function getPossibleStatuses()
    {
        $this->db->query("SHOW COLUMNS FROM orders LIKE 'status'");
        $result = $this->db->single();
        preg_match("/^enum\(\'(.*)\'\)$/", $result['Type'], $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    public function createOrder($data)
    {
        // Memulai transaksi
        $this->db->beginTransaction();

        try {
            // 1. Simpan data ke tabel 'orders'
            $queryOrder = "INSERT INTO orders (order_number, user_id, rental_start_date, rental_end_date, pickup_location_id, return_location_id, subtotal, total_amount, status) 
                           VALUES (:order_number, :user_id, :rental_start_date, :rental_end_date, :pickup_location_id, :return_location_id, :subtotal, :total_amount, 'pending_payment')";

            $this->db->query($queryOrder);
            $this->db->bind('order_number', $data['order_number']);
            $this->db->bind('user_id', $data['user_id']);
            $this->db->bind('rental_start_date', $data['rental_start_date']);
            $this->db->bind('rental_end_date', $data['rental_end_date']);
            $this->db->bind('pickup_location_id', $data['pickup_location_id']);
            $this->db->bind('return_location_id', $data['return_location_id']);
            $this->db->bind('subtotal', $data['total_amount']); // Subtotal sama dengan total untuk saat ini
            $this->db->bind('total_amount', $data['total_amount']);

            $this->db->execute();

            // Ambil ID dari pesanan yang baru saja dibuat
            $orderId = $this->db->lastInsertId();

            // 2. Simpan data ke tabel 'order_items'
            $queryItem = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase)
                          VALUES (:order_id, :product_id, 1, :price_at_purchase)";

            $this->db->query($queryItem);
            $this->db->bind('order_id', $orderId);
            $this->db->bind('product_id', $data['product_id']);
            $this->db->bind('price_at_purchase', $data['daily_rental_price']);

            $this->db->execute();
            $queryPayment = "INSERT INTO payments (order_id, amount, payment_method, status)
                         VALUES (:order_id, :amount, :payment_method, :status)";

            $this->db->query($queryPayment);
            $this->db->bind('order_id', $orderId);
            $this->db->bind('amount', $data['total_amount']);
            $this->db->bind('payment_method', 'Belum Dipilih'); // Metode pembayaran awal
            $this->db->bind('status', 'pending'); // Status pembayaran awal

            $this->db->execute();

            // Jika semua query berhasil, konfirmasi transaksi
            $this->db->commit();

            return $orderId;
        } catch (Exception $e) {
            // Jika terjadi error di salah satu query, batalkan semua perubahan
            $this->db->rollBack();
            // Optional: Catat error untuk debugging
            error_log('Order creation failed: ' . $e->getMessage());
            return false;
        }
    }
    public function hasUserCompletedOrderForProduct($userId, $productId)
    {
        $this->db->query(
            "SELECT o.id FROM orders o 
         JOIN order_items oi ON o.id = oi.order_id 
         WHERE o.user_id = :user_id 
         AND oi.product_id = :product_id 
         AND o.status = 'completed' 
         LIMIT 1"
        );
        $this->db->bind('user_id', $userId);
        $this->db->bind('product_id', $productId);

        $result = $this->db->single();

        // Jika ada hasilnya, kembalikan order_id, jika tidak, kembalikan false
        return $result ? $result['id'] : false;
    }
    public function getOrdersByUserId($userId)
    {
        $this->db->query(
            "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC"
        );
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }
    public function updateOrderStatus($orderId, $status)
    {
        $query = "UPDATE orders SET status = :status WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id', $orderId);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
