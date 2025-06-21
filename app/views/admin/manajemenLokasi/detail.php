<body>
    <div class="justify-items-center mt-5">
        <div class="max-w-sm p-12  bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $data['lokasi']['name'] ?></h5>
            </a>
            <ul class="mb-3 text-gray-700 dark:text-gray-400">
                <li class="mb-2">
                    <p class="font-medium text-gray-800 dark:text-gray-200">
                        <strong>Alamat:</strong> <?= $data['lokasi']['address'] ?>
                    </p>
                    <p class="text-sm">
                        <strong>Status:</strong>
                        <span class="<?php
                                        if ($data['lokasi']['is_active'] == 1 || $data['lokasi']['is_active'] === true) {
                                            echo 'text-green-600 dark:text-green-400';
                                        } else {
                                            echo 'text-red-600 dark:text-red-400';
                                        }
                                        ?>"><strong>
                                <?php
                                if ($data['lokasi']['is_active'] == 1) {
                                    echo 'Buka';
                                } else {
                                    echo 'Tutup';
                                }
                                ?></strong>
                        </span>
                    </p>
                </li>
            </ul>
            <a href="<?= BASEURL; ?>/Admin/ManajemenLokasi" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                kembali
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
</body>