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
}
