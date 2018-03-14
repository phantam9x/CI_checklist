<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'WorkController/index';
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
$route['income/add']['GET'] = 'finance/IncomeController/showFormAdd';
$route['income/add']['POST'] = 'finance/IncomeController/handleFormAdd';
$route['income/delete/(:num)']['GET'] = 'finance/IncomeController/delete/$1';
$route['income/edit/(:num)']['GET'] = 'finance/IncomeController/showFormEdit/$1';
$route['income/edit/(:num)']['POST'] = 'finance/IncomeController/handleFormEdit/$1';

$route['fund/add']['GET'] = 'finance/FundController/showFormAdd';
$route['fund/add']['POST'] = 'finance/FundController/handleFormAdd';
$route['income/delete/(:num)']['GET'] = 'finance/FundController/delete/$1';

