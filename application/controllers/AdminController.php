<?php

class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Posts_model');
        $this->load->model('Trainers_model');
        $this->load->model('About_model');
        $this->load->model('Courses_model');
        $this->load->model('Contact_model');
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

    public function log_out()
    {
        $this->session->set_flashdata('success', 'Sizi bir daha gözləyirik :)');

        unset($_SESSION['admin_login_id']);
        redirect(base_url('admin_login'));
    }

    // =========================BLOG POSTS START===========================

    public function posts()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_posts'] = $this->Posts_model->posts();

        $this->load->view("admin/blog_posts/posts", $data);
    }

    public function post_create()
    {
        $this->load->view("admin/blog_posts/create");
    }

    public function post_create_act()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $status = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {

            $config['upload_path'] = './uploads/posts/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'post_title' => $title,
                    'post_description' => $description,
                    'post_date' => $date,
                    'post_category' => $category,
                    'post_status' => $status,
                    'post_img' => $file_name,
                    'post_file_ext' => $file_ext,
                    'post_creator_id' => $_SESSION['admin_login_id'],
                    'post_create_date' => date("Y-m-d H:i:s"),
                ];

                // insert to DATABASE code
                $this->Posts_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Post uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('posts'));
            } else {
                $this->session->set_flashdata('err', "File yüklənməsində xəta!");
                redirect($_SERVER['HTTP_REFERER']);
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function delete_post($id)
    {

        $data = $this->security->xss_clean($id);

        $this->Posts_model->delete_post($id);

    }

    public function detail($id)
    {

        $data['post_single'] = $this->Posts_model->post_single($id);
        // print_r("<pre>");
        // print_r($data['post_single']);
        // die();

        $this->load->view('admin/blog_posts/detail', $data);
    }

    public function post_edit($id)
    {
        $data['post_single'] = $this->db->where('post_id', $id)->get('posts')->row_array();
        $this->load->view('admin/blog_posts/edit', $data);
    }

    public function post_edit_act($id)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $status = $_POST['status'];


        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {


            $config['upload_path'] = "./uploads/posts/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'post_title' => $title,
                    'post_description' => $description,
                    'post_date' => $date,
                    'post_category' => $category,
                    'post_status' => $status,
                    'post_img' => $file_name,
                    'post_file_ext' => $file_ext,
                    'post_updater_id' => $_SESSION['admin_login_id'],
                    'post_update_date' => date("Y-m-d H:i:s"),
                ];

                // insert to db code
                $this->Posts_model->update_post($id, $data);

                // notification
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                // redirect page
                redirect(base_url('posts'));
            } else {

                $data = [
                    'post_title' => $title,
                    'post_description' => $description,
                    'post_date' => $date,
                    'post_category' => $category,
                    'post_status' => $status,
                    'post_updater_id' => $_SESSION['admin_login_id'],
                    'post_update_date' => date("Y-m-d H:i:s")
                ];

                // update in db info
                $this->Posts_model->update_post($id, $data);

                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                redirect(base_url('posts'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function post_img_delete($id)
    {

        $data = [
            'post_img' => "",
            'post_file_ext' => "",
        ];

        $this->Posts_model->update_post($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }
    // =========================BLOG POSTS END===========================





    // =========================TRAINERS START=========================


    public function trainers_list()
    {
        $data['trainers'] = $this->Trainers_model->trainers();

        $this->load->view("admin/trainers/trainers_list", $data);
    }

    public function trainer_create()
    {
        $this->load->view("admin/trainers/trainer_create");
    }

    public function trainer_create_act()
    {
        $name_surname = $_POST['name'];
        $about = $_POST['about'];
        $status = $_POST['status'];
        

        if (!empty($name_surname) && !empty($about) && !empty($status)) {

            $config['upload_path'] = './uploads/trainers/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'trainer_name' => $name_surname,
                    'trainer_about' => $about,
                    'trainer_status' => $status,
                    'trainer_img' => $file_name,
                    'trainer_img_ext' => $file_ext,
                    'trainer_creator_id' => $_SESSION['admin_login_id'],
                ];

                // insert to DATABASE code
                $this->Trainers_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Treyner uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('trainers'));
            } else {
                $this->session->set_flashdata('err', "File yüklənməsində xəta!");
                redirect($_SERVER['HTTP_REFERER']);
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function trainer_delete($id)
    {
        $this->Trainers_model->delete_trainer($id);
    }

    public function trainer_detail($id)
    {

        $data['trainer_single'] = $this->Trainers_model->trainer_single($id);
        // print_r("<pre>");
        // print_r($data['post_single']);
        // die();

        $this->load->view('admin/trainers/trainer_detail', $data);
    }

    public function trainer_edit($id)
    {
        $data['trainer_single'] = $this->db->where('trainer_id', $id)->get('trainers')->row_array();
        $this->load->view('admin/trainers/trainer_edit', $data);
    }

    public function trainer_edit_act($id)
    {
        $name_surname = $_POST['name'];
        $about = $_POST['about'];
        $status = $_POST['status'];


        if (!empty($name_surname) && !empty($about) && !empty($status)) {


            $config['upload_path'] = "./uploads/trainers/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'trainer_name' => $name_surname,
                    'trainer_about' => $about,
                    'trainer_status' => $status,
                    'trainer_img' => $file_name,
                    'trainer_img_ext' => $file_ext,
                ];

                // insert to db code
                $this->Trainers_model->update_trainer($id, $data);

                // notification
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                // redirect page
                redirect(base_url('trainers'));
            } else {

                $data = [
                    'trainer_name' => $name_surname,
                    'trainer_about' => $about,
                    'trainer_status' => $status,
                ];

                // update in db info
                $this->Trainers_model->update_trainer($id, $data);

                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                redirect(base_url('trainers'));
            }
            

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function trainer_img_delete($id)
    {

        $data = [
            'trainer_img' => "",
            'trainer_img_ext' => "",
        ];

        $this->Trainers_model->update_trainer($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }


    // =========================TRAINERS END===========================

    
    
    // =========================ABOUT END===========================
    
    
    
    public function about_list()
    {
        $data['about'] = $this->About_model->about();

        $this->load->view("admin/about/about", $data);
    }

    public function about_create()
    {
        $this->load->view("admin/about/about_create");
    }
    
    public function about_create_act()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        

        if (!empty($title) && !empty($description) && !empty($status)) {

            $config['upload_path'] = './uploads/about/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'about_title' => $title,
                    'about_description' => $description,
                    'about_status' => $status,
                    'about_img' => $file_name,
                    'about_img_ext' => $file_ext,
                    'about_creator_id' => $_SESSION['admin_login_id'],
                ];

                // insert to DATABASE code
                $this->About_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('admin_about'));
            } else {
                $this->session->set_flashdata('err', "File yüklənməsində xəta!");
                redirect($_SERVER['HTTP_REFERER']);
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function about_delete($id)
    {
        $this->About_model->about_delete($id);
    }

    public function about_detail($id)
    {

        $data['about_single'] = $this->About_model->about_single($id);
        // print_r("<pre>");
        // print_r($data['post_single']);
        // die();

        $this->load->view('admin/about/about_detail', $data);
    }

    public function about_edit($id)
    {
        $data['about_single'] = $this->db->where('about_id', $id)->get('about')->row_array();
        $this->load->view('admin/about/about_edit', $data);
    }

    public function about_edit_act($id)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];


        if (!empty($title) && !empty($description) && !empty($status)) {


            $config['upload_path'] = "./uploads/about/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'about_title' => $title,
                    'about_description' => $description,
                    'about_status' => $status,
                    'about_img' => $file_name,
                    'about_img_ext' => $file_ext,
                ];

                // insert to db code
                $this->About_model->update_about($id, $data);

                // notification
                $this->session->set_flashdata('success', "About uğurla yeniləndi!");

                // redirect page
                redirect(base_url('admin_about'));
            } else {

                $data = [
                    'about_title' => $title,
                    'about_description' => $description,
                    'about_status' => $status,
                ];

                // update in db info
                $this->About_model->update_about($id, $data);

                $this->session->set_flashdata('success', "About uğurla yeniləndi!");

                redirect(base_url('admin_about'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function about_img_delete($id)
    {

        $data = [
            'about_img' => "",
            'about_img_ext' => "",
        ];

        $this->About_model->update_about($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }
    
    
    // =========================ABOUT END===========================



    // ========================COURSES START==========================


    public function courses()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_courses'] = $this->Courses_model->get_all_courses();
        $this->load->view("admin/courses/courses",$data);
    }

    public function course_create()
    {
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();
        $data['get_all_trainers'] = $this->Courses_model->get_all_trainers();
        $this->load->view("admin/courses/course_create", $data);
    }
    
    public function course_create_act()
    {
        $course_name = $_POST['title'];
        $description = $_POST['description'];
        $course_duration = $_POST['course_duration'];
        $category = $_POST['category'];
        $trainer = $_POST['trainer'];
        $status = $_POST['status'];
        

        if (!empty($course_name) && !empty($description) && !empty($status) && !empty($category) && !empty($course_duration)) {

            $config['upload_path'] = './uploads/courses/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_category' => $category,
                    'course_duration' => $course_duration,
                    'course_img' => $file_name,
                    'course_img_ext' => $file_ext,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];

                // insert to DATABASE code
                $this->Courses_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));

                
            } else {

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_duration' => $course_duration,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];

                // insert to DATABASE code
                $this->Courses_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));

            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function course_delete($id){
        $this->Courses_model->delete_course($id);
    }

    public function course_detail($id){
        $data['course_single'] = $this->Courses_model->get_single_course($id);
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();


        $this->load->view('admin/courses/course_detail', $data);
    }

    public function course_edit($id)
    {
        $data['course_single'] = $this->Courses_model->get_single_course($id);
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();
        $data['get_single_data'] = $this->Courses_model->get_single_data($id);
        $data['get_all_trainers'] = $this->Courses_model->get_all_trainers();


        $this->load->view('admin/courses/course_edit', $data);
    }

    public function course_edit_act($id)
    {
        $course_name = $_POST['title'];
        $description = $_POST['description'];
        $course_duration = $_POST['course_duration'];
        $category = $_POST['category'];
        $trainer = $_POST['trainer'];
        $status = $_POST['status'];
        if (!empty($course_name) && !empty($description) && !empty($status) && !empty($category) && !empty($course_duration)) {

            $config['upload_path'] = './uploads/courses/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_category' => $category,
                    'course_duration' => $course_duration,
                    'course_img' => $file_name,
                    'course_img_ext' => $file_ext,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];

                // insert to DATABASE code
                $this->Courses_model->update_course($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));

                
            } else {

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_category' => $category,
                    'course_duration' => $course_duration,
                    'course_trainer' => $trainer,
                ];

                $this->Courses_model->update_course($id,$data);

                $this->session->set_flashdata('success', "Course uğurla yeniləndi!");

                redirect(base_url('courses_admin'));

            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function course_img_delete($id)
    {

        $data = [
            'course_img' => "",
            'course_img_ext' => "",
        ];

        $this->Courses_model->update_course($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }


    // ========================COURSES END==========================



    // ========================CONTACT START==========================


    public function contact_admin(){
        $data['get_messages'] = $this->Contact_model->get_all_messages();

        $this->load->view('admin/contact/messages',$data);
    }

    public function contact_message_act(){
        $message = $_POST['message'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];

        if(!empty($message) && !empty($name) && !empty($email) && !empty($subject)){
            $data=[
                'contact_message' => $message,
                'contact_name'    => $name,
                'contact_email'   => $email,
                'contact_date'    => date("Y-m-d H:i:s"),
                'contact_subject' => $subject,
                'contact_status'  => "Müraciət cavablandırılmayıb"
            ];

            // insert to DATABASE code
            $this->Contact_model->insert($data);


            // notification for post added successfully
            $this->session->set_flashdata('success', "Mesaj uğurla göndərildi");

            // redirect to page
            redirect(base_url('contact'));
        }
    }

    public function contact_message_detail($id){
        $data['get_single_message'] = $this->Contact_model->contact_single($id);
        
        $this->load->view('admin/contact/message_single', $data);
    }

    public function contact_viewed($id){
    
        $data=[
            'contact_status' => 'Müraciət cavablandırılıb',
            'contact_viewer_id' => $_SESSION['admin_login_id'],
            'contact_viewed_date' => date('Y-m-d H:i:s')
        ];

        $this->Contact_model->viewed($id,$data);

        redirect(base_url('admin_contact'));
        
    }

    public function contact_view_delete($id){
        $data = [
            'contact_status' => 'Müraciət cavablandırılmayıb',
            'contact_viewed_date' => '',
            'contact_viewer_id' => '',
        ];

        $this->Contact_model->view_delete($id,$data);

        redirect(base_url('admin_contact'));
    }

    public function contact_delete($id){
        $this->Contact_model->contact_delete($id);
    }

    // ========================CONTACT END==========================





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