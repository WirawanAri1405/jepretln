<main class="p-6">
    <section>
        <div class="max-w-screen-xl ">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 p-4">

                    <div class="w-full md:w-auto flex items-center">

                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter Status
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>

                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Filter berdasarkan Status</h6>
                            <form action="<?= BASEURL; ?>/Admin/ManajemenPengguna" method="GET">
                                <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_term'] ?? '') ?>">
                                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="status_semua" type="radio" name="status" value="semua" class="w-4 h-4 text-blue-600" onchange="this.form.submit()" <?= ($data['status_aktif'] == 'semua') ? 'checked' : ''; ?>>
                                        <label for="status_semua" class="ml-2 text-gray-900 dark:text-gray-100">Semua Status</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="status_active" type="radio" name="status" value="active" class="w-4 h-4 text-blue-600" onchange="this.form.submit()" <?= ($data['status_aktif'] == 'active') ? 'checked' : ''; ?>>
                                        <label for="status_active" class="ml-2 text-gray-900 dark:text-gray-100">Aktif</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="status_blocked" type="radio" name="status" value="blocked" class="w-4 h-4 text-blue-600" onchange="this.form.submit()" <?= ($data['status_aktif'] == 'blocked') ? 'checked' : ''; ?>>
                                        <label for="status_blocked" class="ml-2 text-gray-900 dark:text-gray-100">Blokir</label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2">
                    </div>
                </div>

                <div class="mx-5"><?php Flasher::flash(); ?></div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">No. Telepon</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['pengguna'])) : ?>
                                <tr class="border-b">
                                    <td colspan="6" class="p-4 text-center">Data pengguna tidak ditemukan.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data['pengguna'] as $user): ?>
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3"><?= $user['id']; ?></td>
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($user['name']); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($user['email']); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($user['phone_number']); ?></td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $user['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                                <?= ucfirst($user['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="user-dropdown-button-<?= $user['id']; ?>" data-dropdown-toggle="user-dropdown-<?= $user['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500" type="button">
                                                <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="user-dropdown-<?= $user['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm">
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenPengguna/detail/<?= $user['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Detail</a></li>
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenPengguna/edit/<?= $user['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a></li>
                                                </ul>
                                                <div class="py-1"><a href="<?= BASEURL; ?>/Admin/ManajemenPengguna/hapus/<?= $user['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">Delete</a></div>
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
                           
                            $prevHref = ($data['current_page'] > 1) ? BASEURL . '/Admin/ManajemenPengguna?' . http_build_query($prevPageParams) : '#';
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
                                
                                $pageHref = BASEURL . '/Admin/ManajemenPengguna?' . http_build_query($pageParams);
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
                            
                            $nextHref = ($data['current_page'] < $data['total_pages']) ? BASEURL . '/Admin/ManajemenPengguna?' . http_build_query($nextPageParams) : '#';
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