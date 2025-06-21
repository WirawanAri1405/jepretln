<main class="p-6">
    <section>
        <div class="max-w-screen-xl">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Edit Data Lokasi</h1>
            
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-4">
                <form action="<?= BASEURL; ?>/Admin/ManajemenLokasi/update" method="post">
                    <input type="hidden" name="id" value="<?= $data['lokasi']['id']; ?>">
                    
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" autocomplete="off"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Tulis nama disini" required
                                value="<?= htmlspecialchars($data['lokasi']['name']); ?>">
                        </div>
                        <div class="col-span-2">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="address" id="address" autocomplete="off"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Tulis alamat disini" required
                                value="<?= htmlspecialchars($data['lokasi']['address']); ?>">
                        </div>
                        <div class="col-span-2">
                            <label for="is_active" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="is_active" name="is_active"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="1" <?= ($data['lokasi']['is_active'] == 1) ? 'selected' : ''; ?>>Buka</option>
                                <option value="0" <?= ($data['lokasi']['is_active'] == 0) ? 'selected' : ''; ?>>Tutup</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Data
                    </button>
                    <a href="<?= BASEURL; ?>/Admin/ManajemenLokasi" class="text-gray-900 dark:text-white ml-2">Batal</a>
                </form>
            </div>
        </div>
    </section>
</main>