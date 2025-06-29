<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9.27-3.11-10.542-7.5
                        a10.05 10.05 0 012.09-3.368m1.446-1.446A10.05 10.05 0 0112 5c5 0
                        9.27 3.11 10.542 7.5a10.05 10.05 0 01-4.124 5.182M15 12a3 3 0
                        01-3 3m0 0a3 3 0 01-3-3m3 3L3 3" />`;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7
                        c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-[#A67C52] mb-4">Reset Password</h2>

        <!-- Notifikasi Flash (jika ada) -->
        <?php Flasher::flash(); ?>

        <form action="<?= BASEURL ?>/Users/gantipassword/reset" method="post">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" required placeholder="example@email.com"
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded mb-4">

            <!-- Ganti bagian ini dalam form -->
            <div class="mb-4 relative">
                <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" required
                    class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700" placeholder="********">
                <button type="button" onclick="togglePassword('password_baru', 'eyeIcon1')"
                    class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                    <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943
                            9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            <div class="mb-4 relative">
                <label for="konfirmasi_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password" required
                    class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700" placeholder="********">
                <button type="button" onclick="togglePassword('konfirmasi_password', 'eyeIcon2')"
                    class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                    <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943
                            9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            <button type="submit"
                class="w-full bg-[#A67C52] hover:bg-[#936D46] text-white font-semibold py-2 rounded-md">
                Reset Password
            </button>
        </form>

        <div class="text-sm text-center mt-4">
            <a href="<?= BASEURL ?>/users/login" class="text-blue-600 hover:underline">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
