<main class="p-6">
    <section>
        <div class="max-w-screen-lg mx-auto">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit Data Staff</h1>
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="<?= BASEURL; ?>/Admin/ManajemenStaff/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['staff']['id']; ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="w-full p-2 mt-1 rounded-md" required value="<?= htmlspecialchars($data['staff']['name']); ?>">
                        </div>
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" id="email" class="w-full p-2 mt-1 rounded-md" required value="<?= htmlspecialchars($data['staff']['email']); ?>">
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium">Nomor Telepon</label>
                            <input type="tel" name="phone_number" id="phone_number" class="w-full p-2 mt-1 rounded-md" value="<?= htmlspecialchars($data['staff']['phone_number'] ?? ''); ?>">
                        </div>
                        <div>
                            <label for="role_id" class="block text-sm font-medium">Jabatan</label>
                            <select name="role_id" id="role_id" class="w-full p-2 mt-1 rounded-md" required>
                                <?php foreach ($data['roles'] as $role) : ?>
                                    <option value="<?= $role['id']; ?>" <?= ($role['id'] == $data['staff']['role_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($role['display_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium">Alamat</label>
                            <textarea name="address" id="address" rows="3" class="w-full p-2 mt-1 rounded-md"><?= htmlspecialchars($data['staff']['address'] ?? ''); ?></textarea>
                        </div>

                        <hr class="md:col-span-2 my-2">

                        <div class="md:col-span-2">
                            <label for="password" class="block text-sm font-medium">Ubah Password (Opsional)</label>
                            <input type="password" name="password" id="password" class="w-full p-2 mt-1 rounded-md" placeholder="Isi hanya jika ingin mengubah password">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah password.</p>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t mt-6">
                        <a href="<?= BASEURL; ?>/Admin/ManajemenStaff" class="px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md ms-3">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>