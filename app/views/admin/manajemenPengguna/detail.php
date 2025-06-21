<main class="p-6">
    <section>
        <div class="max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-4xl mx-auto">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Detail Data Pengguna</h2>

                        <!-- ID & Nama -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ID</p>
                                <p class="font-medium text-gray-900 dark:text-white">5617</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">Abdi Wicaksono</p>
                            </div>
                        </div>

                        <!-- Email & Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                <p class="font-medium text-gray-900 dark:text-white">abdiwicak71@gmail.com</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Password</p>
                                <p class="font-medium text-gray-900 dark:text-white">********</p>
                            </div>
                        </div>

                        <!-- No HP & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No. Handphone</p>
                                <p class="font-medium text-gray-900 dark:text-white">08988325718</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                <p class="font-medium text-gray-900 dark:text-white">Active</p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                            <p class="font-medium text-gray-900 dark:text-white">Jl. Godean Km 7, Sleman</p>
                        </div>

                        <!-- Tombol Kembali -->
                        <div class="flex justify-end mt-6">
                            <a href="<?= BASEURL; ?>/Admin/ManajemenPengguna" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                                ← Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>