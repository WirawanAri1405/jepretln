<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi Berhasil</title>
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh; font-family:sans-serif;">
    <div style="text-align:center;">
        <img src="<?=BASEURL?>/assets/image/Animation - 1749272897904.gif" alt="check mark icon">
        <h1 style="color:#A67C52;">Registrasi Berhasil!</h1>
        <p>Selamat datang di platform JepretIn.</p>
        <p>Anda akan diarahkan ke halaman utama login beberapa detik</p>
    </div>

    <script>
        // Setelah 3 detik, pindah ke profile
        setTimeout(() => {
            window.location.href = "<?= BASEURL; ?>/Users/login/index"; 
        }, 3000);
    </script>
</body>
</html>
