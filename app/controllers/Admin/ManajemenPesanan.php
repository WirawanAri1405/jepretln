<?php

class ManajemenPesanan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPesanan/index');
        $this->view('admin/manajemenPesanan/form_modal');
        $this->view('admin/templates/footer');
    }
    public function detail()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPesanan/detail');
        $this->view('admin/templates/footer');
    }
}
