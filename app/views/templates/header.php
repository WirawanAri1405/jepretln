<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul'] ?? 'Jepretin'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-[#D6B49A] px-6 py-4">
    <div class="relative max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <img src="<?= BASEURL ?>/assets/image/Logo_Putih_Nama.png" alt="Logo" class="h-12 object-contain" />
        </div>

        <!-- Search Bar -->
        <div class="absolute left-1/2 transform -translate-x-1/2 w-full max-w-md z-0">
            <input type="text" placeholder="Cari berdasarkan lokasi..."
                class="w-full px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white text-sm shadow" />
        </div>

        <!-- Tombol dinamis berdasarkan status login -->
        <div class="flex items-center space-x-4 z-10">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <!-- Jika sudah login -->
      

        <a href="<?= BASEURL ?>/users/profile">
            <?php
                $profilePicture = $_SESSION['profile_picture'] ?? '';
                $userName = $_SESSION['user_name'] ?? 'User';
                $fotoUrl = $profilePicture
                    ? BASEURL . '/assets/profile/' . $profilePicture
                    : 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=A67C52&color=fff&size=64&bold=true';
            ?>
            <img src="<?= $fotoUrl ?>"
                 alt="Foto Profil"
                 class="w-9 h-9 rounded-full object-cover border-2 border-white shadow" />
        </a>
    <?php else: ?>
        <!-- Jika belum login -->
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

    <!-- Navigation Links -->
<nav class="mt-4 max-w-7xl mx-auto flex flex-wrap justify-center gap-2 text-white text-sm font-semibold">
    <?php if (!empty($data['kategori_nav'])): ?>
        <?php foreach ($data['kategori_nav'] as $kategori): ?>
            <a href="<?= BASEURL; ?>/kategori/<?= htmlspecialchars($kategori['slug']); ?>" class="transition hover:bg-white hover:text-[#6f5633] px-4 py-1 rounded-full">
                <?= htmlspecialchars($kategori['name']); ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</nav>

</header>
