<?php

class UserController extends CI_Controller{
    


    public function index(){
        $this->load->view('user/home');
    }

    public function about(){
        echo "about page";
    }

    public function contact(){
        echo "contact page";
    }
}