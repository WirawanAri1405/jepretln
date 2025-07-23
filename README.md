# 📸 Jepretln - Aplikasi Penyewaan Kamera

> **Jepretln** adalah aplikasi web berbasis PHP yang dibangun sebagai *final project* untuk mata kuliah Pemrograman Basis Data. Aplikasi ini mensimulasikan platform penyewaan kamera dan peralatannya, lengkap dengan sistem manajemen untuk admin dan antarmuka untuk pengguna. Proyek ini mendemonstrasikan implementasi konsep-konsep basis data tingkat lanjut dalam sebuah aplikasi nyata.

---

## ✨ Fitur Utama

### Fitur Pengguna
-   Registrasi dan Login Pengguna.
-   Katalog Produk dengan pencarian dan filter.
-   Detail Produk dan Spesifikasi.
-   Proses Pemesanan dan *Checkout*.
-   Profil Pengguna dan Riwayat Pesanan.

### Fitur Panel Admin
-   Dashboard Kinerja.
-   Manajemen **CRUD** (Create, Read, Update, Delete) untuk:
    -   Produk
    -   Kategori & Merek
    -   Pesanan
    -   Pengguna & Staff
    -   Lokasi, Kupon, dan FAQ
-   Manajemen Pembayaran.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: PHP (Native dengan arsitektur **MVC**)
-   **Frontend**: HTML, CSS, JavaScript, **Tailwind CSS**
-   **Database**: MySQL / MariaDB
-   **Web Server**: Apache (via **XAMPP**)

---

## 🗃️ Struktur Basis Data

Basis data `jepretln` dirancang untuk mengelola semua data secara efisien dengan menggunakan relasi yang tepat.
-   **Relasi One-to-Many**: Satu `users` bisa melakukan banyak `orders`.
-   **Relasi Many-to-Many**: `users` dan `roles` dihubungkan melalui tabel pivot `user_roles` untuk memungkinkan pengguna memiliki lebih dari satu peran.
-   **Tabel Utama**: `users`, `products`, `orders`, `categories`, `brands`, `roles`.

![ERD Jepretln](public/assets/image/EDS.png)

---

## 🚀 Instalasi dan Konfigurasi

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1.  **Prasyarat**:
    * Pastikan Anda sudah menginstal **XAMPP** atau server lokal sejenis yang menyertakan Apache, PHP, dan MySQL/MariaDB.

2.  **Clone Repositori**:
    ```bash
    git clone [https://github.com/nama-anda/jepretln.git](https://github.com/nama-anda/jepretln.git)
    cd jepretln
    ```

3.  **Impor Database**:
    * Buka **phpMyAdmin**.
    * Buat database baru dengan nama `jepretln`.
    * Impor file `jepretln (7).sql` ke dalam database yang baru saja Anda buat.

4.  **Konfigurasi Koneksi**:
    * Buka file `app/config/config.php`.
    * Sesuaikan nilai `DB_HOST`, `DB_USER`, `DB_PASS`, dan `DB_NAME` dengan konfigurasi XAMPP Anda.

5.  **Jalankan Aplikasi**:
    * Letakkan folder proyek di dalam direktori `htdocs` XAMPP Anda.
    * Buka browser dan akses `http://localhost/jepretln/public`.

---

## 💡 Implementasi Fitur Pemrograman Basis Data

Proyek ini secara khusus mengimplementasikan fitur-fitur database sesuai dengan requirement mata kuliah:

-   **Function**: Dibuat 2 *function* untuk menghitung **total produk tersedia** dan **total pendapatan** berdasarkan rentang tanggal.
-   **Stored Procedure**: Dibuat 2 *stored procedure* untuk **mengecek pesanan yang tertunda** dan **memperbarui stok produk** secara aman menggunakan parameter `IN` dan `OUT`.
-   **Trigger**: Diimplementasikan 3 *trigger* (**`BEFORE INSERT`**, **`AFTER UPDATE`**, **`BEFORE DELETE`**) untuk validasi data, logging, dan menjaga integritas data.
-   **Index**: Dibuat **composite index** pada tabel `orders` yang berisi ribuan data untuk mendemonstrasikan peningkatan performa *query* secara signifikan menggunakan `EXPLAIN`.
-   **View**: Dibuat 3 jenis *view* (**Horizontal**, **Vertical**, dan **View inside View**) untuk menyederhanakan *query* dan menerapkan keamanan data.
-   **Database Security**: Dibuat 3 **user** dan 3 **role** baru dengan hak akses yang berbeda-beda untuk membuktikan implementasi keamanan pada level database.
