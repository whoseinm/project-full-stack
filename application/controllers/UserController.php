<?php

class UserController extends CI_Controller{
    


    public function index(){
        $this->load->view('user/index');
    }

    public function about(){
        $this->load->view('user/about');
    }

    public function contact(){
        $this->load->view('user/contact');
    }
    
    public function courses(){
        $this->load->view('user/courses');
    }

    public function blog(){
        $this->load->view('user/blog');
    }

}