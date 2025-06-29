<?php

class EditProfile extends Controller {
    public function index() {
        $data['judul'] = 'editprofile'; 
        $this->view('users/profile/EditProfile'); 
    }

}

