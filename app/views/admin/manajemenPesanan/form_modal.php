<div id="status-update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="status-update-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Update Status Pesanan</h3>
            <p id="modal-order-number" class="mb-4 font-light text-gray-500"></p>
            <form id="status-update-form" action="<?= BASEURL; ?>/Admin/ManajemenPesanan/updateStatus" method="POST">
                <input type="hidden" name="order_id" id="modal-order-id">
                <select name="status" id="modal-order-status" class="w-full p-2.5 text-gray-500 bg-white border rounded-md shadow-sm outline-none focus:border-indigo-600">
                    <?php foreach($data['statuses'] as $status): ?>
                        <option value="<?= $status; ?>" class="capitalize"><?= str_replace('_', ' ', $status); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="flex justify-center items-center space-x-4 mt-4">
                    <button data-modal-toggle="status-update-modal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>