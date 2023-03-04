<?php

class AdminController extends CI_Controller{
    


    public function index(){
        $this->load->view('admin/index_admin');
    }

    public function login_page(){
        $this->load->view('admin/auth-login-basic');
    }

    public function login_act(){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (!empty($email) && !empty($pass)) {
            $data = [
                'a_mail' => $email,
                'a_password' => $pass,
            ];
            // print_r('<pre>');
            // print_r($data);
            // die();
            $check_admin = $this->db->where($data)->get('admin')->row_array();
            if ($check_admin) {
                $_SESSION['admin_login_id'] = $check_admin['a_id'];
                redirect(base_url('admin_page'));
            } else {
                $this->session->set_flashdata('err', 'E-poçt və ya parol səhv daxil edilib.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function log_out(){
        $this->session->set_flashdata('success', 'Sizi bir daha gözləyirik :)');

        unset($_SESSION['admin_login_id']);
        redirect(base_url('admin_login'));
    }

    // =========================BLOG POSTS START===========================

    public function posts(){
        $this->load->view("admin/blog_posts/posts");
    }

    public function post_create(){
        $this->load->view("admin/blog_posts/create");
    }

    public function post_create_act(){
        $title      = $_POST['title'];
        $descripton = $_POST['descripton'];
        $date       = $_POST['date'];
        $category   = $_POST['category'];
        $status     = $_POST['status'];
    }

    // =========================BLOG POSTS END===========================


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