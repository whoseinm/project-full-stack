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
        $data['get_all_posts'] = $this->db->order_by("post_id","DESC")
        ->join("admin","admin.a_id = posts.post_creator_id", "left")
        ->get('posts')->result_array();
        
        $this->load->view("admin/blog_posts/posts", $data);
    }

    public function post_create(){
        $this->load->view("admin/blog_posts/create");
    }

    public function post_create_act(){
        $title      = $_POST['title'];
        $description = $_POST['description'];
        $date       = $_POST['date'];
        $category   = $_POST['category'];
        $status     = $_POST['status'];

        if(!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)){
            $data = [
                'post_title'        => $title,
                'post_description'  => $description,
                'post_date'         => $date,
                'post_category'     => $category,
                'post_status'       => $status,
                // 'post_img' =>"",
                'post_creator_id'   => $_SESSION['admin_login_id'],
                'post_create_date'  => date("Y-m-d H:i:s"),
            ];
    
            // insert to DATABASE code
            $this->db->insert('posts', $data);
    
            // notification for post added successfully
            $this->session->set_flashdata('success', "Post uğurla əlavə olundu");
    
            // redirect to page
            redirect(base_url('posts'));
        }else{
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    // =========================BLOG POSTS END===========================


    public function delete_post($id){
        $this->db->where('post_id', $id);
        $this->db->delete('posts');
        $this->session->set_flashdata("success", "Post uğurla silindi");
        redirect(base_url("posts"));
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