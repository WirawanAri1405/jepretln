<main class="p-6">
    <section>
        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Edit Data Kupon</h1>
            
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">
                <form action="<?= BASEURL; ?>/Admin/ManajemenKupon/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['kupon']['id']; ?>">
                    
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="col-span-2">
                            <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Kupon</label>
                            <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required value="<?= htmlspecialchars($data['kupon']['code']); ?>">
                        </div>
                        
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Kupon</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"><?= htmlspecialchars($data['kupon']['description']); ?></textarea>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Diskon</label>
                            <select id="discount_type" name="discount_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="percentage" <?= ($data['kupon']['discount_type'] == 'percentage') ? 'selected' : ''; ?>>Percentage</option>
                                <option value="fixed" <?= ($data['kupon']['discount_type'] == 'fixed') ? 'selected' : ''; ?>>Fixed</option>
                            </select>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Diskon</label>
                            <input type="number" name="value" id="value" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required min="0" step="0.01" value="<?= $data['kupon']['value']; ?>">
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="expiry_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Kedaluwarsa</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="<?= $data['kupon']['expiry_date']; ?>">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Kupon
                    </button>
                    <a href="<?= BASEURL; ?>/Admin/ManajemenKupon" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </section>
</main>