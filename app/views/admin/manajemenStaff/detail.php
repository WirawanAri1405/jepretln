<main class="p-6">
    <div class="flex justify-center">
        <div class="w-full max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 mb-3 rounded-full shadow-lg bg-gray-200 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                    <?= htmlspecialchars($data['staff']['name']); ?>
                </h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    <?= htmlspecialchars($data['staff']['jabatan']); ?>
                </span>
            </div>

            <hr class="my-5 border-gray-200 dark:border-gray-600">

            <div class="space-y-3 text-sm">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Email:</p>
                    <p class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['staff']['email']); ?></p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Nomor Telepon:</p>
                    <p class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['staff']['phone_number'] ?? '-'); ?></p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Alamat:</p>
                    <p class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['staff']['address'] ?? '-'); ?></p>
                </div>
                 <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Status Akun:</p>
                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $data['staff']['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                        <?= ucfirst($data['staff']['status']); ?>
                    </span>
                </div>
            </div>

            <a href="<?= BASEURL; ?>/Admin/ManajemenStaff" class="inline-flex items-center px-4 py-2 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="rtl:rotate-180 w-3.5 h-3.5 me-2" fill="none" viewBox="0 0 14 10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M10 5H1m0 0l4 4-4-4"/></svg>
                Kembali ke Daftar Staff
            </a>
        </div>
    </div>
</main>