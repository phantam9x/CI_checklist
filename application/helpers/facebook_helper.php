<?php 

if(!function_exists('load_facebook_jdk')) {
	function load_facebook_jdk() {
		
		$CI =& get_instance();
		$fb = new Facebook\Facebook([
		  'app_id' => $CI->config->item('app_id'),
		  'app_secret' => $CI->config->item('app_secret'),
		  'default_graph_version' => $CI->config->item('graph_version')
		]);
		return $fb;
	}
}