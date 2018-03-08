<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fb {

		public $FB;
		protected $CI;
		protected $fields;

		function __construct() {
			$this->CI =& get_instance();
			$this->FB = new Facebook\Facebook([
			  'app_id' 					=> $this->CI->config->item('app_id'),
			  'app_secret' 				=> $this->CI->config->item('app_secret'),
			  'default_graph_version' 	=> $this->CI->config->item('graph_version')
			]);
		}

		function set_fields(array $fields) {
			$this->fields = implode(',', $fields);
			return $this;
		}

		function get_token() {
			return $_SESSION['fb_access_token'] ?? null;
		}

		function set_token(string $token) {
			$_SESSION['fb_access_token'] = $token;
		}

		function get_data_by_graph($node) {
			$access_token 	= $this->get_token();
			$fields 		= $this->fields;
			try {
				$response = $this->FB->get("/{$node}?fields={$fields}", $access_token);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage(); 
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			return $user = $response->getGraphUser();
		}

	}