<?php

class LaporanKinerja extends Controller{
    public function index(){
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/laporanKinerja/index');
        $this->view('admin/templates/footer');
    }
}