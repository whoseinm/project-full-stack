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



    // =========================HERO CAPTION START===========================

    public function hero_caption()
    {
        $data['slides'] = $this->Hero_model->slides_admin();

        $this->load->view('admin/hero_caption/hero_caption', $data);
    }

    public function hero_caption_create()
    {
        $this->load->view('admin/hero_caption/hero_caption_create');
    }

    public function here_caption_create_act()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $link = $_POST['link'];
        $status = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($link) && !empty($status)) {

            $config['upload_path'] = './uploads/slider/';
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
                    'slider_title' => $title,
                    'slider_description' => $description,
                    'slider_link' => $link,
                    'slider_status' => $status,
                    'slider_img' => $file_name,
                    'slider_img_ext' => $file_ext,
                ];

                // insert to DATABASE code
                $this->Hero_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Slide uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('hero_caption'));
            } else {
                $data = [
                    'slider_title' => $title,
                    'slider_link' => $link,
                    'slider_description' => $description,
                    'slider_status' => $status,
                ];

                $this->Hero_model->insert($data);

                $this->session->set_flashdata('success', "Slide uğurla əlavə olundu");

                redirect(base_url('hero_caption'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hero_detail($id)
    {
        $data['hero_single'] = $this->Hero_model->hero_single($id);

        $this->load->view('admin/hero_caption/hero_single', $data);
    }

    public function hero_update($id)
    {
        $data['hero_single'] = $this->Hero_model->hero_single($id);

        $this->load->view('admin/hero_caption/hero_edit', $data);
    }

    public function hero_update_act($id)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $link = $_POST['link'];
        $status = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($link) && !empty($status)) {

            $config['upload_path'] = './uploads/slider/';
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
                    'slider_title' => $title,
                    'slider_description' => $description,
                    'slider_link' => $link,
                    'slider_status' => $status,
                    'slider_img' => $file_name,
                    'slider_img_ext' => $file_ext,
                ];

                // Update in DATABASE code
                $this->Hero_model->update_slider($id, $data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Slide uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('hero_caption'));
            } else {
                $data = [
                    'slider_title' => $title,
                    'slider_link' => $link,
                    'slider_description' => $description,
                    'slider_status' => $status,
                ];

                $this->Hero_model->update_slider($id, $data);

                $this->session->set_flashdata('success', "Slide uğurla yeniləndi");

                redirect(base_url('hero_caption'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hero_caption_delete($id)
    {
        $this->Hero_model->hero_caption_delete($id);
    }

    public function slider_img_delete($id)
    {

        $data = [
            'slider_img' => "",
            'slider_img_ext' => "",
        ];

        $this->Hero_model->update_slider($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);

    }





    // =========================HERO CAPTION END===========================


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

            $check_category = $this->db->where('post_category', $category)->get('posts')->row_array();

            if (empty($check_category)) {
                $this->session->set_flashdata('err', "Category tapilmadi");
                redirect($_SERVER['HTTP_REFERER']);
            }

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


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Posts_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Post uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('posts'));
            } else {
                $data = [
                    'post_title' => $title,
                    'post_description' => $description,
                    'post_date' => $date,
                    'post_category' => $category,
                    'post_status' => $status,
                    'post_creator_id' => $_SESSION['admin_login_id'],
                    'post_create_date' => date("Y-m-d H:i:s"),
                ];

                $data = $this->security->xss_clean($data);

                $this->Posts_model->insert($data);

                $this->session->set_flashdata('success', "Post uğurla əlavə olundu");

                redirect(base_url('posts'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function delete_post($id)
    {
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

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

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

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

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
        $description = $_POST['description'];
        $status = $_POST['status'];


        if (!empty($name_surname) && !empty($description) && !empty($status)) {

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
                    'trainer_about' => $description,
                    'trainer_status' => $status,
                    'trainer_img' => $file_name,
                    'trainer_img_ext' => $file_ext,
                    'trainer_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Trainers_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Treyner uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('trainers'));
            } else {
                $data = [
                    'trainer_name' => $name_surname,
                    'trainer_about' => $description,
                    'trainer_status' => $status,
                    'trainer_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Trainers_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Treyner uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('trainers'));
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
        $description = $_POST['description'];
        $status = $_POST['status'];


        if (!empty($name_surname) && !empty($description) && !empty($status)) {


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
                    'trainer_about' => $description,
                    'trainer_status' => $status,
                    'trainer_img' => $file_name,
                    'trainer_img_ext' => $file_ext,
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Trainers_model->update_trainer($id, $data);

                // notification
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");

                // redirect page
                redirect(base_url('trainers'));
            } else {

                $data = [
                    'trainer_name' => $name_surname,
                    'trainer_about' => $description,
                    'trainer_status' => $status,
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Trainers_model->update_trainer($id, $data);

                $this->session->set_flashdata('success', "Trainer uğurla yeniləndi!");

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


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->About_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('admin_about'));
            } else {
                $data = [
                    'about_title' => $title,
                    'about_description' => $description,
                    'about_status' => $status,
                    'about_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->About_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('admin_about'));
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

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

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

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

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

        $this->load->view("admin/courses/courses", $data);
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

            $check_category = $this->db->where('category_id', $category)->get('category')->row_array();

            if (empty($check_category)) {
                $this->session->set_flashdata('err', "Category tapilmadi");
                redirect($_SERVER['HTTP_REFERER']);
            }

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
                    'course_category_id' => $category,
                    'course_duration' => $course_duration,
                    'course_img' => $file_name,
                    'course_img_ext' => $file_ext,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Courses_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Kurs uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));


            } else {

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_category_id' => $category,
                    'course_duration' => $course_duration,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Courses_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Kurs uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));

            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function course_delete($id)
    {
        $this->Courses_model->delete_course($id);
    }

    public function course_detail($id)
    {
        $data['course_single'] = $this->Courses_model->get_single_course($id);
        $data['get_all_categories'] = $this->Courses_model->get_all_categories();
        // print_r($data['course_single']);
        // die();

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

        if (!empty($course_name) && !empty($description) && !empty($status) && !empty($trainer) && !empty($category) && !empty($course_duration)) {

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
                    'course_category_id' => $category,
                    'course_duration' => $course_duration,
                    'course_img' => $file_name,
                    'course_img_ext' => $file_ext,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Courses_model->update_course($id, $data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "About uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('courses_admin'));


            } else {

                $data = [
                    'course_name' => $course_name,
                    'course_description' => $description,
                    'course_status' => $status,
                    'course_category_id' => $category,
                    'course_duration' => $course_duration,
                    'course_trainer' => $trainer,
                    'course_creator_id' => $_SESSION['admin_login_id'],
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                $this->Courses_model->update_course($id, $data);

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


    // ========================Partners Start=========================

    public function partners_list()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_partners'] = $this->Partners_model->get_all_partners();

        $this->load->view("admin/partners/partners", $data);
    }

    public function partner_create()
    {
        $this->load->view("admin/partners/partners_create");
    }

    public function partner_create_act()
    {
        $partner_name = $_POST['title'];
        $about_partner = $_POST['description'];
        $partner_date = $_POST['date'];
        $partner_status = $_POST['status'];

        if (!empty($partner_name) && !empty($about_partner) && !empty($partner_date) && !empty($partner_status)) {

            $config['upload_path'] = './uploads/partners/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('partner_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'partner_name' => $partner_name,
                    'partner_about' => $about_partner,
                    'partner_add_date' => $partner_date,
                    'partner_status' => $partner_status,
                    'partner_img' => $file_name,
                    'partner_img_ext' => $file_ext,
                    'partner_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Partners_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Partner uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('posts'));
            } else {
                $data = [
                    'partner_name' => $partner_name,
                    'partner_about' => $about_partner,
                    'partner_add_date' => $partner_date,
                    'partner_status' => $partner_status,
                    'partner_creator' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Partners_model->insert($data);

                $this->session->set_flashdata('success', "Partner uğurla əlavə olundu");

                redirect(base_url('partners_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function partner_detail($id)
    {
        $data['partners_single'] = $this->Partners_model->get_single_partner($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/partners/partners_detail', $data);
    }

    public function partner_delete($id){
        $this->Partners_model->delete_partner($id);
    }

    public function partner_edit($id)
    {
        $data['partner_single'] = $this->db->where('partner_id', $id)->get('partners')->row_array();
        $this->load->view('admin/partners/partner_edit', $data);
    }
    public function partner_img_delete($id){
        $data = [
            'partner_img' => "",
            'partner_img_ext' => "",
        ];

        $this->Partners_model->update_partner($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function partner_edit_act($id){
        $partner_name = $_POST['title'];
        $partner_about = $_POST['description'];
        $partner_add_date = $_POST['date'];
        $partner_status = $_POST['status'];


        if (!empty($partner_name) && !empty($partner_about) && !empty($partner_add_date) && !empty($partner_status)) {


            $config['upload_path'] = "./uploads/partners/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'partner_name' => $partner_name,
                    'partner_about' => $partner_about,
                    'partner_add_date' => $partner_add_date,
                    'partner_status' => $partner_status,
                    'partner_img' => $file_name,
                    'partner_img_ext' => $file_ext,
                    'partner_updater_id' => $_SESSION['admin_login_id'],
                    'partner_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Partners_model->update_partner($id, $data);

                // notification
                $this->session->set_flashdata('success', "Partnyor uğurla yeniləndi!");

                // redirect page
                redirect(base_url('partners_admin'));
            } else {

                $data = [
                    'partner_name' => $partner_name,
                    'partner_about' => $partner_about,
                    'partner_add_date' => $partner_add_date,
                    'partner_status' => $partner_status,
                    'partner_updater_id' => $_SESSION['admin_login_id'],
                    'partner_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Partners_model->update_partner($id, $data);

                $this->session->set_flashdata('success', "Partnyor uğurla yeniləndi!");

                redirect(base_url('partners_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    // ========================Partners End===========================



    // =========================Vacancy Start=========================

    public function vacancy_list(){
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_vacancies'] = $this->Vacancy_model->get_all_vacancies();

        $this->load->view("admin/vacancy/vacancy_list", $data);
    }

    public function vacancy_create()
    {
        $this->load->view("admin/vacancy/vacancy_create");
    }

    public function vacancy_create_act(){
        $vacancy_name = $_POST['title'];
        $about_vacancy = $_POST['description'];
        $vacancy_add_date = $_POST['date'];
        $vacancy_status = $_POST['status'];

        if (!empty($vacancy_name) && !empty($about_vacancy) && !empty($vacancy_add_date) && !empty($vacancy_status)) {

            $config['upload_path'] = './uploads/vacancy/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'vacancy_name' => $vacancy_name,
                    'vacancy_about' => $about_vacancy,
                    'vacancy_add_date' => $vacancy_add_date,
                    'vacancy_status' => $vacancy_status,
                    'vacancy_img' => $file_name,
                    'vacancy_img_ext' => $file_ext,
                    'vacancy_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Vacancy_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Vakansiya uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('vacancies_admin'));
            } else {
                $data = [
                    'vacancy_name' => $vacancy_name,
                    'vacancy_about' => $about_vacancy,
                    'vacancy_add_date' => $vacancy_add_date,
                    'vacancy_status' => $vacancy_status,
                    'vacancy_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Vacancy_model->insert($data);

                $this->session->set_flashdata('success', "Vakansiya uğurla əlavə olundu");

                redirect(base_url('vacancies_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function vacancy_delete($id){
        $this->Vacancy_model->delete_vacancy($id);
    }

    public function vacancy_detail($id)
    {
        $data['vacancy_single'] = $this->Vacancy_model->get_single_vacancy($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/vacancy/vacancy_detail', $data);
    }

    public function vacancy_edit($id)
    {
        $data['vacancy_single'] = $this->db->where('vacancy_id', $id)->get('vacancy')->row_array();
        $this->load->view('admin/vacancy/vacancy_edit', $data);
    }

    public function vacancy_edit_act($id){
        $vacancy_name = $_POST['title'];
        $vacancy_about = $_POST['description'];
        $vacancy_add_date = $_POST['date'];
        $vacancy_status = $_POST['status'];


        if (!empty($vacancy_name) && !empty($vacancy_about) && !empty($vacancy_add_date) && !empty($vacancy_status)) {


            $config['upload_path'] = "./uploads/vacancy/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'vacancy_name' => $vacancy_name,
                    'vacancy_about' => $vacancy_about,
                    'vacancy_add_date' => $vacancy_add_date,
                    'vacancy_status' => $vacancy_status,
                    'vacancy_img' => $file_name,
                    'vacancy_img_ext' => $file_ext,
                    'vacancy_updater_id' => $_SESSION['admin_login_id'],
                    'vacancy_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Vacancy_model->update_vacancy($id, $data);

                // notification
                $this->session->set_flashdata('success', "Vakansiya uğurla yeniləndi!");

                // redirect page
                redirect(base_url('vacancies_admin'));
            } else {

                $data = [
                    'vacancy_name' => $vacancy_name,
                    'vacancy_about' => $vacancy_about,
                    'vacancy_add_date' => $vacancy_add_date,
                    'vacancy_status' => $vacancy_status,
                    'vacancy_updater_id' => $_SESSION['admin_login_id'],
                    'vacancy_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Vacancy_model->update_vacancy($id, $data);

                $this->session->set_flashdata('success', "Vakansiya uğurla yeniləndi!");

                redirect(base_url('vacancies_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function vacancy_img_delete($id){
        $data = [
            'vacancy_img' => "",
            'vacancy_img_ext' => "",
        ];

        $this->Vacancy_model->update_vacancy($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }


    // =========================Vacancy End=========================


    // =====================Testimonials Start======================

    public function testimonials_list(){
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_testimonials'] = $this->Testimonials_model->get_all_testimonials();

        $this->load->view("admin/testimonials/testimonials", $data);
    }

    public function testimonial_create()
    {
        $this->load->view("admin/testimonials/testimonial_create");
    }

    public function testimonial_create_act(){
        $testimonial_name = $_POST['title'];
        $testimonial_vacancy = $_POST['description'];
        $testimonial_add_date = $_POST['date'];
        $testimonial_status = $_POST['status'];

        if (!empty($testimonial_name) && !empty($testimonial_vacancy) && !empty($testimonial_add_date) && !empty($testimonial_status)) {

            $config['upload_path'] = './uploads/testimonials/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'testimonial_name' => $testimonial_name,
                    'testimonial_about' => $testimonial_vacancy,
                    'testimonial_add_date' => $testimonial_add_date,
                    'testimonial_status' => $testimonial_status,
                    'testimonial_img' => $file_name,
                    'testimonial_img_ext' => $file_ext,
                    'testimonial_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Testimonials_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Rəy uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('testimonials_admin'));
            } else {
                $data = [
                    'testimonial_name' => $testimonial_name,
                    'testimonial_about' => $testimonial_vacancy,
                    'testimonial_add_date' => $testimonial_add_date,
                    'testimonial_status' => $testimonial_status,
                    'testimonial_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Testimonials_model->insert($data);

                $this->session->set_flashdata('success', "Rəy uğurla əlavə olundu");

                redirect(base_url('testimonials_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function testimonial_delete($id){
        $this->Testimonials_model->delete_testimonial($id);
    }

    public function testimonial_detail($id)
    {
        $data['testimonial_single'] = $this->Testimonials_model->get_single_testimonial($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/testimonials/testimonial_detail', $data);
    }

    public function testimonial_edit($id)
    {
        $data['testimonial_single'] = $this->db->where('testimonial_id', $id)->get('testimonials')->row_array();
        $this->load->view('admin/testimonials/testimonial_edit', $data);
    }

    public function testimonial_edit_act($id){
        $testimonial_name = $_POST['title'];
        $testimonial_about = $_POST['description'];
        $testimonial_add_date = $_POST['date'];
        $testimonial_status = $_POST['status'];


        if (!empty($testimonial_name) && !empty($testimonial_about) && !empty($testimonial_add_date) && !empty($testimonial_status)) {


            $config['upload_path'] = "./uploads/testimonials/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'testimonial_name' => $testimonial_name,
                    'testimonial_about' => $testimonial_about,
                    'testimonial_add_date' => $testimonial_add_date,
                    'testimonial_status' => $testimonial_status,
                    'testimonial_img' => $file_name,
                    'testimonial_img_ext' => $file_ext,
                    'testimonial_updater_id' => $_SESSION['admin_login_id'],
                    'testimonial_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Testimonials_model->update_testimonial($id, $data);

                // notification
                $this->session->set_flashdata('success', "Rəy uğurla yeniləndi!");

                // redirect page
                redirect(base_url('testimonials_admin'));
            } else {

                $data = [
                    'testimonial_name' => $testimonial_name,
                    'testimonial_about' => $testimonial_about,
                    'testimonial_add_date' => $testimonial_add_date,
                    'testimonial_status' => $testimonial_status,
                    'testimonial_updater_id' => $_SESSION['admin_login_id'],
                    'testimonial_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Testimonials_model->update_testimonial($id, $data);

                $this->session->set_flashdata('success', "Rəy uğurla yeniləndi!");

                redirect(base_url('testimonials_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function testimonial_img_delete($id){
        $data = [
            'testimonial_img' => "",
            'testimonial_img_ext' => "",
        ];

        $this->Testimonials_model->update_testimonial($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ======================Testimonials End=======================




    // =====================Achievements Start======================
    
        public function achievements_list()
        {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_achievements'] = $this->Achievements_model->get_all_achievements();

        $this->load->view("admin/achievements/achievements", $data);
        }

        public function achievements_create()
        {
            $this->load->view("admin/achievements/achievements_create");
        }

        public function achievements_create_act(){
            $achievement_name = $_POST['title'];
            $achievement_vacancy = $_POST['description'];
            $achievement_add_date = $_POST['date'];
            $achievement_status = $_POST['status'];
    
            if (!empty($achievement_name) && !empty($achievement_vacancy) && !empty($achievement_add_date) && !empty($achievement_status)) {
    
                $config['upload_path'] = './uploads/achievements/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                // $config['max_size'] = 100;
                // $config['max_width'] = 1024;
                // $config['max_height'] = 768;
    
                $this->load->library('upload', $config);
    
                $this->upload->initialize($config);
    
    
                if ($this->upload->do_upload('img')) {
                    $file_name = $this->upload->data('file_name');
                    $file_ext = $this->upload->data('file_ext');
    
    
                    $data = [
                        'achievement_name' => $achievement_name,
                        'achievement_about' => $achievement_vacancy,
                        'achievement_add_date' => $achievement_add_date,
                        'achievement_status' => $achievement_status,
                        'achievement_creator_id' => $_SESSION['admin_login_id'],
                    ];
                    
                    $img = [
                        'achievement_img' => $file_name,
                        'achievement_img_ext' => $file_ext,
                    ];

                    
                    
                    
                    $data = $this->security->xss_clean($data);

    
                    // insert to DATABASE code
                    $this->Achievements_model->insert($data,$img);
    
    
                    // notification for post added successfully
                    $this->session->set_flashdata('success', "Uğur uğurla əlavə olundu");
    
                    // redirect to page
                    redirect(base_url('achievements_admin'));
                } else {
                    $data = [
                        'achievement_name' => $achievement_name,
                        'achievement_about' => $achievement_vacancy,
                        'achievement_add_date' => $achievement_add_date,
                        'achievement_status' => $achievement_status,
                        'achievement_creator_id' => $_SESSION['admin_login_id'],
                    ];
    
                    
    
                    $this->Achievements_model->insert($data);
    
                    $this->session->set_flashdata('success', "Uğur uğurla əlavə olundu");
    
                    redirect(base_url('achievements_admin'));
                }
    
    
            } else {
                $this->session->set_flashdata('err', "Boşluq buraxmayın");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        public function achievements_delete($id){
            $this->Achievements_model->delete_achievements($id);
        }

        public function achievements_detail($id)
        {
            $data['achievement_single'] = $this->Achievements_model->get_single_achievement($id);
            // print_r($data['course_single']);
            // die();
    
            $this->load->view('admin/achievements/achievements_detail', $data);
        }

        public function achievements_edit($id)
        {
            $data['achievements_single'] = $this->db->where('achievement_id', $id)->get('achievements')->row_array();
            $this->load->view('admin/achievements/achievements_edit', $data);
        }

        public function achievements_edit_act($id){
            $achievement_name = $_POST['title'];
            $achievement_about = $_POST['description'];
            $achievement_add_date = $_POST['date'];
            $achievement_status = $_POST['status'];
    
    
            if (!empty($achievement_name) && !empty($achievement_about) && !empty($achievement_add_date) && !empty($achievement_status)) {
    
    
                $config['upload_path'] = "./uploads/achievements/";
                $config['allowed_types'] = "gif|jpg|png|jpeg";
                $config['encrypt_name'] = TRUE;
    
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
    
                if ($this->upload->do_upload('user_img')) {
                    $file_name = $this->upload->data('file_name');
                    $file_ext = $this->upload->data('file_ext');
    
                    $data = [
                        'achievement_name' => $achievement_name,
                        'achievement_about' => $achievement_about,
                        'achievement_add_date' => $achievement_add_date,
                        'achievement_status' => $achievement_status,
                        'achievement_img' => $file_name,
                        'achievement_img_ext' => $file_ext,
                        'achievement_updater_id' => $_SESSION['admin_login_id'],
                        'achievement_update_date' => date("Y-m-d H:i:s"),
                    ];
    
                    $id = $this->security->xss_clean($id);
                    
    
                    // insert to db code
                    $this->Achievements_model->update_achievements($id, $data);
    
                    // notification
                    $this->session->set_flashdata('success', "Uğur uğurla yeniləndi!");
    
                    // redirect page
                    redirect(base_url('achievements_admin'));
                } else {
    
                    $data = [
                        'achievement_name' => $achievement_name,
                        'achievement_about' => $achievement_about,
                        'achievement_add_date' => $achievement_add_date,
                        'achievement_status' => $achievement_status,
                        'achievement_updater_id' => $_SESSION['admin_login_id'],
                        'achievement_update_date' => date("Y-m-d H:i:s"),
                    ];
    
                    $id = $this->security->xss_clean($id);
                    
    
                    // update in db info
                    $this->Achievements_model->update_achievements($id, $data);
    
                    $this->session->set_flashdata('success', "Uğur uğurla yeniləndi!");
    
                    redirect(base_url('achievements_admin'));
                }
    
            } else {
                $this->session->set_flashdata('err', "Boşluq buraxmayın!");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        public function achievements_img_delete($id){
            $data = [
                'achievement_img' => "",
                'achievement_img_ext' => "",
            ];
    
            $this->Achievements_model->update_achievements($id, $data);
            $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
            redirect($_SERVER['HTTP_REFERER']);
        }


    
    // ======================Achievements End=======================



    // ======================Trainings Start=======================

    public function trainings_list()
    {
    $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
    $data['get_all_trainings'] = $this->Trainings_model->get_all_trainings();

    $this->load->view("admin/trainings/trainings", $data);
    }

    public function trainings_create()
    {
        $this->load->view("admin/trainings/trainings_create");
    }

    public function trainings_create_act(){
        $trainings_name = $_POST['title'];
        $trainings_vacancy = $_POST['description'];
        $trainings_add_date = $_POST['date'];
        $trainings_status = $_POST['status'];

        if (!empty($trainings_name) && !empty($trainings_vacancy) && !empty($trainings_add_date) && !empty($trainings_status)) {

            $config['upload_path'] = './uploads/trainings/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'training_name' => $trainings_name,
                    'training_about' => $trainings_vacancy,
                    'training_add_date' => $trainings_add_date,
                    'training_status' => $trainings_status,
                    'training_img' => $file_name,
                    'training_img_ext' => $file_ext,
                    'training_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Trainings_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Təlim uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('trainings_admin'));
            } else {
                $data = [
                    'training_name' => $trainings_name,
                    'training_about' => $trainings_vacancy,
                    'training_add_date' => $trainings_add_date,
                    'training_status' => $trainings_status,
                    'training_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Trainings_model->insert($data);

                $this->session->set_flashdata('success', "Təlim uğurla əlavə olundu");

                redirect(base_url('trainings_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function trainings_detail($id)
    {
        $data['trainings_single'] = $this->Trainings_model->get_single_trainings($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/trainings/trainings_detail', $data);
    }

    public function trainings_edit($id)
    {
        $data['trainings_single'] = $this->db->where('training_id', $id)->get('trainings')->row_array();
        $this->load->view('admin/trainings/trainings_edit', $data);
    }

    public function trainings_edit_act($id){
        $training_name = $_POST['title'];
        $training_about = $_POST['description'];
        $training_add_date = $_POST['date'];
        $training_status = $_POST['status'];


        if (!empty($training_name) && !empty($training_about) && !empty($training_add_date) && !empty($training_status)) {


            $config['upload_path'] = "./uploads/trainings/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'training_name' => $training_name,
                    'training_about' => $training_about,
                    'training_add_date' => $training_add_date,
                    'training_status' => $training_status,
                    'training_img' => $file_name,
                    'training_img_ext' => $file_ext,
                    'training_updater_id' => $_SESSION['admin_login_id'],
                    'training_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Trainings_model->update_trainings($id, $data);

                // notification
                $this->session->set_flashdata('success', "Təlim uğurla yeniləndi!");

                // redirect page
                redirect(base_url('trainings_admin'));
            } else {

                $data = [
                    'training_name' => $training_name,
                    'training_about' => $training_about,
                    'training_add_date' => $training_add_date,
                    'training_status' => $training_status,
                    'training_updater_id' => $_SESSION['admin_login_id'],
                    'training_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Trainings_model->update_trainings($id, $data);

                $this->session->set_flashdata('success', "Təlim uğurla yeniləndi!");

                redirect(base_url('trainings_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function trainings_delete($id){
        $this->Trainings_model->delete_trainings($id);
    }

    public function trainings_img_delete($id){
        $data = [
            'training_img' => "",
            'training_img_ext' => "",
        ];

        $this->Trainings_model->update_trainings($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ======================Trainings End=========================


    // ======================StudyAbroad Start=========================
    
    public function StudyAbroad_list()
    {
    $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
    $data['get_all_study_abroad'] = $this->StudyAbroad_model->get_all_study_abroad();

    $this->load->view("admin/studyAbroad/studyAbroad", $data);
    }

    public function StudyAbroad_create()
    {
        $this->load->view("admin/studyAbroad/studyAbroad_create");
    }

    public function StudyAbroad_create_act(){
        $abroad_name = $_POST['title'];
        $abroad_about = $_POST['description'];
        $abroad_add_date = $_POST['date'];
        $abroad_status = $_POST['status'];

        if (!empty($abroad_name) && !empty($abroad_about) && !empty($abroad_add_date) && !empty($abroad_status)) {

            $config['upload_path'] = './uploads/studyAbroad/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'abroad_name' => $abroad_name,
                    'abroad_about' => $abroad_about,
                    'abroad_add_date' => $abroad_add_date,
                    'abroad_status' => $abroad_status,
                    'abroad_img' => $file_name,
                    'abroad_img_ext' => $file_ext,
                    'abroad_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->StudyAbroad_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Təhsil uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('studyAbroad_admin'));
            } else {
                $data = [
                    'abroad_name' => $abroad_name,
                    'abroad_about' => $abroad_about,
                    'abroad_add_date' => $abroad_add_date,
                    'abroad_status' => $abroad_status,
                    'abroad_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->StudyAbroad_model->insert($data);

                $this->session->set_flashdata('success', "Təhsil uğurla əlavə olundu");

                redirect(base_url('studyAbroad_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function StudyAbroad_detail($id)
    {
        $data['StudyAbroad_single'] = $this->StudyAbroad_model->get_single_abroad($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/studyAbroad/studyAbroad_detail', $data);
    }

    public function StudyAbroad_delete($id){
        $this->StudyAbroad_model->delete_abroad($id);
    }

    public function StudyAbroad_edit($id)
    {
        $data['StudyAbroad_single'] = $this->db->where('abroad_id', $id)->get('studyAbroad')->row_array();
        $this->load->view('admin/studyAbroad/studyAbroad_edit', $data);
    }

    public function StudyAbroad_edit_act($id){
        $abroad_name = $_POST['title'];
        $abroad_about = $_POST['description'];
        $abroad_add_date = $_POST['date'];
        $abroad_status = $_POST['status'];


        if (!empty($abroad_name) && !empty($abroad_about) && !empty($abroad_add_date) && !empty($abroad_status)) {


            $config['upload_path'] = "./uploads/studyAbroad/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'abroad_name' => $abroad_name,
                    'abroad_about' => $abroad_about,
                    'abroad_add_date' => $abroad_add_date,
                    'abroad_status' => $abroad_status,
                    'abroad_img' => $file_name,
                    'abroad_img_ext' => $file_ext,
                    'abroad_updater_id' => $_SESSION['admin_login_id'],
                    'abroad_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->StudyAbroad_model->update_abroad($id, $data);

                // notification
                $this->session->set_flashdata('success', "Təhsil uğurla yeniləndi!");

                // redirect page
                redirect(base_url('studyAbroad_admin'));
            } else {

                $data = [
                    'abroad_name' => $abroad_name,
                    'abroad_about' => $abroad_about,
                    'abroad_add_date' => $abroad_add_date,
                    'abroad_status' => $abroad_status,
                    'abroad_updater_id' => $_SESSION['admin_login_id'],
                    'abroad_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->StudyAbroad_model->update_abroad($id, $data);

                $this->session->set_flashdata('success', "Təhsil uğurla yeniləndi!");

                redirect(base_url('studyAbroad_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function StudyAbroad_img_delete($id){
        $data = [
            'abroad_img' => "",
            'abroad_img_ext' => "",
        ];

        $this->StudyAbroad_model->update_abroad($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ======================StudyAbroad End=========================



    // ======================Special_Courses Start=========================
    
    
    public function Special_Courses_list()
    {
    $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
    $data['get_all_special_courses'] = $this->Special_courses_model->get_all_special_courses();

    $this->load->view("admin/special_courses/special_courses", $data);
    }

    public function Special_Courses_create()
    {
        $this->load->view("admin/special_courses/special_courses_create");
    }

    public function Special_Courses_act(){ //create
        $special_courses_name = $_POST['title'];
        $special_courses_about = $_POST['description'];
        $special_courses_add_date = $_POST['date'];
        $special_courses_status = $_POST['status'];

        if (!empty($special_courses_name) && !empty($special_courses_about) && !empty($special_courses_add_date) && !empty($special_courses_status)) {

            $config['upload_path'] = './uploads/special_courses/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    's_course_name' => $special_courses_name,
                    's_course_about' => $special_courses_about,
                    's_course_add_date' => $special_courses_add_date,
                    's_course_status' => $special_courses_status,
                    's_course_img' => $file_name,
                    's_course_img_ext' => $file_ext,
                    's_course_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Special_courses_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Özəl Kurs uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('special_courses_admin'));
            } else {
                $data = [
                    's_course_name' => $special_courses_name,
                    's_course_about' => $special_courses_about,
                    's_course_add_date' => $special_courses_add_date,
                    's_course_status' => $special_courses_status,
                    's_course_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Special_courses_model->insert($data);

                $this->session->set_flashdata('success', "Özəl Kurs uğurla əlavə olundu");

                redirect(base_url('special_courses_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Special_Courses_detail($id)
    {
        $data['Special_Courses_single'] = $this->Special_courses_model->get_single_special_course($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/special_courses/special_courses_detail', $data);
    }
    public function Special_Courses_edit($id)
    {
        $data['special_courses_single'] = $this->db->where('s_course_id', $id)->get('special_courses')->row_array();
        $this->load->view('admin/special_courses/special_courses_edit', $data);
    }

    public function Special_Courses_edit_act($id){
        $s_course_name = $_POST['title'];
        $s_course_about = $_POST['description'];
        $s_course_add_date = $_POST['date'];
        $s_course_status = $_POST['status'];


        if (!empty($s_course_name) && !empty($s_course_about) && !empty($s_course_add_date) && !empty($s_course_status)) {


            $config['upload_path'] = "./uploads/special_courses/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    's_course_name' => $s_course_name,
                    's_course_about' => $s_course_about,
                    's_course_add_date' => $s_course_add_date,
                    's_course_status' => $s_course_status,
                    's_course_img' => $file_name,
                    's_course_img_ext' => $file_ext,
                    's_course_updater_id' => $_SESSION['admin_login_id'],
                    's_course_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Special_courses_model->update_special_course($id, $data);

                // notification
                $this->session->set_flashdata('success', "Özəl kurs uğurla yeniləndi!");

                // redirect page
                redirect(base_url('special_courses_admin'));
            } else {

                $data = [
                    's_course_name' => $s_course_name,
                    's_course_about' => $s_course_about,
                    's_course_add_date' => $s_course_add_date,
                    's_course_status' => $s_course_status,
                    's_course_updater_id' => $_SESSION['admin_login_id'],
                    's_course_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Special_courses_model->update_special_course($id, $data);

                $this->session->set_flashdata('success', "Özəl kurs uğurla yeniləndi!");

                redirect(base_url('special_courses_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Special_Courses_delete($id){
        $this->Special_courses_model->delete_special_course($id);
    }



    public function Special_Courses_img_delete($id){
        $data = [
            's_course_img' => "",
            's_course_img_ext' => "",
        ];

        $this->Special_courses_model->update_special_course($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }


    
    // ======================Special_Courses End=========================

    


    // ======================Prices Start=========================


    public function Prices_list()
    {
    $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
    $data['get_all_prices'] = $this->Prices_model->get_all_prices();

    $this->load->view("admin/prices/prices", $data);
    }

    public function Prices_create()
    {
        $this->load->view("admin/prices/prices_create");
    }

    public function Prices_create_act(){
        $Prices_name = $_POST['title'];
        $Prices_about = $_POST['description'];
        $Prices_add_date = $_POST['date'];
        $Prices_status = $_POST['status'];

        if (!empty($Prices_name) && !empty($Prices_about) && !empty($Prices_add_date) && !empty($Prices_status)) {

            $config['upload_path'] = './uploads/prices/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'price_name' => $Prices_name,
                    'price_about' => $Prices_about,
                    'price_add_date' => $Prices_add_date,
                    'price_status' => $Prices_status,
                    'price_img' => $file_name,
                    'price_img_ext' => $file_ext,
                    'price_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Prices_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Qiymət uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('prices_admin'));
            } else {
                $data = [
                    'price_name' => $Prices_name,
                    'price_about' => $Prices_about,
                    'price_add_date' => $Prices_add_date,
                    'price_status' => $Prices_status,
                    'price_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Prices_model->insert($data);

                $this->session->set_flashdata('success', "Qiymət uğurla əlavə olundu");

                redirect(base_url('prices_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Prices_delete($id){
        $this->Prices_model->delete_prices($id);
    }

    public function Prices_detail($id)
    {
        $data['Prices_single'] = $this->Prices_model->get_single_prices($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/prices/prices_detail', $data);
    }

    public function Prices_edit($id)
    {
        $data['Prices_single'] = $this->db->where('price_id', $id)->get('prices')->row_array();
        $this->load->view('admin/prices/prices_edit', $data);
    }

    public function Prices_edit_act($id){
        $price_name = $_POST['title'];
        $price_about = $_POST['description'];
        $price_add_date = $_POST['date'];
        $price_status = $_POST['status'];


        if (!empty($price_name) && !empty($price_about) && !empty($price_add_date) && !empty($price_status)) {


            $config['upload_path'] = "./uploads/prices/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'price_name' => $price_name,
                    'price_about' => $price_about,
                    'price_add_date' => $price_add_date,
                    'price_status' => $price_status,
                    'price_img' => $file_name,
                    'price_img_ext' => $file_ext,
                    'price_updater_id' => $_SESSION['admin_login_id'],
                    'price_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Prices_model->update_prices($id, $data);

                // notification
                $this->session->set_flashdata('success', "Qiymət uğurla yeniləndi!");

                // redirect page
                redirect(base_url('prices_admin'));
            } else {

                $data = [
                    'price_name' => $price_name,
                    'price_about' => $price_about,
                    'price_add_date' => $price_add_date,
                    'price_status' => $price_status,
                    'price_updater_id' => $_SESSION['admin_login_id'],
                    'price_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Prices_model->update_prices($id, $data);

                $this->session->set_flashdata('success', "Qiymət uğurla yeniləndi!");

                redirect(base_url('prices_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Prices_img_delete($id){
        $data = [
            'price_img' => "",
            'price_img_ext' => "",
        ];

        $this->Prices_model->update_prices($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ======================Prices End=========================





    // ======================Plans Start=========================


    public function Plans_list()
    {
    $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
    $data['get_all_plans'] = $this->Training_plan_model->get_all_plans();

    $this->load->view("admin/training_plan/training_plan", $data);
    }

    public function Plans_create()
    {
        $this->load->view("admin/training_plan/training_plan_create");
    }

    public function Plans_create_act(){
        $plan_name = $_POST['title'];
        $plan_about = $_POST['description'];
        $plan_add_date = $_POST['date'];
        $plan_status = $_POST['status'];

        if (!empty($plan_name) && !empty($plan_about) && !empty($plan_add_date) && !empty($plan_status)) {

            $config['upload_path'] = './uploads/plans/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);


            if ($this->upload->do_upload('img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'plan_name' => $plan_name,
                    'plan_about' => $plan_about,
                    'plan_add_date' => $plan_add_date,
                    'plan_status' => $plan_status,
                    'plan_img' => $file_name,
                    'plan_img_ext' => $file_ext,
                    'plan_creator_id' => $_SESSION['admin_login_id'],
                ];


                $data = $this->security->xss_clean($data);

                // insert to DATABASE code
                $this->Training_plan_model->insert($data);


                // notification for post added successfully
                $this->session->set_flashdata('success', "Təlim planı uğurla əlavə olundu");

                // redirect to page
                redirect(base_url('plans_admin'));
            } else {
                $data = [
                    'plan_name' => $plan_name,
                    'plan_about' => $plan_about,
                    'plan_add_date' => $plan_add_date,
                    'plan_status' => $plan_status,
                    'plan_creator_id' => $_SESSION['admin_login_id'],
                ];

                $data = $this->security->xss_clean($data);

                $this->Training_plan_model->insert($data);

                $this->session->set_flashdata('success', "Təlim planı uğurla əlavə olundu");

                redirect(base_url('plans_admin'));
            }


        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Plans_detail($id)
    {
        $data['training_plan_single'] = $this->Training_plan_model->get_single_plan($id);
        // print_r($data['course_single']);
        // die();

        $this->load->view('admin/training_plan/training_plan_detail', $data);
    }

    public function Plans_edit($id)
    {
        $data['training_plan_single'] = $this->db->where('plan_id', $id)->get('training_plan')->row_array();
        $this->load->view('admin/training_plan/training_plan_edit', $data);
    }

    public function Plans_edit_act($id){
        $plan_name = $_POST['title'];
        $plan_about = $_POST['description'];
        $plan_add_date = $_POST['date'];
        $plan_status = $_POST['status'];


        if (!empty($plan_name) && !empty($plan_about) && !empty($plan_add_date) && !empty($plan_status)) {


            $config['upload_path'] = "./uploads/plans/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'plan_name' => $plan_name,
                    'plan_about' => $plan_about,
                    'plan_add_date' => $plan_add_date,
                    'plan_status' => $plan_status,
                    'plan_img' => $file_name,
                    'plan_img_ext' => $file_ext,
                    'plan_updater_id' => $_SESSION['admin_login_id'],
                    'plan_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // insert to db code
                $this->Training_plan_model->update_plan($id, $data);

                // notification
                $this->session->set_flashdata('success', "Təlim planı uğurla yeniləndi!");

                // redirect page
                redirect(base_url('plans_admin'));
            } else {

                $data = [
                    'plan_name' => $plan_name,
                    'plan_about' => $plan_about,
                    'plan_add_date' => $plan_add_date,
                    'plan_status' => $plan_status,
                    'plan_updater_id' => $_SESSION['admin_login_id'],
                    'plan_update_date' => date("Y-m-d H:i:s"),
                ];

                $id = $this->security->xss_clean($id);
                $data = $this->security->xss_clean($data);

                // update in db info
                $this->Training_plan_model->update_plan($id, $data);

                $this->session->set_flashdata('success', "Təlim planı uğurla yeniləndi!");

                redirect(base_url('plans_admin'));
            }

        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function Plans_delete($id){
        $this->Training_plan_model->delete_plan($id);
    }

    public function Plans_img_delete($id){
        $data = [
            'plan_img' => "",
            'plan_img_ext' => "",
        ];

        $this->Training_plan_model->update_plan($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }


    // ======================Plans End=========================



    



    // ========================CONTACT START==========================


    // public function contact_admin()
    // {
    //     $data['get_messages'] = $this->Contact_model->get_all_messages();

    //     $this->load->view('admin/contact/messages', $data);
    // }

    // public function contact_message_act()
    // {
    //     $message = $_POST['message'];
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $subject = $_POST['subject'];

    //     if (!empty($message) && !empty($name) && !empty($email) && !empty($subject)) {
    //         $data = [
    //             'contact_message' => $message,
    //             'contact_name' => $name,
    //             'contact_email' => $email,
    //             'contact_date' => date("Y-m-d H:i:s"),
    //             'contact_subject' => $subject,
    //             'contact_status' => "Müraciət cavablandırılmayıb"
    //         ];


    //         $data = $this->security->xss_clean($data);

    //         // insert to DATABASE code
    //         $this->Contact_model->insert($data);


    //         // notification for post added successfully
    //         $this->session->set_flashdata('success', "Mesaj uğurla göndərildi");

    //         // redirect to page
    //         redirect(base_url('contact'));
    //     }
    // }

    // public function contact_message_detail($id)
    // {
    //     $data['get_single_message'] = $this->Contact_model->contact_single($id);

    //     $this->load->view('admin/contact/message_single', $data);
    // }

    // public function contact_viewed($id)
    // {

    //     $data = [
    //         'contact_status' => 'Müraciət cavablandırılıb',
    //         'contact_viewer_id' => $_SESSION['admin_login_id'],
    //         'contact_viewed_date' => date('Y-m-d H:i:s')
    //     ];

    //     $this->Contact_model->viewed($id, $data);

    //     redirect(base_url('admin_contact'));

    // }

    // public function contact_view_delete($id)
    // {
    //     $data = [
    //         'contact_status' => 'Müraciət cavablandırılmayıb',
    //         'contact_viewed_date' => '',
    //         'contact_viewer_id' => '',
    //     ];

    //     $this->Contact_model->view_delete($id, $data);

    //     redirect(base_url('admin_contact'));
    // }

    // public function contact_delete($id)
    // {
    //     $this->Contact_model->contact_delete($id);
    // }

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