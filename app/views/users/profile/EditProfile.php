<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/goBack.js"></script>
    <title>Edit Profil</title>
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

<div class="flex flex-col items-center justify-start pt-10 px-4">
    
    <form class="w-full max-w-2xl" action="AksiEditProfile.php" method="post" enctype="multipart/form-data">
        
        <div class="relative w-24 h-24 mb-6 mx-auto">
            <img src="<?= htmlspecialchars($profilePicPath) ?>?t=<?= $timestamp ?>"
                 id="profileImage"
                 alt="Profile Picture"
                 class="w-full h-full rounded-full object-cover border-4 border-white shadow">
            
            <label for="upload"
                   class="absolute bottom-0 right-0 bg-[#A67C52] hover:bg-[#8C6847] text-white rounded-full p-1 cursor-pointer text-sm">
                ✎
            </label>
            
            <input type="file" id="upload" name="profile_picture" accept="image/jpeg, image/png, image/jpg" class="hidden">
        </div>

        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" placeholder="Nama Lengkap"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" placeholder="Username"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nomor Handphone</label>
                <input type="text" name="nomor" value="<?= htmlspecialchars($data['no_hp']) ?>" placeholder="08xxxxxxxx"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" placeholder="nama@email.com"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="md:col-span-2"> <label class="block text-gray-700 font-medium mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" placeholder="Kota, Negara"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>
        </div>

        <div class="mt-8 flex justify-start">
            <button type="submit"
                    class="bg-[#A67C52] hover:bg-[#8C6847] text-white font-medium px-6 py-2 rounded-md">
                Simpan Perubahan
            </button>
            <a href="ProfileUser.php"
               class="ml-4 px-6 py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800">Kembali</a>
        </div>
    </form>
</div>

<script>
    const uploadInput = document.getElementById('upload');
    const profileImage = document.getElementById('profileImage');

    uploadInput.addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

</body>
</html>