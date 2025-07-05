<body class="bg-gray-100 text-gray-800">
    <main class="px-4 py-10 max-w-6xl mx-auto">

        <h2 class="text-2xl font-bold text-center text-[#8A6843] mb-8">
            Daftar Produk: <?= htmlspecialchars($data['kategori']['name']); ?>
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">

            <?php if (empty($data['products'])): ?>
                <div class="col-span-full text-center text-gray-500 py-10">
                    <p>Belum ada produk di kategori ini.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['products'] as $product): ?>
                    <div class="bg-[#EBD3C2] rounded-xl p-4 shadow text-center flex flex-col ">
                        <div class="flex-grow">
                            <?php
                            // Mengambil gambar utama produk
                            $productImage = 'default.jpg'; // Gambar default
                            if (!empty($product['images'])) {
                                foreach ($product['images'] as $img) {
                                    if ($img['is_primary']) {
                                        $productImage = $img['image_path'];
                                        break;
                                    }
                                }
                                // Jika tidak ada gambar utama, ambil gambar pertama
                                if ($productImage === 'default.jpg') {
                                    $productImage = $product['images'][0]['image_path'];
                                }
                            }
                            ?>
                            <img src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($productImage); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" class="w-full h-40 object-contain mb-4 rounded-lg" />

                            <h3 class="text-sm font-bold"><?= htmlspecialchars($product['product_name']); ?></h3>
                            <p class="text-xs text-gray-600 mb-2"><?= htmlspecialchars($product['brand_name']); ?></p>
                        </div>

                        <a href="<?= BASEURL; ?>/produk/detail/<?= htmlspecialchars($product['slug']); ?>"
                            class="inline-block bg-white font-bold px-10 py-2 rounded-xl text-sm hover:bg-[#6f5633] transition mt-4">
                            Rp <?= number_format($product['daily_rental_price'], 0, ',', '.'); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <nav aria-label="Pagination Produk" class="mt-10">
            <?php if ($data['total_pages'] > 1): ?>
                <ul class="flex justify-center items-center -space-x-px h-10 text-base">
                    <li>
                        <?php
                        $prevHref = ($data['current_page'] > 1) ? BASEURL . '/kategori/' . $data['kategori']['slug'] . '?page=' . ($data['current_page'] - 1) : '#';
                        $prevDisabled = ($data['current_page'] <= 1) ? 'pointer-events-none opacity-50' : '';
                        ?>
                        <a href="<?= $prevHref; ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 <?= $prevDisabled; ?>">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                        <li>
                            <?php
                            $pageHref = BASEURL . '/kategori/' . $data['kategori']['slug'] . '?page=' . $i;
                            $pageActive = ($i == $data['current_page'])
                                ? 'z-10 text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700';
                            ?>
                            <a href="<?= $pageHref; ?>" class="flex items-center justify-center px-4 h-10 leading-tight border <?= $pageActive; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li>
                        <?php
                        $nextHref = ($data['current_page'] < $data['total_pages']) ? BASEURL . '/kategori/' . $data['kategori']['slug'] . '?page=' . ($data['current_page'] + 1) : '#';
                        $nextDisabled = ($data['current_page'] >= $data['total_pages']) ? 'pointer-events-none opacity-50' : '';
                        ?>
                        <a href="<?= $nextHref; ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 <?= $nextDisabled; ?>">
                            <span class="sr-only">Next</span>
                            <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </nav>

    </main>
</body>