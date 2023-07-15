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


        $url_title = $data['get_all_courses']['course_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $url_title = $data['get_all_teachers']['trainer_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $url_title = $data['get_limit_10_category']['category_title'];
        $url_slug = url_title($url_title,'dash',TRUE);
        

        $this->load->view('user/index',$data,$url_slug);
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

    public function course_single($id,$url_slug){
        $data['course_single'] = $this->Courses_model->get_single_course($id);

        $url_title = $data['course_single']['course_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/courses_single", $data,$url_slug);
    }

    public function trainings(){
        $data['get_all_trainings'] = $this->Trainings_model->get_all_trainings();

        $this->load->view('user/trainings', $data);
    }

    public function trainings_single($id,$url_slug){
        $data['training_single'] = $this->Trainings_model->get_single_trainings($id);

        $url_title = $data['training_single']['training_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/trainings_single", $data,$url_slug);
    }

    public function studyAbroad(){
        $data['get_all_abroad'] = $this->StudyAbroad_model->get_all_study_abroad();

        $this->load->view('user/studyAbroad', $data);
    }

    
    public function studyAbroad_single($id,$url_slug){
        $data['abroad_single'] = $this->StudyAbroad_model->get_single_abroad($id);

        $url_title = $data['abroad_single']['abroad_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/abroad_single", $data,$url_slug);
    }

    public function special_courses(){
        $data['get_all_special_courses'] = $this->Special_courses_model->get_all_special_courses();

        $this->load->view('user/special_courses', $data);
    }

    
    public function special_course_single($id,$url_slug){
        $data['special_single'] = $this->Special_courses_model->get_single_special_course($id);

        $url_title = $data['special_single']['s_course_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/special_course_single", $data,$url_slug);
    }

    public function prices(){
        $data['get_all_prices'] = $this->Prices_model->get_all_prices();

        $this->load->view('user/prices', $data);
    }

    public function price_single($id,$url_slug){
        $data['price_single'] = $this->Prices_model->get_single_prices($id);

        $url_title = $data['price_single']['price_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/price_single", $data,$url_slug);
    }

    public function training_plan(){
        $data['get_all_plans'] = $this->Training_plan_model->get_all_plans();

        $this->load->view('user/training_plan', $data);
    }

    public function training_plan_single($id,$url_slug){
        $data['plan_single'] = $this->Training_plan_model->get_single_plan($id);

        $url_title = $data['plan_single']['plan_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/plan_single", $data,$url_slug);
    }

    public function trainers(){
        $data['get_all_trainers'] = $this->Trainers_model->trainers();

        $this->load->view('user/trainers',$data);
    }

    public function trainer_single($id,$url_slug){
        $data['trainer_single'] = $this->Trainers_model->trainer_single($id);
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();

        $url_title = $data['trainer_single']['trainer_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view('user/trainer_single', $data);
    }

    public function contact(){
        $this->load->view('user/contact');
    }
    
    public function categories($id){
        $data['get_all_courses'] = $this->Courses_model->get_category_courses($id);
        
        $this->load->view('user/categories', $data);
    }

    // public function blog(){
    //     $data['get_all_posts'] = $this->Posts_model->posts();

    //     $this->load->view('user/blog',$data);
    // }

    // public function blog_detail($id,$url_slug){
    //     $data['blog_detail'] = $this->Posts_model->post_single($id);

    //     $url_title = $data['blog_detail']['blog_name'];
    //     $url_slug = url_title($url_title,'dash',TRUE);

    //     $this->load->view('user/not_main/blog_details', $data,$url_slug);
    // }







    public function vacancies(){
        $data['get_all_vacancies'] = $this->Vacancy_model->get_all_vacancies();
        

        $this->load->view('user/vacancies', $data);
    }

    public function vacancy_single($id,$url_slug){
        $data['vacancy_single'] = $this->Vacancy_model->get_single_vacancy($id);

        $url_title = $data['vacancy_single']['vacancy_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/vacancy_single", $data, $url_slug);
    }

    public function customers(){
        $data['get_all_partners'] = $this->Partners_model->get_all_partners();

        $this->load->view('user/customers', $data);
    }

    public function customer_single($id,$url_slug){
        $data['customer_single'] = $this->Partners_model->get_single_partner($id);

        $url_title = $data['customer_single']['partner_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/customer_single", $data,$url_slug);
    }

    public function achievements(){
        $data['get_all_achievements'] = $this->Achievements_model->get_all_achievements();

        $this->load->view('user/achievements', $data);
    }

    public function achievement_single($id,$url_slug){
        $data['achievement_single'] = $this->Achievements_model->get_single_achievement($id);

        $url_title = $data['achievement_single']['achievement_name'];
        $url_slug = url_title($url_title,'dash',TRUE);

        $this->load->view("user/achievement_single", $data);
    }

    public function testimonials(){
        $data['get_all_testimonials'] = $this->Testimonials_model->get_all_testimonials();



        $this->load->view('user/testimonials', $data);
    }

    public function testimonial_single($id,$url_slug){
        $data['testimonial_single'] = $this->Testimonials_model->get_single_testimonial($id);

        $url_title = $data['testimonial_single']['testimonial_name'];
        $url_slug = url_title($url_title,'dash',TRUE);


        $this->load->view('user/testimonial_single',$data,$url_slug);
        
    }

    

}