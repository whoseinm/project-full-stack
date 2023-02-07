<?php

class AdminController extends CI_Controller{
    


    public function index(){
        $this->load->view('admin/index_admin');
    }

    public function login_page(){
        $this->load->view('admin/auth-login-basic');
    }

}