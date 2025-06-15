<?php

class ManajemenStaff extends Controller{
    public function index(){
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenStaff/index');
        $this->view('admin/manajemenStaff/form_modal');
        $this->view('admin/templates/footer');
    }
}