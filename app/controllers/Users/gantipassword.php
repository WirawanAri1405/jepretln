<?php

class GantiPassword extends Controller {
    public function index() {
        $data['judul'] = 'gantipassword';  
        $this->view('users/gantipassword/GantiPassword'); 
    }

}

