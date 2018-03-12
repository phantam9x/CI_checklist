<?php 

if(!function_exists('get_user_avatar')) {
	function get_user_avatar() {
		return $_SESSION['use_avatar'] ?? '/public/images/user.png';
	}
}

if(!function_exists('get_user_id')) {
	function get_user_id() {
		return $_SESSION['use_id'];
	}
}

if(!function_exists('get_user_fullname')) {
	function get_user_fullname() {
		return $_SESSION['use_fullname'];
	}
}