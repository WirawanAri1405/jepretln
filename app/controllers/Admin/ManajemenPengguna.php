<?php

class ManajemenPengguna extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenPengguna/index');
        $this->view('admin/manajemenPengguna/form_modal');
        $this->view('admin/templates/footer');
    }
}
