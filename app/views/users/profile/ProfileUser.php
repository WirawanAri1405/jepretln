<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= BASEURL; ?>/js/goBack.js"></script>
    <script src="<?= BASEURL; ?>/js/date.js"></script>
</head>
<body>

<div class="absolute top-4 left-4">
    <button onclick="goBack()" class="text-black text-xl hover:text-gray-700 transition">
        <svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M13 5H1m0 0 4 4M1 5l4-4" />
        </svg>
    </button>
</div>

<div class="max-w-xl mx-auto bg-white p-6 mt-10 rounded-lg">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold">Selamat Datang, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
            <p id="date"></p>
        </div>
    </div>

    <div class="text-center mt-6">
    <img src="https://ui-avatars.com/api/?name=<?= urlencode($data['user']['name']) ?>&background=A67C52&color=fff&size=128&bold=true" 
         alt="Foto Profil <?= htmlspecialchars($data['user']['name']) ?>"
         class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-white shadow-lg"
    />

    <h3 class="mt-3 text-lg font-semibold"><?= htmlspecialchars($data['user']['name']) ?></h3>
    
    <p class="text-gray-500 text-sm"><?= htmlspecialchars($data['user']['email']) ?></p>
    </div>

    <div class="mt-6">
        <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Name</span>
            <span class="text-right"><?= htmlspecialchars($data['user']['name']) ?></span>
        </div>
        <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Email account</span>
            <span class="text-right"><?= htmlspecialchars($data['user']['email']) ?></span>
        </div>
        <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Nomor Handphone</span>
            <span class="text-right"><?= htmlspecialchars($data['user']['phone_number']) ?></span>
        </div>
        <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Lokasi</span>
            <span class="text-right"><?= htmlspecialchars($data['user']['address'] ?? 'Belum diatur') ?></span>
        </div>
    </div>

    <div class="flex justify-between items-center mt-6 w-full px-6">
        <button onclick="window.location.href='<?= BASEURL; ?>/Profile/edit'" class="bg-[#A67C52] hover:bg-[#8C6847] text-white px-4 py-2 rounded-md">
            Edit
        </button>

        <button onclick="logout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Log Out</button>
        <script>
            function logout() {
                if (confirm("Yakin ingin keluar?")) {
                    // PENYESUAIAN: Link diubah agar sesuai dengan route MVC
                    window.location.href = "<?= BASEURL; ?>/Users/login";
                }
            }   
        </script>
    </div>
</div>

</body>
</html>