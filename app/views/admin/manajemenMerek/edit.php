<main class="p-6">
    <section>
        <div class="max-w-screen-md mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Brand</h2>

                <form method="POST" action="/admin/brand/update" class="space-y-6">
                    <!-- ID (readonly) -->
                    <div>
                        <label for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Brand</label>
                        <input type="text" id="id" name="id" value="5" readonly
                            class="w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 text-sm cursor-not-allowed" />
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Brand</label>
                        <input type="text" id="name" name="name" value="Canon"
                            class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug (URL)</label>
                        <input type="text" id="slug" name="slug" value="canon"
                            class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between pt-4">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                            ← Kembali
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>