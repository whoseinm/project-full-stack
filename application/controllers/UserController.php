<?php

class UserController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Posts_model');
        $this->load->model('Trainers_model');
        $this->load->model('About_model');
        $this->load->model('Courses_model');
        $this->load->model('Contact_model');
    }


    public function index(){
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();

        $this->load->view('user/index',$data);
    }

    public function trainers(){
        $data['get_all_trainers'] = $this->Trainers_model->trainers();

        $this->load->view('user/trainers',$data);
    }

    public function about(){
        $data['about'] = $this->About_model->about();
        $data['get_all_trainers'] = $this->Trainers_model->trainers();

        $this->load->view('user/about',$data);
    }

    public function contact(){
        $this->load->view('user/contact');
    }
    
    public function courses(){
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();

        $this->load->view('user/courses', $data);
    }

    public function blog(){
        $this->load->view('user/blog');
    }

}