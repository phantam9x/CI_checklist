<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Customer route
$route['login']['GET'] = 'authController/showFormLogin';
$route['login/fb'] = 'authController/handleLoginFb';
$route['registration']['GET'] = 'authController/showFormRegistration';
