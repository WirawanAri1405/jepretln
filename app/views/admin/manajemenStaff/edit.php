<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit Data Staff</h1>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="<?= BASEURL; ?>/Admin/ManajemenStaff/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['staff']['id']; ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= htmlspecialchars($data['staff']['name']); ?>">
                        </div>
                        <div class="md:col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= htmlspecialchars($data['staff']['email']); ?>">
                        </div>
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                            <input type="tel" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= htmlspecialchars($data['staff']['phone_number'] ?? ''); ?>">
                        </div>
                        <div>
                            <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                            <select name="role_id" id="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($data['roles'] as $role) : ?>
                                    <option value="<?= $role['id']; ?>" <?= ($role['id'] == $data['staff']['role_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($role['display_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea name="address" id="address" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= htmlspecialchars($data['staff']['address'] ?? ''); ?></textarea>
                        </div>

                        <hr class="md:col-span-2 my-4 border-gray-200 dark:border-gray-700">

                        <div class="md:col-span-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah Password (Opsional)</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi hanya jika ingin mengubah password">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah password.</p>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700 mt-6">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenStaff" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 py-2 px-4 rounded-lg">Batal</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>