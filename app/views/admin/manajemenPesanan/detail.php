<main class="p-6">
    <section>
        <div class="max-w-7xl mx-auto">
            <div class="mb-4">
                <?php Flasher::flash(); ?>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Detail Pesanan #<?= htmlspecialchars($data['order']['order_number']); ?></h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat pada: <?= date('d M Y, H:i', strtotime($data['order']['created_at'])); ?></p>
                        </div>
                        <?php
                        $statusClasses = [
                            'pending_payment' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                            'ready_for_pickup' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                            'rented' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
                            'returned' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                            'completed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                        ];
                        $statusClass = $statusClasses[$data['order']['status']] ?? 'bg-gray-200 text-gray-800';
                        ?>

                        <span class="text-sm font-medium px-3 py-1 rounded-full <?= $statusClass ?>">
                            <?= ucwords(str_replace('_', ' ', $data['order']['status'])); ?>
                        </span>

                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-white border-b dark:border-gray-700 pb-2 mb-3">Informasi Pelanggan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Nama:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['customer_name']); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Email:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['customer_email']); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Telepon:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['customer_phone']); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Alamat:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['customer_address'] ?? 'Tidak ada alamat'); ?></strong>
                            </div>
                        </div>

                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-white border-b dark:border-gray-700 pb-2 mb-3">Detail Sewa & Logistik</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Mulai Sewa:</span>
                                <strong class="text-gray-900 dark:text-white"><?= date('d M Y, H:i', strtotime($data['order']['rental_start_date'])); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Selesai Sewa:</span>
                                <strong class="text-gray-900 dark:text-white"><?= date('d M Y, H:i', strtotime($data['order']['rental_end_date'])); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Lokasi Ambil:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['pickup_location_name'] ?? 'N/A'); ?></strong>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Lokasi Kembali:</span>
                                <strong class="text-gray-900 dark:text-white"><?= htmlspecialchars($data['order']['return_location_name'] ?? 'N/A'); ?></strong>
                            </div>
                        </div>
                    </div>


                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-white border-b dark:border-gray-700 pb-2 mb-3">Item yang Disewa</h3>
                        <div class="flow-root">
                            <ul role="list" class="-my-4 divide-y divide-gray-200 dark:divide-gray-700">
                                <?php foreach ($data['order']['items'] as $item): ?>
                                    <li class="flex items-center py-4">
                                        <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 dark:border-gray-600">
                                            <img src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($item['product_image'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($item['product_name']); ?>" class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                                    <h3><a href="<?= BASEURL ?>/produk/<?= $item['product_slug'] ?>" target="_blank"><?= htmlspecialchars($item['product_name']); ?></a></h3>
                                                    <p class="ml-4">Rp <?= number_format($item['price_at_purchase'], 0, ',', '.'); ?></p>
                                                </div>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500 dark:text-gray-400">Qty: <?= htmlspecialchars($item['quantity']); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white border-b dark:border-gray-700 pb-2 mb-3">Catatan</h3>
                        <div class="text-sm">
                            <p class="text-gray-700 dark:text-gray-300 font-medium">Catatan Pelanggan:</p>
                            <p class="text-gray-600 dark:text-gray-400 pl-2 italic"><?= !empty($data['order']['customer_notes']) ? nl2br(htmlspecialchars($data['order']['customer_notes'])) : 'Tidak ada catatan dari pelanggan.'; ?></p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 w-full">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md sticky top-6 w-full">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ringkasan Biaya</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Subtotal</span>
                                <strong class="text-gray-900 dark:text-white">Rp <?= number_format($data['order']['subtotal'], 0, ',', '.'); ?></strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Diskon (<?= htmlspecialchars($data['order']['coupon_code'] ?? 'N/A') ?>)</span>
                                <span class="text-red-500">- Rp <?= number_format($data['order']['discount_amount'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Biaya Asuransi</span>
                                <strong class="text-gray-900 dark:text-white">Rp <?= number_format($data['order']['insurance_fee'], 0, ',', '.'); ?></strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Uang Jaminan (Deposit)</span>
                                <strong class="text-gray-900 dark:text-white">Rp <?= number_format($data['order']['deposit_amount'], 0, ',', '.'); ?></strong>
                            </div>
                            <div class="flex justify-between font-bold text-lg pt-2 border-t dark:border-gray-600">
                                <span class="text-gray-900 dark:text-white">Total Tagihan</span>
                                <span class="text-gray-900 dark:text-white">Rp <?= number_format($data['order']['total_amount'], 0, ',', '.'); ?></span>
                            </div>
                        </div>

                        <hr class="my-6 dark:border-gray-600">

                        <form action="<?= BASEURL; ?>/Admin/ManajemenPesanan/update" method="POST">
                            <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi Admin</h3>

                            <div class="mb-4">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah Status Pesanan</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php foreach ($data['order_statuses'] as $status) : ?>
                                        <option value="<?= $status ?>" <?= ($data['order']['status'] == $status) ? 'selected' : '' ?>>
                                            <?= ucwords(str_replace('_', ' ', $status)) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="internal_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Internal</label>
                                <textarea id="internal_notes" name="internal_notes" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Catatan untuk tim..."><?= htmlspecialchars($data['order']['internal_notes'] ?? ''); ?></textarea>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>
                        </form>

                        <div class="flex justify-between items-center pt-4 mt-4 border-t dark:border-gray-700">
                            <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">
                                Kembali
                            </a>
                            <button type="button" class="text-sm font-medium text-gray-900 dark:text-white bg-gray-200 dark:bg-gray-600 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500">
                                Cetak Faktur
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center">
             <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</main>