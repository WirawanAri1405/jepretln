<main class="p-6">
    <section>
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Edit Data Pengguna</h2>

                <form class="space-y-6" action="<?= BASEURL; ?>/Admin/ManajemenPengguna/update" method="POST">

                    <input type="hidden" name="id" value="<?= $data['pengguna']['id']; ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">ID Pengguna</p>
                            <p class="font-medium text-gray-900 dark:text-white mt-1"><?= $data['pengguna']['id']; ?></p>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="<?= htmlspecialchars($data['pengguna']['name']); ?>" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="<?= htmlspecialchars($data['pengguna']['email']); ?>" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
                            <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak diubah" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Handphone</label>
                            <input type="tel" name="phone_number" id="phone_number" value="<?= htmlspecialchars($data['pengguna']['phone_number']); ?>" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm" required>
                                <option value="active" <?= ($data['pengguna']['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="blocked" <?= ($data['pengguna']['status'] == 'blocked') ? 'selected' : ''; ?>>Blocked</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="w-full p-2 rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm text-sm"><?= htmlspecialchars($data['pengguna']['address']); ?></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenPengguna" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>