<div id="backdrop" class="fixed inset-0 bg-gray-900/50 z-30 hidden md:hidden"
        onclick="closeMobileSidebar()">
    </div>

    <div class="flex min-h-screen">

        <div id="sidebar"
            class="sidebar bg-white dark:bg-gray-800 w-64 transition-all duration-300 overflow-visible shadow-md fixed md:static inset-y-0 left-0 z-40 -translate-x-full md:translate-x-0">

            <div class="flex items-center justify-between p-4 mt-3.5 border-b dark:border-gray-700">
                <span
                    class="sidebar-label font-bold transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap text-gray-900 dark:text-white"
                    id="sidebar-title">JEPRETLN</span>
                <button onclick="toggleSidebar()" class="p-1 hover:bg-gray-200 dark:hover:bg-gray-700 rounded text-gray-700 dark:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <nav class="p-4 space-y-2 relative">
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenProduk" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-box-seam"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">manajemen
                            produk</span>

                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Produk
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenKategori" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-grid"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Kategori</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Kategori
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenMerek" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-award"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Merek</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Merek
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenPesanan" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-receipt"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Pesanan</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Pesanan
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenPengguna" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-people"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Pengguna</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Pengguna
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenStaff" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-person-badge"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Staff</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Staff
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenPembayaran" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-cash-coin"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Pembayaran</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Pembayaran
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenFAQ" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-chat-left-dots"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            FAQ</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen FAQ
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenKupon" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-ticket"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Kupon</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Kupon
                    </div>
                </div>
                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/ManajemenLokasi" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-building"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Manajemen
                            Lokasi</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Lokasi
                    </div>
                </div>
                                <div class="relative group">
                    <a href="<?= BASEURL; ?>/Admin/LaporanKinerja" class="flex items-center gap-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                        <i class="bi bi-building"></i>
                        <span
                            class="sidebar-label transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">Laporan Kinerja</span>
                    </a>
                    <div
                        class="tooltip absolute left-full top-1/2 -translate-y-1/2 ml-2 bg-black text-white text-sm rounded px-2 py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap">
                        Laporan Kinerja
                    </div>
                </div>
            </nav>
        </div>