<main class="p-6">
    <section>
        <div class="max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-4xl mx-auto">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Detail Data Produk</h2>

                        <!-- ID dan Nama -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ID Produk</p>
                                <p class="font-medium text-gray-900 dark:text-white">5617</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nama Produk</p>
                                <p class="font-medium text-gray-900 dark:text-white">Sony Alpha A7III</p>
                            </div>
                        </div>

                        <!-- Slug dan Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Slug (URL)</p>
                                <p class="font-medium text-gray-900 dark:text-white">sony-alpha-a7iii</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kategori</p>
                                <p class="font-medium text-gray-900 dark:text-white">Kamera Mirrorless</p>
                            </div>
                        </div>

                        <!-- Merek dan Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Merek</p>
                                <p class="font-medium text-gray-900 dark:text-white">Sony</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status Produk</p>
                                <p class="font-medium text-gray-900 dark:text-white">Available</p>
                            </div>
                        </div>

                        <!-- Harga dan Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Harga Sewa/Hari</p>
                                <p class="font-medium text-gray-900 dark:text-white">Rp150.000</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Stok</p>
                                <p class="font-medium text-gray-900 dark:text-white">10</p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Deskripsi Produk</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                Kamera full-frame ideal untuk videografi dan fotografi profesional.
                            </p>
                        </div>

                        <!-- Spesifikasi -->
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Spesifikasi (JSON)</p>
                            <pre class="bg-gray-100 dark:bg-gray-700 p-3 rounded-md text-sm text-gray-800 dark:text-white overflow-x-auto whitespace-pre-wrap">
{
    "sensor": "24.2MP Full-frame",
    "video": "4K 30fps",
    "connectivity": "Wi-Fi, Bluetooth"
}
                            </pre>
                        </div>

                        <!-- Gambar -->
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Gambar Produk</p>
                            <img src="path/to/image.jpg" alt="Sony Alpha A7III" class="w-40 rounded shadow mt-2">
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="<?= BASEURL; ?>/Admin/ManajemenProduk/" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                                ← Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>