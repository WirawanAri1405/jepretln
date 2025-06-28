<?php

class ManajemenProduk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Manajemen Produk';
        $product_model = $this->model('Product_model');

        // Mengambil parameter dari URL (Cukup sekali)
        $search_term = $_GET['search'] ?? null;
        $filters = [
            'brand_id' => $_GET['brand_id'] ?? null,
            'category_id' => $_GET['category_id'] ?? null
        ];

        // Menyiapkan data untuk View (termasuk navbar dan form filter)
        $data['search_action'] = BASEURL . '/Admin/ManajemenProduk';
        $data['search_placeholder'] = 'Cari produk...';
        $data['search_term'] = $search_term;
        $data['active_filters'] = $filters;

        // Mengambil data untuk pilihan filter
        $data['brands'] = $product_model->getAllBrands();
        $data['categories'] = $product_model->getAllCategories();

        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;

        // Memanggil model dengan parameter yang benar
        $total_results = $product_model->countAllProducts($search_term, $filters);
        $total_pages = ceil($total_results / $results_per_page);
        $data['products'] = $product_model->getAllProducts($search_term, $filters, $results_per_page, $offset);

        // Menyiapkan data paginasi untuk View
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua View
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenProduk/index', $data);
        $this->view('admin/manajemenProduk/form_modal', $data);
        $this->view('admin/templates/footer');
    }


    private function uploadMultipleImages()
    {
        // Pastikan ada file yang dikirim
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            Flasher::setFlash('Upload Gagal', 'Anda harus memilih setidaknya satu gambar.', 'danger');
            return false;
        }

        $uploadedFiles = [];
        $files = $_FILES['images'];
        $fileCount = count($files['name']);
        $uploadPath = dirname(__DIR__, 3) . '/public/assets/produk/';

        // Pastikan direktori tujuan ada, jika tidak, coba buat
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        for ($i = 0; $i < $fileCount; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue; // Lewati jika ada error pada file ini
            }

            $tmpName = $files['tmp_name'][$i];
            $namaFile = $files['name'][$i];

            // Validasi Ekstensi
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                Flasher::setFlash('Upload Gagal', "Format file '$namaFile' tidak didukung (hanya JPG, JPEG, PNG).", 'danger');
                return false;
            }

            // Generate nama unik untuk file
            $namaFileBaru = uniqid('produk-', true) . '.' . $ekstensiGambar;

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($tmpName, $uploadPath . $namaFileBaru)) {
                $uploadedFiles[] = $namaFileBaru;
            } else {
                Flasher::setFlash('Upload Gagal', "Gagal memindahkan file '$namaFile'.", 'danger');
                return false;
            }
        }
        return $uploadedFiles;
    }

    /**
     * Memproses data dari form tambah produk.
     */
    public function tambah()
    {
        // 1. Proses upload semua gambar
        $uploadedImages = $this->uploadMultipleImages();

        // 2. Jika upload gagal, hentikan proses dan kembali
        if ($uploadedImages === false) {
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }
        // Ambil array spesifikasi dari form dan ubah menjadi JSON
        $spesifikasi = $_POST['spesifikasi'] ?? [];
        $spesifikasiJson = json_encode($spesifikasi);

        // 3. Siapkan semua data untuk dikirim ke model
        $data = [
            'name' => $_POST['name'],
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']))),
            'category_id' => $_POST['category_id'],
            'brand_id' => $_POST['brand_id'],
            'daily_rental_price' => $_POST['daily_rental_price'],
            'stock_quantity' => $_POST['stock_quantity'],
            'description' => $_POST['description'],
            'images' => $uploadedImages, // Array berisi nama-nama file yang berhasil di-upload
            'specifications' => $spesifikasiJson // Simpan string JSON
        ];

        // 4. Panggil model untuk menyimpan data ke database
        if ($this->model('Product_model')->tambahProduk($data) > 0) {
            Flasher::setFlash('Produk', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal ditambahkan ke database', 'danger');
        }

        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }

    public function hapus($id)
    {
        $produk_model = $this->model('Product_model');

        // 1. Ambil semua nama file gambar yang terkait dengan produk ini
        $gambarProduk = $produk_model->getGambarByProdukId($id);

        // 2. Hapus setiap file gambar dari server
        if ($gambarProduk) {
            foreach ($gambarProduk as $gambar) {
                // Jangan hapus gambar default
                if ($gambar['image_path'] != 'default.jpg') {
                    $pathFile = dirname(__DIR__, 3) . '/public/assets/produk/' . $gambar['image_path'];
                    if (file_exists($pathFile)) {
                        unlink($pathFile);
                    }
                }
            }
        }

        // 3. Hapus data produk dari database
        // (Ini akan otomatis menghapus data di 'product_images' karena ON DELETE CASCADE)
        if ($produk_model->hapusDataProduk($id) > 0) {
            Flasher::setFlash('Produk', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal dihapus', 'danger');
        }

        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }

    // Anda bisa menambahkan method 'detail($id)', 'edit($id)', dan 'update()' di sini
    public function detail($id)
    {

        $data['judul'] = 'Detail Produk';

        // Panggil fungsi model yang sudah kita kenal
        $produk = $this->model('Product_model')->getProdukByIdWithImages($id);

        // --- PENGECEKAN KUNCI ---
        // Gunakan '=== false' untuk perbandingan yang lebih akurat
        if ($produk === false) {
            Flasher::setFlash('Produk', 'tidak ditemukan dengan ID ' . htmlspecialchars($id), 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }

        // Jika berhasil, kirim data ke view
        $data['product'] = $produk;

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenProduk/detail', $data);
        $this->view('admin/templates/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Produk';
        $produk_model = $this->model('Product_model');

        $data['produk'] = $produk_model->getProdukByIdWithImages($id);
        if (!$data['produk']) {
            Flasher::setFlash('Produk', 'tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
            exit;
        }

        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $data['merek'] = $this->model('Merek_model')->getAllMerek();

        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenProduk/edit', $data);
        $this->view('admin/templates/footer');
    }

    // Ganti method update lama Anda dengan yang ini
    public function update()
    {
        $produk_model = $this->model('Product_model');

        // 1. Hapus gambar lama yang ditandai untuk dihapus
        if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
            foreach ($_POST['delete_images'] as $imageId) {
                $gambar = $produk_model->getGambarById($imageId);
                if ($gambar) {
                    unlink(dirname(__DIR__, 3) . '/public/assets/produk/' . $gambar['image_path']);
                    $produk_model->hapusGambarById($imageId);
                }
            }
        }

        // 2. Upload gambar baru jika ada
        $newImages = [];
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $newImages = $this->uploadMultipleImages();
        }

        // 3. Rakit data untuk update
        $_POST['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        $_POST['specifications'] = json_encode($_POST['spesifikasi'] ?? []);
        $_POST['new_images'] = $newImages;

        // 4. Panggil model untuk update
        if ($produk_model->updateDataProduk($_POST) >= 0) { // >= 0 karena bisa jadi tidak ada perubahan
            Flasher::setFlash('Produk', 'berhasil diupdate', 'success');
        } else {
            Flasher::setFlash('Produk', 'gagal diupdate', 'danger');
        }

        header('Location: ' . BASEURL . '/Admin/ManajemenProduk');
        exit;
    }
}
