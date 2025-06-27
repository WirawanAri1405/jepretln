<body style="display:flex; justify-content:center; align-items:center; height:100vh; font-family:sans-serif;">
    <div style="text-align:center;">

        <img src="<?=BASEURL?>/assets/image/Animation - 1749272897904.gif" alt="check mark icon" 
             style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 16px; width: 150px; height: 150px;">

        <h1 style="color:#A67C52;">Registrasi Berhasil!</h1>
        <p>Selamat datang di platform JepretIn.</p>
        <p>Anda akan diarahkan ke halaman login dalam beberapa detik.</p>
    </div>

    <script>
        // Setelah 3 detik, pindah ke halaman login
        setTimeout(() => {
            window.location.href = "<?= BASEURL; ?>/users/login"; 
        }, 3000);
    </script>
</body>