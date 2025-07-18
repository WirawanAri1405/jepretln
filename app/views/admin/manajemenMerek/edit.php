<main class="p-6">
    <section>
        <div class="max-w-screen-md mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Merek</h2>

                <form method="POST" action="<?= BASEURL; ?>/Admin/ManajemenMerek/update" class="space-y-6">

                    <div>
                        <label for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Merek</label>
                        <input type="text" id="id" name="id" value="<?= $data['merek']['id']; ?>" readonly
                            class="w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 text-sm cursor-not-allowed" />
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Merek</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['merek']['name']); ?>"
                            class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required />
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug (URL)</label>
                        <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($data['merek']['slug']); ?>" readonly
                            class="w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 text-sm cursor-not-allowed" />
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>