<?php

class ManajemenLokasi extends Controller{
    public function index(){
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenLokasi/index');
        $this->view('admin/manajemenLokasi/form_modal');
        $this->view('admin/templates/footer');
    }
}