<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Staff Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            
            <form class="p-4 md:p-5" action="<?= BASEURL; ?>/Admin/ManajemenStaff/tambah" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                     <div class="col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="phone_number" class="block mb-2 text-sm font-medium">No. Telepon</label>
                        <input type="tel" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="role_id" class="block mb-2 text-sm font-medium">Jabatan</label>
                        <select name="role_id" id="role_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <?php foreach($data['roles'] as $role): ?>
                                <option value="<?= $role['id']; ?>"><?= htmlspecialchars($role['display_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5"></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Tambahkan Staff
                </button>
            </form>
        </div>
    </div>
</div>