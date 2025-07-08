<?php

class Kebijakan_pengembalian extends Controller {
    
    public function index() 
    {
        $data['judul'] = 'Kebijakan pengembalian & Denda';
        $this->view('templates/header', $data);
        $this->view('Users/kebijakan_pengembalian', $data);
        $this->view('templates/footer');
    }
}