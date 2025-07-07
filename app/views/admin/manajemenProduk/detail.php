<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">

            <?php if ($data['product']) : ?>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <?php
                            // Logika PHP di view tetap sama sesuai permintaan.
                            $gambarUtama = 'default.jpg';
                            $gambarPendukung = [];
                            $semuaGambar = [];

                            if (!empty($data['product']['images'])) {
                                usort($data['product']['images'], function ($a, $b) {
                                    return $b['is_primary'] <=> $a['is_primary'];
                                });

                                foreach ($data['product']['images'] as $img) {
                                    $semuaGambar[] = $img['image_path'];
                                }

                                $gambarUtama = $semuaGambar[0];
                                $gambarPendukung = array_slice($semuaGambar, 1);
                            }
                            ?>

                            <div class="mb-4">
                                <img id="main-image" src="<?= BASEURL; ?>/assets/produk/<?= $gambarUtama; ?>" alt="Gambar Utama" class="w-full h-80 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($semuaGambar as $gambar) : ?>
                                    <img src="<?= BASEURL; ?>/assets/produk/<?= $gambar; ?>" alt="Thumbnail"
                                        class="w-16 h-16 object-cover rounded-md border-2 cursor-pointer thumbnail-image 
                                         <?= ($gambar == $gambarUtama) ? 'border-blue-500' : 'border-gray-300 dark:border-gray-600' ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['product_name']); ?></h1>
                            <div class="flex items-center gap-4 mt-2 mb-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"><?= htmlspecialchars($data['product']['category_name']); ?></span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['product']['brand_name']); ?></span>
                            </div>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp <?= number_format($data['product']['daily_rental_price'], 0, ',', '.'); ?> <span class="text-base font-normal text-gray-500 dark:text-gray-400">/ hari</span></p>
                            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400"><?= nl2br(htmlspecialchars($data['product']['description'])); ?></p>

                            <hr class="my-6 border-gray-200 dark:border-gray-700">

                            <h3 class="text-md font-semibold mb-2 text-gray-900 dark:text-white">Spesifikasi</h3>
                            <?php
                            $spesifikasiArray = json_decode($data['product']['specifications'], true) ?? [];
                            $templateArray = json_decode($data['product']['spec_template'] ?? '{}', true);
                            $labels = $templateArray['fields'] ?? [];
                            ?>
                            <dl class="text-sm">
                                <?php foreach ($spesifikasiArray as $key => $value): ?>
                                    <div class="grid grid-cols-2 gap-2 py-1">
                                        <dt class="font-medium text-gray-500 dark:text-gray-400"><?= htmlspecialchars($labels[$key] ?? ucwords(str_replace('_', ' ', $key))) ?></dt>
                                        <dd class="text-gray-900 dark:text-white"><?= htmlspecialchars($value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-end">
                            <a href="<?= BASEURL; ?>/Admin/ManajemenProduk"
                                class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">
                                Kembali
                            </a>
                        </div>
                    </div>

                </div>

            <?php else : ?>
                <p class="text-center text-gray-500 dark:text-gray-400">Produk tidak ditemukan.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<script>
    // Fungsionalitas JavaScript tetap sama.
    document.querySelectorAll('.thumbnail-image').forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Ganti gambar utama
            document.getElementById('main-image').src = this.src;

            // Atur ulang border
            document.querySelectorAll('.thumbnail-image').forEach(item => {
                item.classList.remove('border-blue-500');
                item.classList.add('border-gray-300', 'dark:border-gray-600');
            });

            // Tambahkan border biru ke thumbnail yang aktif
            this.classList.remove('border-gray-300', 'dark:border-gray-600');
            this.classList.add('border-blue-500');
        });
    });
</script>