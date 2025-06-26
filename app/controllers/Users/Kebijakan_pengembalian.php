<?php

class Kebijakan_pengembalian extends Controller {
    
    public function index() 
    {
        $data['judul'] = 'Kebijakan pengembalian & denda';
        $this->view('templates/header', $data);
        $this->view('Users/kebijakan-pengembalian', $data);
        $this->view('templates/footer');
    }
}