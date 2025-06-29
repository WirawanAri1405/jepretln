<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function goBack() { window.history.back(); }
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9.27-3.11-10.542-7.5a10.05 10.05 0 012.09-3.368m1.446-1.446A10.05 10.05 0 0112 5c5 0 9.27 3.11 10.542 7.5a10.05 10.05 0 01-4.124 5.182M15 12a3 3 0 01-3 3m0 0a3 3 0 01-3-3m3 3L3 3"/>`;
            } else {
                input.type = "password";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</head>
<body class="bg-white text-black">

    <div class="absolute top-4 left-4">
        <button onclick="goBack()" class="text-black text-xl hover:text-gray-700 transition">
            <svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
        </button>
    </div>

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-sm px-4">
            
            <?php Flasher::flash(); ?>

            <div class="mb-4">
                <img src="<?=BASEURL?>/assets/image/Logo_Coklat_Nama.png" alt="logo" class="h-8 mb-2">
                <h3 class="text-2xl font-bold text-[#A67C52]">Registrasi</h3>
                <p class="text-gray-600">Buat akun untuk menggunakan platform JepretIn</p>
            </div>

            <form id="register-form" action="<?= BASEURL; ?>/users/Registrasi/proses" method="post">
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Nama Lengkap" class="mt-1 w-full border border-black p-2 rounded text-sm text-gray-700" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" required placeholder="contoh@gmail.com" class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700">
                </div>
                <div class="mb-3">
                    <label for="nomor" class="block text-sm font-medium">Nomor Handphone</label>
                    <input type="text" name="nomor" required placeholder="08xxxxxx" class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700">
                </div>
                <div class="mb-3 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700" placeholder="********">
                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <div class="mb-4 relative">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700" placeholder="********">
                    <button type="button" onclick="togglePassword('confirmPassword', 'eyeIcon2')" class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                         <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <button type="submit" name="register" class="w-full bg-[#A67C52] hover:bg-[#936D46] text-white font-semibold py-2 rounded">Registrasi</button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-4">
                Sudah Punya Akun?
                <a href="<?=BASEURL?>/Users/login" class="text-blue-600 hover:underline font-semibold">Masuk</a>
            </p>
        </div>
    </div>

</body>
</html>