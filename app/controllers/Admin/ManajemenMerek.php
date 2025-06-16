<?php

class ManajemenMerek extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dasboard';
        $this->view('admin/templates/header');
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenMerek/index');
        $this->view('admin/manajemenMerek/form_modal');
        $this->view('admin/templates/footer');
    }
}
