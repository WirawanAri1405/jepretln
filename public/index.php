<?php

// Mulai sesi di paling atas, karena kita akan memeriksanya segera.
if (!session_id()) {
    session_start();
}

// Muat file konfigurasi untuk BASEURL
require_once '../app/config/config.php';

// --- PENJAGA KEAMANAN AREA ADMIN (VERSI FINAL) ---

function parseURL_sec() {
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
    return [];
}

$url = parseURL_sec();

// Cek apakah rute yang diminta adalah rute admin
if (isset($url[0]) && strtolower($url[0]) === 'admin') {
    
    // Ambil nama controller dari URL. Jika tidak ada, defaultnya adalah 'Login'.
    $requestedControllerName = $url[1] ?? 'Login';

    // Pengecualian: Jika controller yang diminta ADALAH 'Login', JANGAN lakukan pemeriksaan sesi.
    // Ini untuk mencegah redirect loop.
    if (strtolower($requestedControllerName) !== 'login') {
        
        // Untuk semua controller admin LAINNYA, lakukan pemeriksaan sesi yang ketat.
        if (empty($_SESSION['is_logged_in']) || empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            
            // Jika tidak valid, tendang ke halaman login.
            require_once '../app/core/Flasher.php';
            Flasher::setFlash('Gagal', 'Akses ditolak. Silakan login sebagai admin.', 'danger');
            header('Location: ' . BASEURL . '/admin/login');
            exit; // Hentikan eksekusi.
        }
    }
}

// --- AKHIR DARI PENJAGA KEAMANAN ---


// Jika lolos dari penjaga keamanan, baru muat sisa aplikasi.
require_once '../app/init.php';

$app = new App;