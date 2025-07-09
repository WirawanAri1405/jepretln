<main class="p-6">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

        <div class="flex justify-between items-center border-b dark:border-gray-700 pb-4 mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Pesanan</h2>
                <p class="text-gray-600 dark:text-gray-400 font-mono"><?= htmlspecialchars($data['order']['order_number']); ?></p>
            </div>
            <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan/edit/<?= $data['order']['id']; ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">Edit Pesanan</a>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="space-y-4 text-gray-800 dark:text-gray-300">
                <div>
                    <h3 class="font-semibold text-lg mb-2 text-gray-900 dark:text-white">Informasi Pelanggan</h3>
                    <p><strong>Nama:</strong> <?= htmlspecialchars($data['order']['customer_name']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($data['order']['customer_email']); ?></p>
                    <p><strong>Telepon:</strong> <?= htmlspecialchars($data['order']['customer_phone'] ?? '-'); ?></p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mt-4 mb-2 text-gray-900 dark:text-white">Informasi Pesanan</h3>
                    <p><strong>Status:</strong> <span class="capitalize font-medium text-blue-600 dark:text-blue-400"><?= str_replace('_', ' ', $data['order']['status']); ?></span></p>
                    <p><strong>Tanggal Sewa:</strong> <?= date('d M Y, H:i', strtotime($data['order']['rental_start_date'])); ?> s/d <?= date('d M Y, H:i', strtotime($data['order']['rental_end_date'])); ?></p>
                    <p><strong>Lokasi Pengambilan:</strong> <?= htmlspecialchars($data['order']['pickup_location_name'] ?? '-'); ?></p>
                    <p><strong>Lokasi Pengembalian:</strong> <?= htmlspecialchars($data['order']['return_location_name'] ?? '-'); ?></p>
                </div>
            </div>

            <div class="text-gray-800 dark:text-gray-300">
                <h3 class="font-semibold text-lg mb-2 text-gray-900 dark:text-white">Item yang Disewa</h3>
                <ul class="list-disc list-inside space-y-1">
                    <?php foreach ($data['items'] as $item): ?>
                        <li><?= $item['quantity']; ?>x <?= htmlspecialchars($item['product_name']); ?> (Rp <?= number_format($item['price_at_purchase'], 0, ',', '.'); ?>)</li>
                    <?php endforeach; ?>
                </ul>

                <div class="border-t dark:border-gray-700 mt-4 pt-4 space-y-2">
                    <div class="flex justify-between"><span>Subtotal:</span><span>Rp <?= number_format($data['order']['subtotal'], 0, ',', '.'); ?></span></div>
                    <div class="flex justify-between text-sm text-red-500"><span>Diskon:</span><span>- Rp <?= number_format($data['order']['discount_amount'], 0, ',', '.'); ?></span></div>
                    <div class="flex justify-between"><span>Biaya Asuransi:</span><span>Rp <?= number_format($data['order']['insurance_fee'], 0, ',', '.'); ?></span></div>
                    <div class="flex justify-between"><span>Uang Jaminan:</span><span>Rp <?= number_format($data['order']['deposit_amount'], 0, ',', '.'); ?></span></div>
                    <div class="flex justify-between text-lg font-bold border-t dark:border-gray-600 pt-2 mt-2 text-gray-900 dark:text-white"><span>Total:</span><span>Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></span></div>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center">
            <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 text-sm">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</main>