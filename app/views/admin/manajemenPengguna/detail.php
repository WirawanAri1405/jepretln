<main class="p-6">
    <section>
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Detail Data Pengguna</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ID Pengguna</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['pengguna']['id']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['pengguna']['name']); ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['pengguna']['email']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Password</p>
                        <p class="font-medium text-gray-900 dark:text-white">********</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">No. Handphone</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($data['pengguna']['phone_number']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <span class="px-2 py-1 text-xs font-medium rounded-full <?= $data['pengguna']['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                            <?= ucfirst($data['pengguna']['status']); ?>
                        </span>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                    <p class="font-medium text-gray-900 dark:text-white mt-1"><?= nl2br(htmlspecialchars($data['pengguna']['address'])); ?></p>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenPengguna" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm dark:bg-gray-600 dark:text-white">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>