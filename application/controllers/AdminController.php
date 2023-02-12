<?php

class AdminController extends CI_Controller{
    


    public function index(){
        $this->load->view('admin/index_admin');
    }

    public function login_page(){
        $this->load->view('admin/auth-login-basic');
    }

    public function forget_password(){
        $this->load->view('admin/auth-forgot-password-basic');
    }

    public function error(){
        $this->load->view('admin/pages-misc-error');
    }

    public function error2(){
        $this->load->view('admin/pages-misc-under-maintenance');
    }


}