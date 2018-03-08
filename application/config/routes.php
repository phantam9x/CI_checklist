<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Auth route
$route['login']['GET'] = 'authController/showFormLogin';
$route['login']['POST'] = 'authController/handleFormLogin';
$route['login/fb'] = 'authController/handleLoginFb';
$route['registration']['GET'] = 'authController/showFormRegistration';
$route['registration']['POST'] = 'authController/handleFormRegistration';

//User route
$route['user/info']['GET'] = 'userController/info';
$route['user/updated']['POST'] = 'userController/updated';
$route['home']['GET'] = 'userController/home';
$route['user/upload-avatar']['POST'] = 'userController/uploadAvatar';


