<main class="p-6">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            
            <div class="mb-4">
                <img src="<?= BASEURL; ?>/assets/kategori/<?= htmlspecialchars($data['kategori']['image']); ?>" 
                     alt="Gambar <?= htmlspecialchars($data['kategori']['name']); ?>" 
                     class="max-w-full h-auto mx-auto rounded-lg">
            </div>

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <?= htmlspecialchars($data['kategori']['name']); ?>
            </h5>

            <p class="mb-4 font-normal text-gray-500 dark:text-gray-400">
                Slug: <?= htmlspecialchars($data['kategori']['slug']); ?>
            </p>
            
            <hr class="my-4 dark:border-gray-600">

            <div>
                <p class="font-semibold text-gray-800 dark:text-gray-200">Template Spesifikasi:</p>
                <?php if (!empty($data['kategori']['spec_template']) && $data['kategori']['spec_template'] !== '{}') : ?>
                    <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 mt-2 rounded-md text-sm overflow-x-auto"><code><?= htmlspecialchars(json_encode(json_decode($data['kategori']['spec_template']), JSON_PRETTY_PRINT)); ?></code></pre>
                <?php else : ?>
                    <p class="text-sm text-gray-500 mt-2">Tidak ada template spesifikasi untuk kategori ini.</p>
                <?php endif; ?>
            </div>

            <a href="<?= BASEURL; ?>/Admin/ManajemenKategori" class="inline-flex items-center px-4 py-2 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="rtl:rotate-180 w-3.5 h-3.5 me-2" fill="none" viewBox="0 0 14 10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M10 5H1m0 0l4 4-4-4"/></svg>
                Kembali
            </a>
        </div>
    </div>
</main>