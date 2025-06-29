<?php

class kebijakan_privasi extends Controller{
    public function index(){
        $data['judul'] = 'Kebijakan Privasi';
        $this->view('templates/header', $data);
        $this->view('Users/kebijakan_privasi', $data);
        $this->view('templates/footer');
    }
}