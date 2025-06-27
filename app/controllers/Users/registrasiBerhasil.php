<?php

class RegistrasiBerhasil extends Controller {
    public function index() {
        $data['judul'] = 'registrasiberhasil'; 
        $this->view('users/registrasi/registrasiBerhasil'); 
    }

}

