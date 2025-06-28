<?php

class ManajemenKategori extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/index');
        $this->view('admin/manajemenKategori/form_modal');
        $this->view('admin/templates/footer');
    }
    public function detail()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/detail');
        $this->view('admin/templates/footer');
    }
    public function edit()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/edit');
        $this->view('admin/templates/footer');
    }
         public function hapus($id)
    {
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('Data Kategori', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Data kategori', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
}