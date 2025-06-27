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
                    <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>