<?php

class tentang_kami extends Controller {
    
    public function index() 
    {
        $data['judul'] = 'tentang kami';
        $this->view('templates/header', $data);
        $this->view('Users/tentang-kami', $data);
        $this->view('templates/footer');
    }
}