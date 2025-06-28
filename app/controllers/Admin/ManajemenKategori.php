<?php

class ManajemenKategori extends Controller
{
    // ... (metode index, hapus, edit yang sudah ada) ...
    public function index()
    {
        $data['judul'] = 'Manajemen Kategori';
        $kategori_model = $this->model('Kategori_model');

        // Ambil parameter pencarian dari URL
        $search_term = $_GET['search'] ?? null;

        // Data untuk view (termasuk navbar dinamis)
        $data['search_action'] = BASEURL . '/Admin/ManajemenKategori';
        $data['search_placeholder'] = 'Cari nama atau slug kategori...';
        $data['search_term'] = $search_term;
        
        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        // Ambil total data dan data per halaman dari model
        $total_results = $kategori_model->countAllKategori($search_term);
        $total_pages = ceil($total_results / $results_per_page);
        $data['kategori'] = $kategori_model->getAllKategori($search_term, $results_per_page, $offset);

        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua view
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenKategori/index', $data);
        $this->view('admin/manajemenKategori/form_modal', $data);
        $this->view('admin/templates/footer');
    }
    /**
     * Fungsi helper untuk mengubah array keys dan values menjadi format JSON
     */
    private function buildSpecJson($keys, $values)
    {
        $fields = [];
        if (!empty($keys) && count($keys) === count($values)) {
            for ($i = 0; $i < count($keys); $i++) {
                if (!empty(trim($keys[$i])) && !empty(trim($values[$i]))) {
                    $fields[trim($keys[$i])] = trim($values[$i]);
                }
            }
        }
        return json_encode(['fields' => $fields]);
    }
     private function upload()
    {
        // Pastikan ada file yang di-upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
            return 'default.jpg'; // Tidak ada file baru, kembalikan default
        }

        $file = $_FILES['image'];
        $namaFile = $file['name'];
        $ukuranFile = $file['size'];
        $error = $file['error'];
        $tmpName = $file['tmp_name'];

        // Cek jika ada error saat proses upload di PHP
        if ($error !== UPLOAD_ERR_OK) {
            Flasher::setFlash('Upload Gagal', 'Terjadi kesalahan internal saat upload.', 'danger');
            return false;
        }

