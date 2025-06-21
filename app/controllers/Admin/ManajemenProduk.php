<?php

class ManajemenProduk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenProduk/index');
        $this->view('admin/manajemenProduk/form_modal');
        $this->view('admin/templates/footer');
    }
    public function edit()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenProduk/edit');
        $this->view('admin/templates/footer');
    }
    public function detail()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenProduk/detail');
        $this->view('admin/templates/footer');
    }
}
