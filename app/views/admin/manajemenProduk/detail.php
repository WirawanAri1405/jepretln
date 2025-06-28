<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">

            <?php if ($data['product']) : ?>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <?php
                            // --- BLOK LOGIKA GAMBAR YANG DIPERBAIKI ---
                            $gambarUtama = 'default.jpg';
                            $gambarPendukung = [];
                            $semuaGambar = []; // Array untuk menampung semua path gambar

                            if (!empty($data['product']['images'])) {
                                // Urutkan dulu untuk memastikan gambar utama (jika ada) ada di awal
                                usort($data['product']['images'], function ($a, $b) {
                                    return $b['is_primary'] <=> $a['is_primary'];
                                });

                                // Ambil semua path gambar
                                foreach ($data['product']['images'] as $img) {
                                    $semuaGambar[] = $img['image_path'];
                                }

                                // Gambar pertama dalam array yang sudah diurutkan adalah gambar utama
                                $gambarUtama = $semuaGambar[0];
                                // Sisa gambar adalah gambar pendukung
                                $gambarPendukung = array_slice($semuaGambar, 1);
                            }
                            ?>

                            <div class="mb-4">
                                <img id="main-image" src="<?= BASEURL; ?>/assets/produk/<?= $gambarUtama; ?>" alt="Gambar Utama" class="w-full h-80 object-cover rounded-lg border">
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($semuaGambar as $gambar) : ?>
                                    <img src="<?= BASEURL; ?>/assets/produk/<?= $gambar; ?>" alt="Thumbnail"
                                        class="w-16 h-16 object-cover rounded-md border cursor-pointer thumbnail-image 
                 <?= ($gambar == $gambarUtama) ? 'border-2 border-blue-500' : '' // Tandai thumbnail utama 
                    ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($data['product']['product_name']); ?></h1>
                            <div class="flex items-center gap-4 mt-2 mb-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded"><?= htmlspecialchars($data['product']['category_name']); ?></span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded"><?= htmlspecialchars($data['product']['brand_name']); ?></span>
                            </div>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">Rp <?= number_format($data['product']['daily_rental_price'], 0, ',', '.'); ?> <span class="text-base font-normal">/ hari</span></p>
                            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400"><?= nl2br(htmlspecialchars($data['product']['description'])); ?></p>

                            <hr class="my-6">

                            <h3 class="text-md font-semibold mb-2">Spesifikasi</h3>
                            <?php
                            $spesifikasiArray = json_decode($data['product']['specifications'], true) ?? [];
                            $templateArray = json_decode($data['product']['spec_template'] ?? '{}', true);
                            $labels = $templateArray['fields'] ?? [];
                            ?>
                            <dl class="text-sm">
                                <?php foreach ($spesifikasiArray as $key => $value): ?>
                                    <div class="grid grid-cols-2 gap-2 py-1">
                                        <dt class="font-medium text-gray-500"><?= htmlspecialchars($labels[$key] ?? ucwords(str_replace('_', ' ', $key))) ?></dt>
                                        <dd class="text-gray-900 dark:text-white"><?= htmlspecialchars($value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                    </div>

                    <div class="p-6 border-t">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                    </div>
                </div>

            <?php else : ?>
                <p>Produk tidak ditemukan.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<script>
    document.querySelectorAll('.thumbnail-image').forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Ganti gambar utama
            document.getElementById('main-image').src = this.src;

            // Atur ulang border
            document.querySelectorAll('.thumbnail-image').forEach(item => item.classList.remove('border-blue-500'));
            this.classList.add('border-blue-500');
        });
    });
</script>