<?php

if(!function_exists('set_message')) {
	function set_message($content, $type='success') {
		$type = strtolower($type);
		$list_type = ['warning','success'];
		if(in_array($type, $list_type)) {
			$_SESSION['message'][$type] = $content;
		}
	}
}

if(!function_exists('get_message')) {
	function get_message() {
		$list_type = ['warning','success'];
		foreach($list_type as $type) {
			if(isset($_SESSION['message'][$type])) {
				$result = "<span class='alert alert-{$type} message'>{$_SESSION['message'][$type]}<span class=\"close-message fa fa-close\"></span><span>";
				unset($_SESSION['message'][$type]);
				return $result;
			}
		}
		return '';
	}
}