<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul'] ?? 'Jepretin'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-[#D6B49A] px-6 py-4">
    <div class="relative max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex-shrink-0">
            <a href="<?= BASEURL; ?>">
                <img src="<?= BASEURL ?>/assets/image/Logo_Putih_Nama.png" alt="Logo" class="h-12 object-contain" />
            </a>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 w-full max-w-md z-0">
            <input type="text" placeholder="Cari berdasarkan produk..."
                   class="w-full px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white text-sm shadow" />
        </div>

        <div class="flex items-center space-x-4 z-10">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center focus:outline-none">
                        <?php
                            // Logika untuk menampilkan foto profil (tetap sama)
                            $profilePicture = $_SESSION['profile_picture'] ?? '';
                            $userName = $_SESSION['user_name'] ?? 'User';
                            $fotoUrl = $profilePicture
                                ? BASEURL . '/assets/profile/' . $profilePicture
                                : 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=A67C52&color=fff&size=64&bold=true';
                        ?>
                        <img src="<?= $fotoUrl ?>" alt="Foto Profil" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow" />
                    </button>

                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                         style="display: none;">
                        
                        <div class="px-4 py-2 text-sm text-gray-700 border-b">
                            Masuk sebagai:<br>
                            <strong class="font-semibold"><?= htmlspecialchars($userName); ?></strong>
                        </div>
                        
                        <a href="<?= BASEURL; ?>/Users/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                        
                        <a href="<?= BASEURL; ?>/Users/profile/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
                        
                        <div class="border-t my-1"></div>
                        
                        <a href="<?= BASEURL; ?>/Users/login/logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                    </div>
                </div>

            <?php else: ?>
                <a href="<?= BASEURL ?>/users/registrasi"
                   class="px-4 py-2 bg-white text-[#8A6843] rounded-md hover:bg-gray-100 text-sm font-semibold transition">
                    Registrasi
                </a>
                <a href="<?= BASEURL ?>/users/login"
                   class="px-4 py-2 bg-[#8A6843] text-white rounded-md hover:bg-[#7a5934] text-sm font-semibold transition">
                    Login
                </a>
            <?php endif; ?>
        </div>
    </div>

    <nav class="mt-4 max-w-7xl mx-auto flex flex-wrap justify-center gap-2 text-white text-sm font-semibold">
        <?php if (!empty($data['kategori_nav'])): ?>
            <?php foreach ($data['kategori_nav'] as $kategori): ?>
                <a href="<?= BASEURL; ?>/kategori/index/<?= htmlspecialchars($kategori['slug']); ?>" class="transition hover:bg-white hover:text-[#6f5633] px-4 py-1 rounded-full">
                    <?= htmlspecialchars($kategori['name']); ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </nav>
</header>