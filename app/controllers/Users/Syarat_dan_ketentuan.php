<?php

class Syarat_Dan_Ketentuan extends Controller {
    
    public function index() 
    {
        $data['judul'] = 'Syarat & Ketentuan';
        $this->view('templates/header', $data);
        $this->view('Users/Syarat_dan_ketentuan', $data); 
        $this->view('templates/footer');
    }
}