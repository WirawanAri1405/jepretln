<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <h1 class="text-2xl font-bold text-gray-800">Terima Kasih!</h1>
                <p class="text-gray-600 mt-2">Pesanan Anda dengan nomor <strong class="font-mono"><?= htmlspecialchars($data['order']['order_number']); ?></strong> telah kami terima.</p>

                <div class="mt-6 text-left bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-2">Instruksi Selanjutnya</h3>

                    <?php if ($data['order']['payment_method'] === 'Transfer Bank'): ?>
                        <p class="text-gray-700">Silakan lakukan pembayaran sebesar <strong>Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></strong> ke salah satu rekening berikut:</p>
                        <ul class="list-disc list-inside my-2">
                            <li><strong>BCA:</strong> 1234-5678-90 (a/n Jepretin Indonesia)</li>
                            <li><strong>Mandiri:</strong> 109-00-1234567-8 (a/n Jepretin Indonesia)</li>
                        </ul>
                        <p class="text-gray-700 mt-2">Setelah transfer, mohon konfirmasi melalui WhatsApp ke <strong class="text-green-600">0812-3456-7890</strong>.</p>
                    <?php else: ?>
                        <p class="text-gray-700">Anda telah memilih untuk membayar di tempat. Silakan siapkan uang tunai sebesar <strong>Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></strong> saat Anda mengambil peralatan.</p>
                    <?php endif; ?>
                </div>

                <div class="mt-8">
                    <a href="<?= BASEURL; ?>/Users/profile/orders" class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5">
                        Lihat Riwayat Pesanan
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>