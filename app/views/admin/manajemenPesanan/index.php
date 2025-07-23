<main class="p-6">
    <section>
        <div class="max-w-screen-xl mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter Status: <span class="font-semibold ml-1 capitalize"><?= str_replace('_', ' ', $data['active_filters']['status']) ?></span>
                        </button>
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                            <h6 class="mb-3 text-sm font-medium text-gray-900">Filter berdasarkan Status</h6>
                            <ul class="space-y-2 text-sm">
                                <li>
                                    <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan?status=semua&search=<?= urlencode($data['search_term'] ?? '') ?>" class="flex items-center">Semua Status</a>
                                </li>
                                <?php foreach ($data['statuses'] as $status): ?>
                                    <li>
                                        <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan?status=<?= $status; ?>&search=<?= urlencode($data['search_term'] ?? '') ?>" class="flex items-center capitalize"><?= str_replace('_', ' ', $status); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mx-5"><?php Flasher::flash(); ?></div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No. Pesanan</th>
                                <th scope="col" class="px-4 py-3">Pelanggan</th>
                                <th scope="col" class="px-4 py-3">Periode Sewa</th>
                                <th scope="col" class="px-4 py-3">Total</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['orders'])): ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada pesanan ditemukan.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data['orders'] as $order): ?>
                                    <tr class="border-b">
                                        <td class="px-4 py-3 "><?= htmlspecialchars($order['order_number']); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($order['customer_name']); ?></td>
                                        <td class="px-4 py-3"><?= date('d M Y', strtotime($order['rental_start_date'])); ?> - <?= date('d M Y', strtotime($order['rental_end_date'])); ?></td>
                                        <td class="px-4 py-3">Rp <?= number_format($order['total_amount'], 0, ',', '.'); ?></td>
                                        <td class="px-4 py-3"><span class="capitalize px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800"><?= str_replace('_', ' ', $order['status']); ?></span></td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-2">
                                                <form action="<?= BASEURL; ?>/Admin/ManajemenPesanan/updateStatus" method="POST" class="flex items-center space-x-2 ">
                                                    <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                                    <select name="status" class="text-xs rounded-lg border-gray-300 py-1 bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                        <?php foreach ($data['statuses'] as $status): ?>
                                                            <option value="<?= $status; ?>" <?= ($order['status'] == $status) ? 'selected' : ''; ?> class="capitalize">
                                                                <?= str_replace('_', ' ', $status); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="submit" class="text-white bg-green-600 hover:bg-green-700 text-xs px-2 py-1 rounded-lg">Update</button>
                                                </form>
                                                <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan/detail/<?= $order['id']; ?>" class="font-medium text-blue-600 hover:underline text-sm">Detail</a>
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
        // Logika untuk membangun parameter URL agar filter & search tidak hilang
        $queryParams = [];
        if (!empty($data['status_aktif']) && $data['status_aktif'] !== 'Semua') {
            $queryParams['statusFilter'] = $data['status_aktif'];
        }
        if (!empty($data['search_term'])) {
            $queryParams['search'] = $data['search_term'];
        }
        
        // Fungsi untuk membuat URL dengan parameter
        function generatePageUrl($page, $queryParams) {
            $pageParams = $queryParams;
            $pageParams['page'] = $page;
            return BASEURL . '/Admin/ManajemenPesanan?' . http_build_query($pageParams);
        }
    ?>

    <ul class="inline-flex items-stretch -space-x-px">
        <li>
            <a href="<?= ($data['current_page'] > 1) ? generatePageUrl($data['current_page'] - 1, $queryParams) : '#' ?>"
                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] <= 1) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </a>
        </li>

        <?php
            // --- LOGIKA PAGINASI BARU ---
            $currentPage = $data['current_page'];
            $totalPages = $data['total_pages'];
            $window = 1; // Jumlah halaman di kiri dan kanan halaman aktif

            for ($i = 1; $i <= $totalPages; $i++) {
                // Tampilkan halaman jika:
                // 1. Ini adalah halaman pertama atau terakhir
                // 2. Berada dalam "jendela" di sekitar halaman saat ini
                if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $window && $i <= $currentPage + $window)) {
                    echo '<li><a href="' . generatePageUrl($i, $queryParams) . '" class="flex items-center justify-center text-sm py-2 px-3 leading-tight border border-gray-300 dark:border-gray-700 ' . ($i == $currentPage ? 'z-10 text-blue-600 dark:text-white' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white') . '">' . $i . '</a></li>';
                } 
                // Tampilkan elipsis (...) jika ada jeda halaman
                elseif ($i == $currentPage - $window - 1 || $i == $currentPage + $window + 1) {
                    echo '<li><span class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</span></li>';
                }
            }
        ?>

        <li>
            <a href="<?= ($data['current_page'] < $data['total_pages']) ? generatePageUrl($data['current_page'] + 1, $queryParams) : '#' ?>"
                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 <?= ($data['current_page'] >= $data['total_pages']) ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white' ?>">
                <span class="sr-only">Next</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </a>
        </li>
    </ul>
</nav>
            </div>
        </div>
    </section>
</main>