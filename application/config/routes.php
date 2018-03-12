<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Auth route
$route['login']['GET'] 			= 'AuthController/showFormLogin';
$route['login']['POST'] 		= 'AuthController/handleFormLogin';
$route['login/fb'] 				= 'AuthController/handleLoginFb';
$route['registration']['GET'] 	= 'AuthController/showFormRegistration';
$route['registration']['POST'] 	= 'AuthController/handleFormRegistration';

//User route
$route['user/info']['GET'] 				= 'UserController/info';
$route['user/info']['POST'] 			= 'UserController/updated';
$route['user/upload-avatar']['POST'] 	= 'UserController/uploadAvatar';

//Work route
$route['work'] 									= 'WorkController/index';
$route['work/add/(:num)-(:num)-(:num)']['GET'] 	= 'WorkController/showFormAdd/$1/$2/$3';
$route['work/add/(:num)-(:num)-(:num)']['POST'] = 'WorkController/handleFormAdd/$1/$2/$3';
$route['work/edit/(:num)']['GET'] 				= 'WorkController/showFormEdit/$1';
$route['work/edit/(:num)']['POST'] 				= 'WorkController/handleFormEdit/$1';
$route['work/delete/(:num)']['GET'] 			= 'WorkController/deleteWork/$1';
$route['work/option/(:any)/(:num)']['GET'] 		= 'WorkController/optionAct/$1/$2';

//Finance route
$route['finance'] = 'FinanceController/index';