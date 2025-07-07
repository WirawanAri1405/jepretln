<main class="p-6">
    <section>
        <div class="max-w-screen-md mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Detail Merek</h2>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ID Merek</p>
                    <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['merek']['id']); ?></p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama Merek</p>
                    <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['merek']['name']); ?></p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Slug (URL)</p>
                    <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['merek']['slug']); ?></p>
                </div>

                <div class="flex justify-end">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>