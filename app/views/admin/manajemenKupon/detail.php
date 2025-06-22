<body>
    <div class="p-6">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mx-auto">
            
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Detail Kupon
            </h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Kode : <span class="font-semibold text-gray-900 dark:text-white"><?= htmlspecialchars($data['kupon']['code']); ?></span>
            </p>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Jumlah Diskon : 
                <span class="font-semibold text-gray-900 dark:text-white">
                    <?php
                        if ($data['kupon']['discount_type'] == 'percentage') {
                            echo htmlspecialchars($data['kupon']['value']) . '%';
                        } else {
                            echo 'Rp ' . number_format($data['kupon']['value'], 0, ',', '.');
                        }
                    ?>
                </span>
            </p>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Tanggal Exp : <span class="font-semibold text-gray-900 dark:text-white"><?= date('d F Y', strtotime($data['kupon']['expiry_date'])); ?></span>
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Deskripsi : <span class="font-semibold text-gray-900 dark:text-white"><?= htmlspecialchars($data['kupon']['description']); ?></span>
            </p>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Status : 
                <?php
                    $today = date('Y-m-d');
                    $isExpired = $data['kupon']['expiry_date'] < $today;
                    $isUsedUp = ($data['kupon']['max_uses'] !== null && $data['kupon']['used_count'] >= $data['kupon']['max_uses']);
                    
                    if ($isExpired) {
                        echo '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Expired</span>';
                    } elseif ($isUsedUp) {
                        echo '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Used Up</span>';
                    } else {
                        echo '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>';
                    }
                ?>
            </p>

            <a href="<?= BASEURL; ?>/Admin/ManajemenKupon/" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Kembali
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
</body>