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
        $this->load->model('Hero_model');
    }


    public function index(){
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();
        $data['slider'] = $this->Hero_model->slides();

        $this->load->view('user/index',$data);
    }

    public function trainers(){
        $data['get_all_trainers'] = $this->Trainers_model->trainers();

        $this->load->view('user/trainers',$data);
    }

    public function trainer_single($id){
        $data['trainer_single'] = $this->Trainers_model->trainer_single($id);
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();

        $this->load->view('user/trainer_single', $data);
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

    public function course_single($id){
        $data['course_single'] = $this->Courses_model->get_single_course($id);

        $this->load->view("user/courses_single", $data);
    }

    public function blog(){
        $data['get_all_posts'] = $this->Posts_model->posts();
        $data['admin'] = $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();

        $this->load->view('user/blog',$data);
    }

    public function blog_detail($id){
        $data['blog_detail'] = $this->Posts_model->post_single($id);

        $this->load->view('user/not_main/blog_details', $data);
    }

}