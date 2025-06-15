<?php

class ManajemenPembayaran extends Controller{
    public function index(){
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPembayaran/index');
        $this->view('admin/manajemenPembayaran/form_modal');
        $this->view('admin/templates/footer');
    }
}