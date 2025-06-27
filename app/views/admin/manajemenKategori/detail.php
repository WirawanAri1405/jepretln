<main class="p-6">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Detail Kategori
            </h5>
            <p class="text-gray-500 dark:text-gray-400 mb-5">Informasi lengkap untuk kategori "<?= htmlspecialchars($data['kategori']['name']); ?>"</p>

            <hr class="dark:border-gray-600">

            <div class="mt-5 space-y-4">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Nama Kategori:</p>
                    <p class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['kategori']['name']); ?></p>
                </div>
                 <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Slug:</p>
                    <p class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['kategori']['slug']); ?></p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Template Spesifikasi (Format JSON):</p>
                    <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 rounded-md text-sm overflow-x-auto"><code><?= htmlspecialchars(json_encode(json_decode($data['kategori']['spec_template']), JSON_PRETTY_PRINT)); ?></code></pre>
                </div>
            </div>

             <a href="<?= BASEURL; ?>/Admin/ManajemenKategori/" class="inline-flex items-center mt-5 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Kembali
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
</main>