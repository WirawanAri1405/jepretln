<main class="p-6">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-gray-800 dark:text-gray-100">
        <h2 class="text-2xl font-bold mb-4">Edit Pesanan #<?= htmlspecialchars($data['order']['order_number']); ?></h2>
        <form action="<?= BASEURL; ?>/Admin/ManajemenPesanan/update" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?= $data['order']['id']; ?>">

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status Pesanan</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <?php foreach ($data['statuses'] as $status): ?>
                        <option value="<?= $status; ?>" <?= ($data['order']['status'] == $status) ? 'selected' : ''; ?> class="capitalize">
                            <?= str_replace('_', ' ', $status); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="subtotal" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Subtotal</label>
                    <input type="number" name="subtotal" id="subtotal" value="<?= $data['order']['subtotal']; ?>" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label for="discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Diskon</label>
                    <input type="number" name="discount_amount" id="discount_amount" value="<?= $data['order']['discount_amount']; ?>" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label for="insurance_fee" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Asuransi</label>
                    <input type="number" name="insurance_fee" id="insurance_fee" value="<?= $data['order']['insurance_fee']; ?>" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label for="deposit_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jaminan</label>
                    <input type="number" name="deposit_amount" id="deposit_amount" value="<?= $data['order']['deposit_amount']; ?>" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                </div>
            </div>

            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Total Biaya</label>
                <input type="number" name="total_amount" id="total_amount" value="<?= $data['order']['total_amount']; ?>" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
            </div>

            <div>
                <label for="internal_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Catatan Internal</label>
                <textarea name="internal_notes" id="internal_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"><?= htmlspecialchars($data['order']['internal_notes']); ?></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan/detail/<?= $data['order']['id']; ?>" class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-100 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>