<?php

class Home extends Controller {
    public function index() {
        $data['judul'] = 'Home'; 

        // Mengambil data kategori untuk navigasi yang dinamis
        $kategoriModel = $this->model('Kategori_model');
        $data['kategori_nav'] = $kategoriModel->getAllKategori(null, 100, 0); // Ambil semua kategori

        $this->view('templates/header', $data);
        $this->view('home/index', $data); 
        $this->view('templates/footer', $data);
    }
}