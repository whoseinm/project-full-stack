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
        $this->load->model('Partners_model');
        $this->load->model('Vacancy_model');
        $this->load->model('Testimonials_model');
        $this->load->model('Achievements_model');
        $this->load->model('Trainings_model');
        $this->load->model('StudyAbroad_model');
        $this->load->model('Special_courses_model');
        $this->load->model('Prices_model');
        $this->load->model('Training_plan_model');
    }


    public function index(){
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();
        $data['get_all_teachers'] = $this->Trainers_model->trainers();
        $data['get_limit_10_category'] = $this->Courses_model->get_limit_10_category();
        $data['item'] = $this->Hero_model->slides();

        $this->load->view('user/index',$data);
    }

    public function about(){
        $data['about'] = $this->About_model->about();
        $data['get_all_trainers'] = $this->Trainers_model->trainers();

        $this->load->view('user/about',$data);
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

    public function trainings(){
        $data['get_all_trainings'] = $this->Trainings_model->get_all_trainings();

        $this->load->view('user/trainings', $data);
    }

    public function trainings_single($id){
        $data['training_single'] = $this->Trainings_model->get_single_trainings($id);

        $this->load->view("user/trainings_single", $data);
    }

    public function studyAbroad(){
        $data['get_all_abroad'] = $this->StudyAbroad_model->get_all_study_abroad();

        $this->load->view('user/studyAbroad', $data);
    }

    
    public function studyAbroad_single($id){
        $data['abroad_single'] = $this->StudyAbroad_model->get_single_abroad($id);

        $this->load->view("user/abroad_single", $data);
    }

    public function special_courses(){
        $data['get_all_special_courses'] = $this->Special_courses_model->get_all_special_courses();

        $this->load->view('user/special_courses', $data);
    }

    
    public function special_course_single($id){
        $data['abroad_single'] = $this->Special_courses_model->get_single_abroad($id);

        $this->load->view("user/abroad_single", $data);
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

    public function contact(){
        $this->load->view('user/contact');
    }
    
    public function categories($id){
        $data['get_all_courses'] = $this->Courses_model->get_category_courses($id);
        
        $this->load->view('user/categories', $data);
    }

    public function blog(){
        $data['get_all_posts'] = $this->Posts_model->posts();

        $this->load->view('user/blog',$data);
    }

    public function blog_detail($id){
        $data['blog_detail'] = $this->Posts_model->post_single($id);

        $this->load->view('user/not_main/blog_details', $data);
    }

}