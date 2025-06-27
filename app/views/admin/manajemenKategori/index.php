<main class="p-6">
    <section>

        <div class="max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20">
                                <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Kategori
                        </button>
                    </div>
                </div>
                <div class="mx-5">
                    <?php Flasher::flash(); ?>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID Kategori</th>
                                <th scope="col" class="px-4 py-3">Nama Kategori</th>
                                <th scope="col" class="px-4 py-3">Slug</th>
                                <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['kategori'])) : ?>
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="4" class="px-4 py-3 text-center">Tidak ada data kategori ditemukan.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($data['kategori'] as $kategori) : ?>
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= $kategori['id']; ?>
                                        </th>
                                        <td class="px-4 py-3"><?= htmlspecialchars($kategori['name']); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($kategori['slug']); ?></td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="kategori-dropdown-button-<?= $kategori['id']; ?>" data-dropdown-toggle="kategori-dropdown-<?= $kategori['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="kategori-dropdown-<?= $kategori['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                <ul class="py-1 text-sm" aria-labelledby="kategori-dropdown-button-<?= $kategori['id']; ?>">
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenKategori/detail/<?= $kategori['id']; ?>" class="block py-2 px-4 hover:bg-gray-100">Show</a></li>
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenKategori/edit/<?= $kategori['id']; ?>" class="block py-2 px-4 hover:bg-gray-100">Edit</a></li>
                                                </ul>
                                                <div class="py-1">
                                                    <a href="<?= BASEURL; ?>/Admin/ManajemenKategori/hapus/<?= $kategori['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sudah digunakan pada produk mungkin tidak bisa dihapus.');">Delete</a>
                                                </div>
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