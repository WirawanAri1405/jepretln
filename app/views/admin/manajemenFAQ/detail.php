<body>
    <div class="justify-items-center mt-5">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= htmlspecialchars($data['faq']['question']); ?></h5>
            </a>
            <p class="mb-3 font-normal break-words text-gray-700 dark:text-gray-400"> <?= $data['faq']['answer']; ?></p>
            <ul class="mb-6 text-gray-700 dark:text-gray-400">
                <li class="mb-2">
                    <p class="text-sm">
                        <strong>Status:</strong>
                        <?php
                        $isPublished = $data['faq']['is_published'] == 1;
                        $statusText = $isPublished ? 'Published' : 'Draft';
                        $statusClass = $isPublished ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400';
                        ?>
                        <span class="font-semibold <?= $statusClass; ?>">
                            <?= $statusText; ?>
                        </span>
                    </p>
                </li>
                <li>
                    <p class="text-sm">
                        <strong>Urutan Tampil:</strong>
                        <span class="font-semibold text-gray-900 dark:text-white">
                            <?= htmlspecialchars($data['faq']['sort_order']); ?>
                        </span>
                    </p>
                </li>
            </ul>
            <a href="<?= BASEURL; ?>/Admin/ManajemenFAQ" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Kembali
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
</body>