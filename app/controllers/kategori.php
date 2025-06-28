<?php

class Kategori extends Controller {

    private $allowedKategori = [
        'dslr', 'mirrorless', 'actioncam', 'lensa', 'aksesoris', 'laptop', 'drone', 'ledtv'
    ];

    public function index($namaKategori = '') {
        $namaKategori = strtolower($namaKategori);

        // Validasi kategori
        if (!in_array($namaKategori, $this->allowedKategori)) {
            echo "Kategori '$namaKategori' tidak ditemukan.";
            return;
        }

        // Kirim data ke view
        $data['judul'] = ucfirst($namaKategori);
        $this->view('templates/header', $data);
        $this->view('kategori/' . $namaKategori, $data);
        $this->view('templates/footer');
    }
}
