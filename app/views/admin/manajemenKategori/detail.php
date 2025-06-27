<main class="p-6">
    <section>
        <div class="max-w-screen-md mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Detail Kategori Produk</h2>

                <!-- ID -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ID Kategori</p>
                    <p class="font-medium text-gray-900 dark:text-white">5617</p>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama Kategori</p>
                    <p class="font-medium text-gray-900 dark:text-white">Bedi</p>
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Slug (URL)</p>
                    <p class="font-medium text-gray-900 dark:text-white">bedi-mirrorless</p>
                </div>
                <div class="flex justify-end">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                        ← Kembali
                    </a>
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