        // 1. Validasi Ekstensi File (Cara Aman)
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            Flasher::setFlash('Upload Gagal', 'Format file harus JPG, JPEG, atau PNG.', 'danger');
            return false;
        }

        // 2. Validasi Ukuran File (Maks 2MB)
        if ($ukuranFile > 10000000) {
            Flasher::setFlash('Upload Gagal', 'Ukuran gambar maksimal adalah 10MB.', 'danger');
            return false;
        }

        // 3. Generate Nama File Baru yang Unik
        $namaFileBaru = uniqid('kategori-', true) . '.' . $ekstensiGambar;

        // 4. Tentukan Path Tujuan yang Absolut dan Aman
        // __DIR__ akan mengambil direktori dari file controller ini
        // kita perlu naik beberapa level ke root proyek, lalu ke public/assets/kategori
        $destinationPath = dirname(__DIR__, 3) . '/public/assets/kategori/' . $namaFileBaru;

        // Cek apakah direktori tujuan ada, jika tidak, coba buat
        $destinationDir = dirname($destinationPath);
        if (!is_dir($destinationDir)) {
            if (!mkdir($destinationDir, 0755, true)) {
                Flasher::setFlash('Upload Gagal', 'Gagal membuat direktori tujuan.', 'danger');
                return false;
            }
        }

        // 5. Pindahkan File dan Beri Notifikasi Error jika Gagal
        if (move_uploaded_file($tmpName, $destinationPath)) {
            return $namaFileBaru; // Sukses, kembalikan nama file baru
        } else {
            Flasher::setFlash('Upload Gagal', 'Gagal memindahkan file. Periksa izin folder.', 'danger');
            return false; // Gagal memindahkan file
        }
    }

    public function tambah()
    {
        $gambar = $this->upload();
        
        // Jika fungsi upload mengembalikan false, berarti ada error
        if ($gambar === false) {
            // Redirect kembali ke halaman utama, Flasher sudah di-set di dalam fungsi upload
            header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        // 3. Rakit data JSON dari form spesifikasi
        $specTemplateJson = $this->buildSpecJson($_POST['spec_keys'] ?? [], $_POST['spec_values'] ?? []);

        
        // Kita tidak lagi butuh spec_template di sini karena sudah ditangani di form edit
        $data = [
            'name' => $_POST['name'],
            'slug' => $slug,
            'spec_template' => $specTemplateJson,
            'image' => $gambar
        ];

        if ($this->model('Kategori_model')->tambahDataKategori($data) > 0) {
            Flasher::setFlash('Kategori', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Kategori', 'gagal ditambahkan ke database', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }


   public function edit($id)
    {
        $data['judul'] = 'Edit Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
        
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/edit', $data);
        $this->view('admin/templates/footer');
    }

         public function update()
    {
        // Cek apakah ada file gambar baru yang diunggah
        if ($_FILES['image']['error'] === 4) {
            $gambar = $_POST['gambarLama'];
        } else {
            $gambar = $this->upload();
            if ($gambar === false) {
                header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
                exit;
            }
            
            // --- PERBAIKAN PATH UNLINK ---
            if ($_POST['gambarLama'] != 'default.jpg') {
                // Gunakan metode path yang SAMA PERSIS dengan fungsi upload
                $pathFileLama = dirname(__DIR__, 3) . '/public/assets/kategori/' . $_POST['gambarLama'];
                if (file_exists($pathFileLama)) {
                    unlink($pathFileLama);
                }
            }
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        $specTemplateJson = $this->buildSpecJson($_POST['spec_keys'] ?? [], $_POST['spec_values'] ?? []);
        
        $data = [
            'id'            => $_POST['id'],
            'name'          => $_POST['name'],
            'slug'          => $slug,
            'spec_template' => $specTemplateJson,
            'image'         => $gambar
        ];
        
        if ($this->model('Kategori_model')->updateDataKategori($data) > 0) {
            Flasher::setFlash('Kategori', 'berhasil diubah', 'success');
        } else {
            Flasher::setFlash('Kategori', 'tidak ada perubahan data', 'info');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
        public function detail($id)
    {
        $data['judul'] = 'Detail Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
        $this->view('admin/templates/header', $data);
        $this->view('admin/manajemenKategori/detail', $data);
        $this->view('admin/templates/footer');
    }
  public function hapus($id)
    {
        // 1. Ambil data kategori untuk mendapatkan nama file gambar
        $kategori = $this->model('Kategori_model')->getKategoriById($id);

        // Jika data kategori ditemukan
        if ($kategori) {
            // 2. Hapus file gambar lama, JIKA BUKAN gambar default
            $gambarLama = $kategori['image'];
            if ($gambarLama != 'default.jpg') {
                   $pathFileLama = dirname(__DIR__, 3) . '/public/assets/kategori/' . $gambarLama;
                if (file_exists($pathFileLama)) {
                    unlink($pathFileLama); // Hapus file dari server
                }
            }
        }

        // 3. Lanjutkan untuk menghapus data dari database
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('Kategori', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Kategori', 'gagal dihapus', 'danger');
        }
        
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
     public function getSpecTemplate($id)
    {
        // Set header agar browser tahu ini adalah respons JSON
        header('Content-Type: application/json');
        
        $kategori = $this->model('Kategori_model')->getKategoriById($id);

        if ($kategori && !empty($kategori['spec_template'])) {
            // Echo langsung string JSON dari database
            echo $kategori['spec_template'];
        } else {
            // Jika tidak ada template, kembalikan objek JSON kosong
            echo json_encode(['fields' => []]);
        }
        exit; // Hentikan eksekusi
    }
}