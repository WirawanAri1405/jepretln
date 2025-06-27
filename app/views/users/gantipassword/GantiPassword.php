<!-- ForgotPassword.html -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-[#A67C52] mb-4">Lupa Password</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">Masukkan email kamu untuk menerima link reset password.</p>
        <form>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" required placeholder="asep@gmail.com"
                class="mt-1 w-full px-3 py-2 border border-black rounded text-gray-700 mb-4">

            <button type="submit"
                class="w-full bg-[#A67C52] hover:bg-[#936D46] text-white font-semibold py-2 rounded-md">
                Kirim Link Reset
            </button>
        </form>
        <div class="text-sm text-center mt-4">
            <a href="login.html" class="text-blue-600 hover:underline">Kembali ke login</a>
        </div>
    </div>
</body>

</html>