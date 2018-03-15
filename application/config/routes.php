<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'WorkController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Auth route
$route['login']['GET'] 			= 'AuthController/showFormLogin';
$route['login']['POST'] 		= 'AuthController/handleFormLogin';
$route['login/fb'] 				= 'AuthController/handleLoginFb';
$route['logout'] 				= 'AuthController/logout';
$route['registration']['GET'] 	= 'AuthController/showFormRegistration';
$route['registration']['POST'] 	= 'AuthController/handleFormRegistration';

//Work route
$route['work'] 									= 'WorkController/index';
$route['work/add/(:num)-(:num)-(:num)']['GET'] 	= 'WorkController/showFormAdd/$1/$2/$3';
$route['work/add/(:num)-(:num)-(:num)']['POST'] = 'WorkController/handleFormAdd/$1/$2/$3';
$route['work/edit/(:num)']['GET'] 				= 'WorkController/showFormEdit/$1';
$route['work/edit/(:num)']['POST'] 				= 'WorkController/handleFormEdit/$1';
$route['work/delete/(:num)']['GET'] 			= 'WorkController/deleteWork/$1';
$route['work/option/(:any)/(:num)']['GET'] 		= 'WorkController/optionAct/$1/$2';

