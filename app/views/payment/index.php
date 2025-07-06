<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h1 class="text-2xl font-bold text-gray-800">Pesanan Berhasil Dibuat!</h1>
                <p class="text-gray-600 mt-2">Nomor Pesanan Anda: <strong class="font-mono"><?= htmlspecialchars($data['order']['order_number']); ?></strong></p>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 my-6 text-left">
                    <p class="text-lg font-semibold text-blue-800">Total Pembayaran</p>
                    <p class="text-3xl font-bold text-blue-900">Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></p>
                </div>

                <h2 class="text-xl font-semibold mt-8 mb-4">Pilih Metode Pembayaran</h2>
                <div class="text-left space-y-6">
                    <div>
                        <h3 class="font-semibold text-lg">1. Transfer Bank</h3>
                        <p class="text-gray-600 text-sm mt-1">Silakan transfer ke salah satu rekening berikut:</p>
                        <ul class="list-disc list-inside mt-2 bg-gray-50 p-4 rounded-md">
                            <li><strong>BCA:</strong> 1234-5678-90 a/n Jepretin Indonesia</li>
                            <li><strong>Mandiri:</strong> 109-00-1234567-8 a/n Jepretin Indonesia</li>
                        </ul>
                        <p class="text-gray-600 text-sm mt-2">Setelah melakukan transfer, harap konfirmasi pembayaran melalui WhatsApp ke nomor <strong class="text-green-600">0812-3456-7890</strong> dengan menyertakan nomor pesanan Anda.</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">2. Bayar di Tempat (Cash on Delivery)</h3>
                        <p class="text-gray-600 text-sm mt-1">Anda dapat membayar secara tunai saat mengambil peralatan di lokasi yang telah Anda pilih. Harap siapkan uang pas.</p>
                    </div>
                </div>

                <div class="mt-8 border-t pt-6">
                    <a href="<?= BASEURL; ?>/Users/profile/orders" class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5">
                        Lihat Riwayat Pesanan Saya
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>