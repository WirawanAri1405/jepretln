<main class="p-6">
    <div class="max-w-screen-lg mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">

            <div class="p-6 md:p-8">
                <h1 class="mb-4 text-2xl md:text-3xl font-bold tracking-tight text-gray-900 dark:text-white"><?= htmlspecialchars($data['faq']['question']); ?></h1>

                <div class="prose prose-base lg:prose-lg max-w-none text-gray-700 dark:text-gray-300">
                    <?= $data['faq']['answer']; // Jawaban dari database (diasumsikan sudah aman/HTML) 
                    ?>
                </div>
            </div>

            <div class="px-6 md:px-8 pb-6">
                <hr class="my-6 border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Metadata</h3>
                <dl class="mt-4 text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="sm:col-span-2">
                            <?php
                            $isPublished = $data['faq']['is_published'] == 1;
                            $statusText = $isPublished ? 'Published' : 'Draft';
                            // Kelas Badge yang diperbarui
                            $statusClass = $isPublished
                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                            ?>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full <?= $statusClass; ?>">
                                <?= $statusText; ?>
                            </span>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-2">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">Urutan Tampil</dt>
                        <dd class="sm:col-span-2 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($data['faq']['sort_order']); ?>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <a href="<?= BASEURL; ?>/Admin/ManajemenFAQ" class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4L1 5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</main>