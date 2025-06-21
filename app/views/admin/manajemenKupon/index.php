 <main class="p-6">
     <section>
         <div class="max-w-screen-xl">
             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                 <div
                     class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

                     <div
                         class="flex items-center space-x-3 w-full md:w-auto">
                         <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                             type="button"
                             class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                             <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                 <path clip-rule="evenodd" fill-rule="evenodd"
                                     d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                             </svg>
                             Add cupon
                         </button>
                         <div class="flex items-center space-x-3 w-full md:w-auto">
                             <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                 class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                 type="button">
                                 <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20"
                                     fill="currentColor">
                                     <path fill-rule="evenodd"
                                         d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                         clip-rule="evenodd" />
                                 </svg>
                                 Filter
                                 <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                     <path clip-rule="evenodd" fill-rule="evenodd"
                                         d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                 </svg>
                             </button>
                            <form id="filterForm" action="" method="GET">
                             <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_term'] ?? '') ?>">
                            <div id="filterDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Filter berdasarkan Status</h6>
                                <ul class="space-y-2 text-sm mb-4" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="status-semua" type="radio" name="statusFilter" value="semua" class="w-4 h-4" <?= ($data['status_aktif'] == 'semua') ? 'checked' : ''; ?>>
                                        <label for="status-semua" class="ml-2 text-sm font-medium">Semua</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="status-aktif" type="radio" name="statusFilter" value="aktif" class="w-4 h-4" <?= ($data['status_aktif'] == 'aktif') ? 'checked' : ''; ?>>
                                        <label for="status-aktif" class="ml-2 text-sm font-medium">Aktif</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="status-expired" type="radio" name="statusFilter" value="expired" class="w-4 h-4" <?= ($data['status_aktif'] == 'expired') ? 'checked' : ''; ?>>
                                        <label for="status-expired" class="ml-2 text-sm font-medium">Expired</label>
                                    </li>
                                </ul>
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                         </div>
                     </div>
                 </div>
                 <div class="mx-5">
                     <?php Flasher::flash(); ?>
                 </div>
                 <div class="overflow-x-auto ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Kode Kupon</th>
                                <th scope="col" class="px-4 py-3">Tipe Diskon</th>
                                <th scope="col" class="px-4 py-3">Jumlah Diskon</th>
                                <th scope="col" class="px-4 py-3">Tanggal Exp</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['coupons'])) : ?>
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="6" class="px-4 py-3 text-center">Tidak ada data kupon ditemukan.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($data['coupons'] as $kupon) : ?>
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= htmlspecialchars($kupon['code']); ?>
                                        </th>
                                        <td class="px-4 py-3"><?= ucfirst(htmlspecialchars($kupon['discount_type'])); ?></td>
                                        <td class="px-4 py-3">
                                            <?php
                                                if ($kupon['discount_type'] == 'percentage') {
                                                    echo htmlspecialchars($kupon['value']) . '%';
                                                } else {
                                                    echo 'Rp ' . number_format($kupon['value'], 0, ',', '.');
                                                }
                                            ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <?= date('d/m/Y', strtotime($kupon['expiry_date'])); ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <?php
                                                $today = date('Y-m-d');
                                                $isExpired = $kupon['expiry_date'] < $today;
                                                
                                                if ($isExpired) {
                                                    echo '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Expired</span>';
                                                }
                                                 else {
                                                    echo '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="kupon-dropdown-button-<?= $kupon['id']; ?>" data-dropdown-toggle="kupon-dropdown-<?= $kupon['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /></svg>
                                            </button>
                                            <div id="kupon-dropdown-<?= $kupon['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="kupon-dropdown-button-<?= $kupon['id']; ?>">
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenKupon/detail/<?= $kupon['id']; ?>" class="block py-2 px-4 hover:bg-gray-100">Show</a></li>
                                                    <li><a href="<?= BASEURL; ?>/Admin/ManajemenKupon/edit/<?= $kupon['id']; ?>" class="block py-2 px-4 hover:bg-gray-100">Edit</a></li>
                                                </ul>
                                                <div class="py-1">
                                                    <a href="<?= BASEURL; ?>/Admin/ManajemenKupon/hapus/<?= $kupon['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                 </div> <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white"><?= $data['showing_from'] ?>-<?= $data['showing_to'] ?></span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white"><?= $data['total_results'] ?></span>
                    </span>
                    
                    <?php
                        // Bangun query string agar pencarian tidak hilang saat berpindah halaman
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
                                $prevHref = ($data['current_page'] > 1) ? BASEURL . '/Admin/ManajemenKupon?' . http_build_query($prevPageParams) : '#';
                            ?>
                            <a href="<?= $prevHref ?>"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] <= 1) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $data['total_pages']; $i++) : ?>
                        <li>
                            <?php
                                $pageParams = $queryParams;
                                $pageParams['page'] = $i;
                                $pageHref = BASEURL . '/Admin/ManajemenKupon?' . http_build_query($pageParams);
                            ?>
                            <a href="<?= $pageHref ?>"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight border border-gray-300 dark:border-gray-700 <?= ($i == $data['current_page']) ? 'z-10 text-blue-600  dark:text-white' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <li>
                            <?php
                                $nextPageParams = $queryParams;
                                $nextPageParams['page'] = $data['current_page'] + 1;
                                $nextHref = ($data['current_page'] < $data['total_pages']) ? BASEURL . '/Admin/ManajemenKupon?' . http_build_query($nextPageParams) : '#';
                            ?>
                            <a href="<?= $nextHref ?>"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] >= $data['total_pages']) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                            </a>
                        </li>
                    </ul>
                </nav>
         </div>
     </section>
 </main>

 </div>
 </div>