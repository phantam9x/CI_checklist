<?php 

/**
* 
*/
class permission 
{
	
	function __construct() {
		$url_allow = ['/login','/registration','/login/fb'];
		$url_present = $_SERVER['REDIRECT_QUERY_STRING'] ?? '';
		if(!in_array($url_present, $url_allow) && !isset($_SESSION['login'])) {
			set_message('Phiên đăng nhập đã hết, vui lòng đăng nhập lại','WARNING');
			redirect(base_url('/login'));
		} elseif(in_array($url_present, $url_allow) && isset($_SESSION['login'])) {
			redirect(base_url());
		}
	}
}