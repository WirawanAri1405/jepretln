<!DOCTYPE html>
<html lang="id" data-bs-theme="dark"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #212529;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-container">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <img src="<?= BASEURL; ?>/assets/logo/Logo_Putih_Nama.png" alt="Logo Jepretin" style="width: 200px;">
                        </div>

                        <h3 class="card-title text-center mb-4">Admin Panel Login</h3>
                        
                        <form action="<?= BASEURL; ?>/admin/login/prosesLogin" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required autocomplete="off">
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            <?php 
                                // Memastikan sesi berjalan sebelum mengakses $_SESSION
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }
                                
                                // Cek apakah ada pesan error yang dikirim oleh Controller
                                if (isset($_SESSION['flash'])): 
                            ?>
                                <div class="text-center text-danger mt-3">
                                    <p class="mb-0"><?= htmlspecialchars($_SESSION['flash']['aksi']); ?></p>
                                </div>
                            <?php 
                                    // Hapus pesan error dari session setelah ditampilkan
                                    unset($_SESSION['flash']); 
                                endif; 
                            ?>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
