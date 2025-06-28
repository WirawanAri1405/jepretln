<main class="p-6">
    <div class="max-w-screen-lg mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-1 flex flex-col items-center text-center">
                    <div class="w-24 h-24 mb-3 rounded-full shadow-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center border-2 border-white dark:border-gray-800">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                        <?= htmlspecialchars($data['staff']['name']); ?>
                    </h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <?= htmlspecialchars($data['staff']['jabatan']); ?>
                    </span>
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Detail Informasi
                    </h3>
                    <dl class="text-sm">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="sm:col-span-2 text-gray-900 dark:text-white"><?= htmlspecialchars($data['staff']['email']); ?></dd>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                            <dd class="sm:col-span-2 text-gray-900 dark:text-white"><?= htmlspecialchars($data['staff']['phone_number'] ?? '-'); ?></dd>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                            <dd class="sm:col-span-2 text-gray-900 dark:text-white"><?= nl2br(htmlspecialchars($data['staff']['address'] ?? '-')); ?></dd>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2 items-center">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Status Akun</dt>
                            <dd class="sm:col-span-2">
                                <span class="px-2.5 py-0.5 text-xs font-medium rounded-full 
                                    <?= $data['staff']['status'] == 'active'
                                        ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?= ucfirst($data['staff']['status']); ?>
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <a href="<?= BASEURL; ?>/Admin/ManajemenStaff" class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4L1 5" />
                    </svg>
                    Kembali ke Daftar Staff
                </a>
            </div>
        </div>
    </div>
</main>