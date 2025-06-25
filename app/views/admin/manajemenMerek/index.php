<main class="p-6">
    <section>
        <?php Flasher::flash(); ?>
        <div class="max-w-screen-xl mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between p-4">
                     <div class="w-full md:w-auto flex justify-end flex-1">
                         <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                             <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                             Tambah Merek
                         </button>
                     </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID Merek</th>
                                <th scope="col" class="px-4 py-3">Nama Merek</th>
                                <th scope="col" class="px-4 py-3">Slug</th>
                                <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['merek'])) : ?>
                                <tr class="border-b"><td colspan="4" class="px-4 py-3 text-center">Tidak ada data ditemukan.</td></tr>
                            <?php else : ?>
                                <?php foreach ($data['merek'] as $merek) : ?>
                                    <tr class="border-b">
                                        <th class="px-4 py-3"><?= $merek['id']; ?></th>
                                        <td class="px-4 py-3"><?= htmlspecialchars($merek['name']); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($merek['slug']); ?></td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="merek-dropdown-button-<?= $merek['id']; ?>" data-dropdown-toggle="merek-dropdown-<?= $merek['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500" type="button">
                                                <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /></svg>
                                            </button>
                                            <div id="merek-dropdown-<?= $merek['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                <ul class="py-1 text-sm"><li_><a href="<?= BASEURL; ?>/Admin/ManajemenMerek/edit/<?= $merek['id']; ?>" class="block py-2 px-4 hover:bg-gray-100">Edit</a></li></ul>
                                                <div class="py-1"><a href="<?= BASEURL; ?>/Admin/ManajemenMerek/hapus/<?= $merek['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100" onclick="return confirm('Yakin ingin menghapus merek ini?');">Delete</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
              <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white"><?= $data['showing_from'] ?>-<?= $data['showing_to'] ?></span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white"><?= $data['total_results'] ?></span>
                    </span>

                    <?php
                    // Logika untuk membangun parameter URL agar search tidak hilang
                    $queryParams = [];
                    if (!empty($data['search_term'])) {
                        $queryParams['search'] = $data['search_term'];
                    }
                    ?>

                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <?php
                            $prevPageParams = $queryParams;
                            $prevPageParams['page'] = $data['current_page'] - 1;
                            // URL disesuaikan ke ManajemenKategori
                            $prevHref = ($data['current_page'] > 1) ? BASEURL . '/Admin/ManajemenKategori?' . http_build_query($prevPageParams) : '#';
                            ?>
                            <a href="<?= $prevHref ?>"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] <= 1) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $data['total_pages']; $i++) : ?>
                            <li>
                                <?php
                                $pageParams = $queryParams;
                                $pageParams['page'] = $i;
                                // URL disesuaikan ke ManajemenKategori
                                $pageHref = BASEURL . '/Admin/ManajemenKategori?' . http_build_query($pageParams);
                                ?>
                                <a href="<?= $pageHref ?>"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight border border-gray-300 dark:border-gray-700 <?= ($i == $data['current_page']) ? 'z-10 text-blue-600 dark:text-white' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li>
                            <?php
                            $nextPageParams = $queryParams;
                            $nextPageParams['page'] = $data['current_page'] + 1;
                            // URL disesuaikan ke ManajemenKategori
                            $nextHref = ($data['current_page'] < $data['total_pages']) ? BASEURL . '/Admin/ManajemenKategori?' . http_build_query($nextPageParams) : '#';
                            ?>
                            <a href="<?= $nextHref ?>"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] >= $data['total_pages']) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>