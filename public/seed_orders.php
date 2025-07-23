<?php
// Baris ini SANGAT PENTING untuk menampilkan error jika ada
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Memulai skrip...\n";

// Meng-include file konfigurasi dan database helper
require_once '../app/config/config.php';
require_once '../app/core/Database.php';

echo "File konfigurasi dan database berhasil dimuat.\n";

$db = new Database;
echo "Koneksi database berhasil diinisialisasi.\n";

try {
    // 1. Ambil semua data user dan produk yang ada
    $db->query("SELECT id FROM users");
    $users = $db->resultSet(PDO::FETCH_ASSOC);

    $db->query("SELECT id, daily_rental_price FROM products");
    $products = $db->resultSet(PDO::FETCH_ASSOC);

    if (empty($users) || empty($products)) {
        throw new Exception("Data user atau produk tidak ditemukan. Pastikan tabel 'users' dan 'products' sudah terisi.");
    }

    echo "Data referensi berhasil diambil. Memulai proses insert...\n";
    
    // --- BAGIAN YANG DIPERBAIKI ---
    // Daftar semua kemungkinan status pesanan
    $possibleStatuses = ['pending_payment', 'paid', 'ready_for_pickup', 'rented', 'returned', 'completed', 'cancelled'];
    // --- AKHIR BAGIAN YANG DIPERBAIKI ---

    $jumlah_data = 5000;

    for ($i = 1; $i <= $jumlah_data; $i++) {
        // Mengambil user dan produk acak
        $randomUser = $users[array_rand($users)];
        $randomProduct = $products[array_rand($products)];
        $userId = $randomUser['id'];
        $productId = $randomProduct['id'];
        $productPrice = $randomProduct['daily_rental_price'];

        // Menggunakan uniqid() untuk memastikan order_number selalu unik
        $orderNumber = 'ORD-' . uniqid() . '-' . $userId;

        // --- BAGIAN YANG DIPERBAIKI ---
        // Memilih satu status secara acak dari daftar
        $randomStatus = $possibleStatuses[array_rand($possibleStatuses)];
        // --- AKHIR BAGIAN YANG DIPERBAIKI ---

        $startDate = new DateTime();
        $startDate->modify('-' . rand(1, 365) . ' days');
        $rentalDuration = rand(1, 7);
        $endDate = clone $startDate;
        $endDate->modify('+' . $rentalDuration . ' days');
        $subtotal = $productPrice * $rentalDuration;
        $totalAmount = $subtotal;

        // Query untuk insert ke tabel orders
        $db->query(
            "INSERT INTO orders (order_number, user_id, rental_start_date, rental_end_date, subtotal, total_amount, status, created_at)
             VALUES (:order_number, :user_id, :start_date, :end_date, :subtotal, :total_amount, :status, :created_at)"
        );
        
        $db->bind('order_number', $orderNumber);
        $db->bind('user_id', $userId);
        $db->bind('start_date', $startDate->format('Y-m-d H:i:s'));
        $db->bind('end_date', $endDate->format('Y-m-d H:i:s'));
        $db->bind('subtotal', $subtotal);
        $db->bind('total_amount', $totalAmount);
        $db->bind('status', $randomStatus); // Menggunakan status yang sudah diacak
        $db->bind('created_at', $startDate->format('Y-m-d H:i:s'));
        $db->execute();

        $orderId = $db->lastInsertId();

        // Query untuk insert ke tabel order_items
        $db->query(
            "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase)
             VALUES (:order_id, :product_id, 1, :price)"
        );
        $db->bind('order_id', $orderId);
        $db->bind('product_id', $productId);
        $db->bind('price', $productPrice);
        $db->execute();

        if ($i % 100 == 0) {
            echo "-> {$i} data order berhasil ditambahkan...\n";
        }
    }

    echo "\nProses Seeding Selesai! {$jumlah_data} data order telah ditambahkan dengan status acak.\n";

} catch (Exception $e) {
    echo "\n\n!!! TERJADI ERROR !!!\n";
    echo "Pesan Error: " . $e->getMessage() . "\n";
    echo "Di file: " . $e->getFile() . " (Baris: " . $e->getLine() . ")\n";
}
?>