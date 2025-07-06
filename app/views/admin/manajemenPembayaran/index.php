<main class="p-6">
     <section>
         <div class="max-w-screen-xl">
             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                 <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                     <div class="flex items-center space-x-3 w-full md:w-auto">
                         <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100" type="button">
                             <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" /></svg>
                             Filter Status
                         </button>
                         <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                             <form action="<?= BASEURL; ?>/Admin/ManajemenPembayaran" method="GET">
                                <input type="hidden" name="search" value="<?= htmlspecialchars($data['search_term'] ?? '') ?>">
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center">
                                        <input id="status_semua" type="radio" name="status" value="semua" class="w-4 h-4 text-blue-600" onchange="this.form.submit()" <?= ($data['status_aktif'] == 'semua') ? 'checked' : ''; ?>>
                                        <label for="status_semua" class="ml-2">Semua</label>
                                    </li>
                                    <?php foreach ($data['statuses'] as $status): ?>
                                    <li class="flex items-center">
                                        <input id="status_<?= $status ?>" type="radio" name="status" value="<?= $status ?>" class="w-4 h-4 text-blue-600" onchange="this.form.submit()" <?= ($data['status_aktif'] == $status) ? 'checked' : ''; ?>>
                                        <label for="status_<?= $status ?>" class="ml-2"><?= ucfirst($status) ?></label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                             </form>
                         </div>
                     </div>
                 </div>
                 <div class="mx-5"><?php Flasher::flash(); ?></div>
                 <div class="overflow-x-auto">
                     <table class="w-full text-sm text-left text-gray-500">
                         <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                             <tr>
                                 <th scope="col" class="px-4 py-3">ID Pembayaran</th>
                                 <th scope="col" class="px-4 py-3">No. Pesanan</th>
                                 <th scope="col" class="px-4 py-3">Jumlah</th>
                                 <th scope="col" class="px-4 py-3">Metode</th>
                                 <th scope="col" class="px-4 py-3">Tgl. Bayar</th>
                                 <th scope="col" class="px-4 py-3">Status</th>
                                 <th scope="col" class="px-4 py-3">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php if (empty($data['payments'])): ?>
                                <tr><td colspan="7" class="px-4 py-4 text-center">Tidak ada data pembayaran.</td></tr>
                            <?php else: ?>
                                <?php foreach ($data['payments'] as $payment): ?>
                                    <tr class="border-b">
                                        <td class="px-4 py-3 font-medium"><?= $payment['id']; ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($payment['order_number']); ?></td>
                                        <td class="px-4 py-3">Rp <?= number_format($payment['amount'], 0, ',', '.'); ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($payment['payment_method']); ?></td>
                                        <td class="px-4 py-3"><?= $payment['payment_date'] ? date('d M Y', strtotime($payment['payment_date'])) : '-'; ?></td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                <?php 
                                                    switch($payment['status']) {
                                                        case 'success': echo 'bg-green-100 text-green-800'; break;
                                                        case 'failed': case 'refunded': echo 'bg-red-100 text-red-800'; break;
                                                        default: echo 'bg-yellow-100 text-yellow-800';
                                                    }
                                                ?>">
                                                <?= ucfirst($payment['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <form action="<?= BASEURL; ?>/Admin/ManajemenPembayaran/updateStatus" method="POST" class="flex items-center">
                                                <input type="hidden" name="payment_id" value="<?= $payment['id']; ?>">
                                                <select name="status" class="text-xs rounded-lg border-gray-300">
                                                    <?php foreach ($data['statuses'] as $status): ?>
                                                        <option value="<?= $status ?>" <?= $payment['status'] == $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="ml-2 text-white bg-blue-600 hover:bg-blue-700 text-xs px-2 py-1 rounded-lg">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                         </tbody>
                     </table>
                 </div>
                 </div>
         </div>
     </section>
 </main>