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
                    <div class="bg-[#EBD3C2] rounded-xl p-4 shadow text-center flex flex-col">
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
    </main>
</body>