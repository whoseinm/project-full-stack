<?php

class AdminController extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('Posts_model');
    }


    public function index()
    {
        $this->load->view('admin/index_admin');
    }

    public function login_page()
    {
        $this->load->view('admin/auth-login-basic');
    }

    public function login_act()
    {
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
        $data['get_all_posts'] = $this->Posts_model->posts();

        $this->load->view("admin/blog_posts/posts", $data);
    }

    public function post_create()
    {
        $this->load->view("admin/blog_posts/create");
    }

    public function post_create_act(){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $status = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {

            $config['upload_path']      = './uploads/posts/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['encrypt_name']     = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')){
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'post_title'        => $title,
                    'post_description'  => $description,
                    'post_date'         => $date,
                    'post_category'     => $category,
                    'post_status'       => $status,
                    'post_img'          => $file_name,
                    'post_file_ext'     => $file_ext,
                    'post_creator_id'   => $_SESSION['admin_login_id'],
                    'post_create_date'  => date("Y-m-d H:i:s"),
                ];
                
                // insert to DATABASE code
                $this->Posts_model->insert($data);

    
                // notification for post added successfully
                $this->session->set_flashdata('success', "Post uğurla əlavə olundu");
    
                // redirect to page
                redirect(base_url('posts'));
            }else{
                $this->session->set_flashdata('err', "File yüklənməsində xəta!");
                redirect($_SERVER['HTTP_REFERER']);
            }

            
        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    // =========================BLOG POSTS END===========================


    public function delete_post($id){

        $data = $this->security->xss_clean($id);

        $this->Posts_model->delete_post($id);

    }


    public function detail($id){

        $data['post_single'] = $this->Posts_model->post_single($id);
        // print_r("<pre>");
        // print_r($data['post_single']);
        // die();


        $this->load->view('admin/blog_posts/detail',$data);
    }

    public function post_edit($id){
        $data['post_single'] = $this->db->where('post_id', $id)->get('posts')->row_array();
        $this->load->view('admin/blog_posts/edit',$data);
    }

    public function post_edit_act($id){
        $title            =     $_POST['title'];
        $description      =     $_POST['description'];
        $date             =     $_POST['date'];
        $category         =     $_POST['category'];
        $status           =     $_POST['status'];
        

        if(!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)){
            

            $config['upload_path']      = "./uploads/posts/";
            $config['allowed_types']    = "gif|jpg|png|jpeg";
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if($this->upload->do_upload('user_img')){
                $file_name = $this->upload->data('file_name');
                $file_ext  = $this->upload->data('file_ext');

                $data = [
                    'post_title'        => $title,
                    'post_description'  => $description,
                    'post_date'         => $date,
                    'post_category'     => $category,
                    'post_status'       => $status,
                    'post_img'          => $file_name,
                    'post_file_ext'     => $file_ext,
                    'post_updater_id'   => $_SESSION['admin_login_id'],
                    'post_update_date'  => date("Y-m-d H:i:s"),
                ];

                // insert to db code
                $this->Posts_model->update_post($id, $data);

                // notification
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                // redirect page
                redirect(base_url('posts'));
            }else{

                $data = [
                    'post_title'       => $title,
                    'post_description' => $description,
                    'post_date'        => $date,
                    'post_category'    => $category,
                    'post_status'      => $status,
                    'post_updater_id'  => $_SESSION['admin_login_id'],
                    'post_update_date' => date("Y-m-d H:i:s")
                ];

                // update in db info
                $this->Posts_model->update_post($id,$data);

                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                redirect(base_url('posts'));
            }

        }else{
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    
    }

    public function post_img_delete($id){

        $data = [
            'post_img' => "",
            'post_file_ext' => "",
        ];

        $this->Posts_model->update_post($id,$data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function forget_password()
    {
        $this->load->view('admin/auth-forgot-password-basic');
    }

    public function error()
    {
        $this->load->view('admin/pages-misc-error');
    }

    public function error2()
    {
        $this->load->view('admin/pages-misc-under-maintenance');
    }


}