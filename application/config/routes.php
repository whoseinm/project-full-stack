<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'UserController';
$route['home'] = 'UserController/index';
$route['treyners'] = "UserController/trainers";
$route['trainer_single/(.*)'] = "UserController/trainer_single/$1";
$route['about'] = 'UserController/about';
$route['contact'] = 'UserController/contact';
$route['courses'] = 'UserController/courses';
$route['course_single/(.*)'] = "UserController/course_single/$1";
$route['categories/(.*)'] = "UserController/categories/$1";
$route['blog'] = 'UserController/blog';
$route['blog_detail/(.*)'] = 'UserController/blog_detail/$1';



// ---------------ADMIN SIDE----------------- //
$route['admin_default'] = 'AdminController';
$route['admin_page'] = 'AdminController/index';
$route['admin_login'] = 'AdminController/login_page';

$route['login_act'] = "AdminController/login_act";
$route['log_out'] = "AdminController/log_out";



// ========================HERO CAPTION START==========================
$route['hero_caption'] = "AdminController/hero_caption";
$route['hero_caption_create'] = "AdminController/hero_caption_create";
$route['hero_caption_create_act'] = "AdminController/here_caption_create_act";
$route['hero_caption_delete/(.*)'] = "AdminController/hero_caption_delete/$1";
$route['hero_detail/(.*)'] = "AdminController/hero_detail/$1";

$route['hero_edit/(.*)'] = "AdminController/hero_update/$1";
$route['hero_update_act/(.*)'] = 'AdminController/hero_update_act/$1';
$route['slider_img_delete/(.*)'] = 'AdminController/slider_img_delete/$1';
// =========================HERO CAPTION END===========================


// =========================BLOG POSTS START===========================

$route['posts'] = "AdminController/posts";
$route['post_create'] = "AdminController/post_create";
$route['post_create_act'] = "AdminController/post_create_act";
$route['post_delete/(.*)'] = "AdminController/delete_post/$1";
$route['post_detail/(.*)'] = "AdminController/detail/$1";

$route['post_edit/(.*)'] = "AdminController/post_edit/$1";
$route['post_edit_act/(.*)'] = 'AdminController/post_edit_act/$1';
$route['post_img_delete/(.*)'] = 'AdminController/post_img_delete/$1';

// =========================BLOG POSTS END===========================

// =========================TRAINERS START===========================

$route['trainers'] = "AdminController/trainers_list";
$route['trainer_create'] = "AdminController/trainer_create";
$route['trainer_create_act'] = "AdminController/trainer_create_act";
$route['delete_trainer/(.*)'] = "AdminController/trainer_delete/$1";
$route['trainer_detail/(.*)'] = "AdminController/trainer_detail/$1";

$route['trainer_edit/(.*)'] = "AdminController/trainer_edit/$1";
$route['trainer_edit_act/(.*)'] = 'AdminController/trainer_edit_act/$1';
$route['trainer_img_delete/(.*)'] = 'AdminController/trainer_img_delete/$1';

// =========================TRAINERS END=============================




// =========================ABOUT START=============================


$route['admin_about'] = "AdminController/about_list";
$route['about_create'] = "AdminController/about_create";
$route['about_create_act'] = "AdminController/about_create_act";
$route['about_delete/(.*)'] = "AdminController/about_delete/$1";
$route['about_detail/(.*)'] = "AdminController/about_detail/$1";


$route['about_edit/(.*)'] = "AdminController/about_edit/$1";
$route['about_edit_act/(.*)'] = 'AdminController/about_edit_act/$1';
$route['about_img_delete/(.*)'] = 'AdminController/about_img_delete/$1';
// =========================ABOUT END=============================



// =======================COURSES START===========================
$route['courses_admin'] = "AdminController/courses";
$route['course_create'] = "AdminController/course_create";
$route['course_create_act'] = "AdminController/course_create_act";
$route['course_delete/(.*)'] = "AdminController/course_delete/$1";
$route['course_detail/(.*)'] = "AdminController/course_detail/$1";

$route['course_edit/(.*)'] = "AdminController/course_edit/$1";
$route['course_edit_act/(.*)'] = 'AdminController/course_edit_act/$1';
$route['course_img_delete/(.*)'] = 'AdminController/course_img_delete/$1';
// ========================COURSES END============================




// =======================CONTACT START===========================
$route['admin_contact'] = "AdminController/contact_admin";
$route['contact_message_act'] = "AdminController/contact_message_act";
$route['contact_message_single/(.*)'] = "AdminController/contact_message_detail/$1";
$route['contact_viewed/(.*)'] = "AdminController/contact_viewed/$1";
$route['contact_view_delete/(.*)'] = "AdminController/contact_view_delete/$1";
$route['contact_delete/(.*)'] = "AdminController/contact_delete/$1";

// ========================CONTACT END============================


$route['error404'] = 'AdminController/error';
$route['error-misc'] = 'AdminController/error2';



$route['404_override'] = 'error_php';
$route['translate_uri_dashes'] = FALSE;
