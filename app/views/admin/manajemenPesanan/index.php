<main class="p-6">
    <section>
        <div class="max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-start md:space-x-3 flex-shrink-0">
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                Filter Status
                            </button>
                            <form id="filterForm" action="<?= BASEURL; ?>/Admin/ManajemenPesanan" method="GET">
                                <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_term'] ?? '') ?>">
                                <div id="filterDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-gray-100">Filter berdasarkan Status</h6>
                                    <ul class="space-y-2 text-sm mb-4" aria-labelledby="filterDropdownButton">
                                        <li class="flex items-center">
                                            <input id="status-semua" type="radio" name="status" value="" class="w-4 h-4" <?= empty($data['active_filters']['status']) ? 'checked' : ''; ?>>
                                            <label for="status-semua" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Semua Status</label>
                                        </li>
                                        <?php foreach ($data['order_statuses'] as $status) : ?>
                                            <li class="flex items-center">
                                                <input id="status-<?= $status; ?>" type="radio" name="status" value="<?= $status; ?>" class="w-4 h-4" <?= ($data['active_filters']['status'] == $status) ? 'checked' : ''; ?>>
                                                <label for="status-<?= $status; ?>" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100"><?= ucwords(str_replace('_', ' ', $status)); ?></label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Terapkan Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="mx-4">
                    <?php Flasher::flash(); ?>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID Pesanan</th>
                                <th scope="col" class="px-4 py-3">Pelanggan</th>
                                <th scope="col" class="px-4 py-3">Periode Sewa</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Total</th>
                                <th scope="col" class="px-4 py-3">Dibuat</th>
                                <th scope="col" class="px-4 py-3"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['orders'])) : ?>
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="7" class="px-4 py-3 text-center">Tidak ada data pesanan ditemukan.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($data['orders'] as $order) : ?>
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars($order['order_number']); ?></th>
                                        <td class="px-4 py-3"><?= htmlspecialchars($order['customer_name']); ?></td>
                                        <td class="px-4 py-3"><?= date('d M Y', strtotime($order['rental_start_date'])) . ' - ' . date('d M Y', strtotime($order['rental_end_date'])); ?></td>
                                        <td class="px-4 py-3">
                                            <?php
                                            $statusClasses = [
                                                'pending_payment'    => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                'paid'               => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'ready_for_pickup'   => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                'rented'             => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
                                                'returned'           => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                                'completed'          => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                'cancelled'          => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            ];
                                            $statusClass = $statusClasses[$order['status']] ?? 'bg-gray-200 text-gray-800';
                                            ?>

                                            <span class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded <?= $statusClass ?>">
                                                <?= ucwords(str_replace('_', ' ', $order['status'])); ?>
                                            </span>

                                        </td>
                                        <td class="px-4 py-3">Rp <?= number_format($order['total_amount'], 0, ',', '.'); ?></td>
                                        <td class="px-4 py-3"><?= date('d M Y, H:i', strtotime($order['created_at'])); ?></td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="order-dropdown-button-<?= $order['id']; ?>" data-dropdown-toggle="order-dropdown-<?= $order['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="order-dropdown-<?= $order['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="order-dropdown-button-<?= $order['id']; ?>">
                                                    <li>
                                                        <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan/detail/<?= $order['id']; ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Detail</a>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan/hapus/<?= $order['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen?');">
                                                        Delete
                                                    </a>
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
                    $queryParams = [];
                    if (!empty($data['search_term'])) {
                        $queryParams['search'] = $data['search_term'];
                    }
                    if (!empty($data['active_filters']['status'])) {
                        $queryParams['status'] = $data['active_filters']['status'];
                    }
                    ?>

                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <?php
                            $prevPageParams = $queryParams;
                            $prevPageParams['page'] = $data['current_page'] - 1;
                            $prevHref = ($data['current_page'] > 1) ? BASEURL . '/Admin/ManajemenPesanan?' . http_build_query($prevPageParams) : '#';
                            ?>
                            <a href="<?= $prevHref ?>" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] <= 1) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $data['total_pages']; $i++) : ?>
                            <li>
                                <?php
                                $isActive = ($i == $data['current_page']);

                                $baseClass = 'flex items-center justify-center text-sm py-2 px-3 leading-tight border border-gray-300 dark:border-gray-700';
                                $activeClass = 'z-10 text-blue-600 bg-blue-50 dark:text-white dark:bg-gray-700';
                                $defaultClass = 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white';
                                ?>
                                <a href="<?= $pageHref ?>" class="<?= $baseClass . ' ' . ($isActive ? $activeClass : $defaultClass) ?>">
                                    <?= $i; ?>
                                </a>

                            </li>
                        <?php endfor; ?>
                        <li>
                            <?php
                            $nextPageParams = $queryParams;
                            $nextPageParams['page'] = $data['current_page'] + 1;
                            $nextHref = ($data['current_page'] < $data['total_pages']) ? BASEURL . '/Admin/ManajemenPesanan?' . http_build_query($nextPageParams) : '#';
                            ?>
                            <a href="<?= $nextHref ?>" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] >= $data['total_pages']) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
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