        <div class="flex-1 flex flex-col  min-w-0">
            <header class="bg-white dark:bg-gray-800 px-6 py-4 flex justify-between items-center border-b dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="p-2 md:hidden block text-gray-700 dark:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
                </div>
                <?php // Tampilkan form pencarian HANYA JIKA variabel search_action di-set oleh controller 
                ?>
                <?php if (isset($data['search_action'])): ?>
                    <div class="relative flex-1 max-w-md ml-4">
                        <form action="<?= $data['search_action']; ?>" method="GET">
                            <input type="text" name="search" placeholder="<?= $data['search_placeholder'] ?? 'Cari...'; ?>"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                value="<?= htmlspecialchars($data['search_term'] ?? '') ?>" />

                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
                            </svg>
                    </div>
                    </form>
                <?php endif; ?>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 dark:text-gray-200">
                        <?php //mendisplay user name admin mengunakan htmlspecialchars untuk keamanan 
                        ?>
                        Hello, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?>
                    </span>
                    <?php
                    // Logika untuk menampilkan foto profil (tetap sama)
                    $profilePicture = $_SESSION['profile_picture'] ?? '';
                    $userName = $_SESSION['user_name'] ?? 'User';
                    $fotoUrl = $profilePicture
                        ? BASEURL . '/assets/profile/' . $profilePicture
                        : 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=A67C52&color=fff&size=64&bold=true';
                    ?>
                    <img src="<?= $fotoUrl ?>" alt="Foto Profil" class="w-8 h-8 rounded-full" />
                </div>
            </header>