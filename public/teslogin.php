<?php
// File: public/tes_php.php

echo '<pre>';

echo '<h2>Tes Fungsi Inti password_verify() di PHP</h2>';
echo 'Versi PHP Anda saat ini: ' . PHP_VERSION . "\n\n";

$passwordAsli = 'abc';
$hashYangBenar = '$2y$10$G0o4wL/2gR9vYqD.zUeI8e9W2C2xP.5yVrvj8uWhXmSUT1f3gqY.a';

echo "Password yang akan diverifikasi: '" . $passwordAsli . "'\n";
echo "Hash yang akan digunakan      : '" . $hashYangBenar . "'\n\n";

// Menjalankan fungsi inti PHP secara langsung
$hasilVerifikasi = password_verify($passwordAsli, $hashYangBenar);

echo "Hasil dari password_verify(): ";
var_dump($hasilVerifikasi);

echo "\n<hr><h3>Kesimpulan</h3>";
if ($hasilVerifikasi) {
    echo "<p style='color:green; font-size:1.2em;'><strong>SUKSES!</strong> Fungsi password_verify() di lingkungan PHP Anda bekerja dengan normal.</p>";
    echo "<p>Jika ini berhasil tapi login tetap gagal, berarti ada masalah yang sangat aneh saat data diambil dari database.</p>";
} else {
    echo "<p style='color:red; font-size:1.2em;'><strong>MASALAH DITEMUKAN PADA LINGKUNGAN PHP ANDA.</strong></p>";
    echo "<p>Fungsi `password_verify()` di server Anda gagal memverifikasi hash yang valid. Ini BUKAN kesalahan kode aplikasi Anda, melainkan masalah pada instalasi PHP di server (misalnya XAMPP, WAMP, atau hosting Anda).</p>";
}

echo '</pre>';