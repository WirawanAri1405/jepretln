<body class="bg-gray-100">
    <main class="container mx-auto mt-10 px-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <?php
                    $gambarUtama = 'default.jpg';
                    $gambarPendukung = [];
                    if (!empty($data['product']['images'])) {
                        foreach ($data['product']['images'] as $img) {
                            if ($img['is_primary']) {
                                $gambarUtama = $img['image_path'];
                            } else {
                                $gambarPendukung[] = $img['image_path'];
                            }
                        }
                        // Jika tidak ada gambar utama, ambil gambar pertama
                        if ($gambarUtama === 'default.jpg' && !empty($data['product']['images'])) {
                            $gambarUtama = $data['product']['images'][0]['image_path'];
                            array_shift($gambarPendukung);
                        }
                    }
                    ?>
                    <img id="main-image" src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($gambarUtama); ?>" alt="Gambar Utama" class="w-full h-96 object-cover rounded-lg border border-gray-200">
                    <div class="flex space-x-2 mt-4">
                        <img src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($gambarUtama); ?>" class="thumbnail-image w-20 h-20 object-cover rounded-md border-2 border-blue-600 cursor-pointer">
                        <?php foreach ($gambarPendukung as $g): ?>
                            <img src="<?= BASEURL; ?>/assets/produk/<?= htmlspecialchars($g); ?>" class="thumbnail-image w-20 h-20 object-cover rounded-md border-2 border-transparent cursor-pointer">
                        <?php endforeach; ?>
                    </div>
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($data['product']['product_name']); ?></h1>
                    <span class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full mt-2"><?= htmlspecialchars($data['product']['brand_name']); ?></span>
                    <p class="text-3xl font-light text-gray-900 my-4">Rp <?= number_format($data['product']['daily_rental_price'], 0, ',', '.'); ?> <span class="text-lg">/ hari</span></p>
                    <p class="text-gray-600 mb-6"><?= nl2br(htmlspecialchars($data['product']['description'])); ?></p>
                    <a href="<?= BASEURL; ?>/checkout/index/<?= $data['product']['slug']; ?>" class="w-full text-center bg-[#A67C52] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#8C6847] transition duration-300">Sewa Sekarang</a>
                </div>
            </div>

            <div class="mt-10">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button id="tab-spec" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600">Spesifikasi</button>
                        <button id="tab-reviews" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">Ulasan</button>
                    </nav>
                </div>

                <div id="content-spec" class="tab-content py-6">
                    <?php
                    $spesifikasiArray = json_decode($data['product']['specifications'], true) ?? [];
                    $templateArray = json_decode($data['product']['spec_template'] ?? '{}', true);
                    $labels = $templateArray['fields'] ?? [];
                    ?>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <?php foreach ($spesifikasiArray as $key => $value): ?>
                            <div>
                                <dt class="font-semibold text-gray-800"><?= htmlspecialchars($labels[$key] ?? ucwords(str_replace('_', ' ', $key))) ?></dt>
                                <dd class="text-gray-600"><?= htmlspecialchars($value) ?></dd>
                            </div>
                        <?php endforeach; ?>
                    </dl>
                </div>

                <div id="content-reviews" class="tab-content py-6 hidden">
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Tulis Ulasan Anda</h3>

                        <?php if (isset($_SESSION['user_id']) && $data['eligible_to_review']): ?>
                            <form action="<?= BASEURL; ?>/produk/ulasan" method="post">
                                <input type="hidden" name="product_id" value="<?= $data['product']['id']; ?>">
                                <input type="hidden" name="product_slug" value="<?= $data['product']['slug']; ?>">
                                <input type="hidden" name="order_id" value="<?= $data['completed_order_id']; ?>">

                                <div class="mb-4">
                                    <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">Rating</label>
                                    <select id="rating" name="rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        <option value="5">★★★★★</option>
                                        <option value="4">★★★★☆</option>
                                        <option value="3">★★★☆☆</option>
                                        <option value="2">★★☆☆☆</option>
                                        <option value="1">★☆☆☆☆</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">Ulasan Anda</label>
                                    <textarea id="comment" name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis ulasan Anda di sini..." required></textarea>
                                </div>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Kirim Ulasan</button>
                            </form>
                        <?php elseif (isset($_SESSION['user_id'])): ?>
                            <p class="p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50">Anda harus menyewa dan menyelesaikan pesanan untuk produk ini sebelum dapat memberikan ulasan.</p>
                        <?php else: ?>
                            <p class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50">Silakan <a href="<?= BASEURL; ?>/users/login" class="font-bold hover:underline">login</a> untuk memberikan ulasan.</p>
                        <?php endif; ?>
                    </div>
                    <div class="space-y-6">
                        <?php if (empty($data['reviews'])): ?>
                            <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
                        <?php else: ?>
                            <?php foreach ($data['reviews'] as $review): ?>
                                <article class="p-6 text-base bg-white rounded-lg border-t border-gray-200">
                                    <footer class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"><?= htmlspecialchars($review['user_name']) ?></p>
                                            <p class="text-sm text-gray-600"><time><?= date('d F Y', strtotime($review['created_at'])) ?></time></p>
                                        </div>
                                    </footer>
                                    <p class="text-gray-500"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // JavaScript untuk thumbnail gallery dan tabs
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('main-image');
            const thumbnails = document.querySelectorAll('.thumbnail-image');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    mainImage.src = this.src;
                    thumbnails.forEach(t => t.classList.remove('border-blue-600'));
                    this.classList.add('border-blue-600');
                });
            });

            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Hide all content
                    tabContents.forEach(content => content.classList.add('hidden'));

                    // Deactivate all buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-500', 'text-blue-600');
                        btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    });

                    // Activate the clicked button
                    this.classList.add('border-blue-500', 'text-blue-600');
                    this.classList.remove('border-transparent', 'text-gray-500');

                    // Show the corresponding content
                    const targetId = this.id.replace('tab-', 'content-');
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });
        });
    </script>
</body>