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
$route['about'] = 'UserController/about';
$route['contact'] = 'UserController/contact';
$route['courses'] = 'UserController/courses';
$route['blog'] = 'UserController/blog';



// ---------------ADMIN SIDE----------------- //
$route['admin_default'] = 'AdminController';
$route['admin_page'] = 'AdminController/index';
$route['admin_login'] = 'AdminController/login_page';

$route['login_act'] = "AdminController/login_act";
$route['log_out'] = "AdminController/log_out";

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
$route['forgot_password'] = 'AdminController/forget_password';
$route['error404'] = 'AdminController/error';
$route['error-misc'] = 'AdminController/error2';



$route['404_override'] = 'error_php';
$route['translate_uri_dashes'] = FALSE;
