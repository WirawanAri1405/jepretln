<main class="p-6">
    <section>
        <div class="max-w-screen-xl mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Detail Data Produk</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ID Produk</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['id']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Produk</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['name']); ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Slug (URL)</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['slug']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kategori</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['category_name'] ?? 'Tidak ada kategori'); ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Merek</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['brand_name'] ?? 'Tidak ada merek'); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status Produk</p>
                        <span class="px-2 py-1 text-xs font-medium rounded-full <?= $data['product']['status'] == 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                            <?= ucfirst($data['product']['status']); ?>
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Harga Sewa/Hari</p>
                        <p class="font-medium text-gray-900 dark:text-white">Rp<?= number_format($data['product']['daily_rental_price'], 0, ',', '.'); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Stok</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['stock_quantity']); ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Deskripsi Produk</p>
                    <p class="font-medium text-gray-900 dark:text-white mt-1">
                        <?= nl2br(htmlspecialchars($data['product']['description'])); ?>
                    </p>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Spesifikasi (JSON)</p>
                    <pre class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md text-sm text-gray-800 dark:text-white overflow-x-auto whitespace-pre-wrap mt-1"><?= htmlspecialchars(json_encode(json_decode($data['product']['specifications']), JSON_PRETTY_PRINT)); ?></pre>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>