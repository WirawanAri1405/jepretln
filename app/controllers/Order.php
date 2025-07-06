<?php

class Order extends Controller {

    public function create() {
        // Keamanan: Pastikan metode adalah POST dan pengguna sudah login
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        // 1. Validasi dan Persiapan Data
        $startDate = new DateTime($_POST['rental_start_date']);
        $endDate = new DateTime($_POST['rental_end_date']);
        
        if ($endDate < $startDate) {
             Flasher::setFlash('Gagal', 'Tanggal selesai sewa tidak boleh sebelum tanggal mulai.', 'danger');
             header('Location: ' . BASEURL . '/checkout/index/' . $_POST['product_slug']); // Asumsi ada slug di form
             exit;
        }

        // Hitung durasi dan total biaya
        $diff = $endDate->diff($startDate);
        $days = $diff->days == 0 ? 1 : $diff->days;
        $totalAmount = $days * (float)$_POST['daily_rental_price'];

        // Siapkan data untuk model
         $data = [
            'user_id' => $_SESSION['user_id'],
            'product_id' => $_POST['product_id'],
            'order_number' => 'ORD-' . time() . '-' . $_SESSION['user_id'],
            'rental_start_date' => $_POST['rental_start_date'],
            'rental_end_date' => $_POST['rental_end_date'],
            'pickup_location_id' => $_POST['pickup_location_id'],
            'return_location_id' => $_POST['return_location_id'],
            'daily_rental_price' => $_POST['daily_rental_price'],
            'total_amount' => $totalAmount
        ];

        $orderModel = $this->model('Order_model');
        // Panggil model untuk membuat pesanan, dan simpan ID pesanan yang baru
        $newOrderId = $orderModel->createOrder($data);

        if ($newOrderId) {
            // Jika berhasil, arahkan ke halaman pembayaran dengan ID pesanan
            header('Location: ' . BASEURL . '/payment/index/' . $newOrderId); 
            exit;
        } else {
            // Jika gagal
            Flasher::setFlash('Gagal', 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.', 'danger');
            header('Location: ' . BASEURL . '/checkout/index/' . $_POST['product_slug']);
            exit;
        }
    }
}