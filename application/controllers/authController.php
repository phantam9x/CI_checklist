<?php 

class authController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('userModel');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->load->helper('cookie');
	}

	function showFormLogin() {
		$helper = $this->fb->FB->getRedirectLoginHelper();
		$permissions = $this->config->item('permissions');
		$redirect_url = 'http://folder.info/CI_vote_fb/login/fb';
		$login_url = $helper->getLoginUrl($redirect_url, $permissions);
		$this->load->view('login',['url_login_fb'=> $login_url]);		
	}

	function handleFormLogin() {
		$this->form_validation->set_rules('user_name', 'Tên đăng ký','required|min_length[6]|max_length[16]',[
			'required'=>'Vui lòng nhập vào tên đăng nhập',
			'min_length' => 'Tên đăng nhập phải lớn hơn 6 ký tự',
			'max_length' => 'Tên đăng nhâp phải nhỏ hơn 16 ký tự'
		]);
		$this->form_validation->set_rules('password', 'Mật khẩu','required|min_length[6]|max_length[16]', [
			'required'=>'Vui lòng nhập vào mật khẩu',
			'min_length' => 'Mật khẩu phải lớn hơn 6 ký tự',
			'max_length' => 'Mật khẩu phải nhỏ hơn 16 ký tự'
		]);

		if($this->form_validation->run()) {
			$this->form_validation->reset_validation();
			$this->form_validation->set_data(['login'=>'']);
			$this->form_validation->set_rules('login','Kiểm tra sự tồn tại của tài khoản',[[
				"check_isset_user",
				function() {
					$user_name = $this->input->post('user_name');
					$password = $this->input->post('password');
					$info_user = $this->userModel->get_user_by_name($user_name);
					if(empty($info_user) && $info_user['use_password'] !== md5($password.$info_user['use_salt'])) return FALSE;
					else {
						$_SESSION['use_login'] = TRUE;
						$remember_me = $this->input->post('remember_me');
						if(!empty($remember_me)) {
							set_cookie('use_avatar',$info_user['use_avatar'],3600);
							set_cookie('use_name',$info_user['use_name'],3600);
							set_cookie('use_password',$password,3600);
						} else {
							delete_cookie('use_avatar');
							delete_cookie('use_name');
							delete_cookie('use_password');
						}
					}
				}
				]],['check_isset_user'=> 'Tài khoản hoặc mật khẩu không đúng']
			);
			$this->form_validation->run();
		}

		$helper = $this->fb->FB->getRedirectLoginHelper();
		$permissions = $this->config->item('permissions');
		$redirect_url = 'http://folder.info/CI_vote_fb/login/fb';
		$login_url = $helper->getLoginUrl($redirect_url, $permissions);
		$this->load->view('login',['url_login_fb'=> $login_url]);
	}

	function handleLoginFb() {
		$fb = $this->fb->FB;
		$helper = $fb->getRedirectLoginHelper();

		try {
  			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			redirect(base_url().'/login');
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			redirect(base_url().'/login');
		}

		if (!isset($accessToken)) {
		  	if ($helper->getError()) {
			    redirect(base_url().'/login');
		 	} else {
		   		header('HTTP/1.0 400 Bad Request');
		 	}
		 	exit;
		}

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId($this->config->item('app_id')); // Replace {app-id} with your app id
		$tokenMetadata->validateExpiration();
		if(!$accessToken->isLongLived()) {
		  	try {
			    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
			    redirect(base_url().'/login');
			}
		}
		$this->fb->set_token($accessToken);
		$result 	= $this->fb->set_fields(['id','name'])->get_data_by_graph('me');
		$fullname 	= $result['name'];
		$id_fb 		= $result['id'];
		$result 	= $this->fb->set_fields(['picture'])->get_data_by_graph('me');
		$avatar_fb 	= $result['picture']['url'];
		$info_user = $this->userModel->get_user_by_id_fb($id_fb);
		if(empty($info_user)) $user_id = $this->userModel->created_user_login_fb($id_fb, $fullname, $avatar_fb);
		else $user_id = $info_user['use_id']; 
		$_SESSION['use_login'] = TRUE;
		$_SESSION['use_id'] = $user_id;
		redirect(base_url('/'));
	}

	function showFormRegistration() {
		$this->load->view('registration');
	}

	function test() {
		$this->load->view('layout/main',['sub_view'=>'home']);
	}

	function handleFormRegistration() {
		$this->form_validation->set_rules('user_name', 'Tên đăng ký',[
			'required',
			'min_length[6]',
			'max_length[16]',
			'xss_clean',
			'regex_match[/^[a-z0-9]+$/]',
			['check_isset_user_name',
			function($name) {
				$info_user = $this->userModel->get_user_by_name($name);
				return empty($info_user) ? TRUE : FALSE;
			}]
		],[
			'required'=>'Vui lòng nhập vào tên đăng ký',
			'regex_match'=>'Tên không được chứa các ký tự đặc biệt',
			'min_length' => 'Tên đăng ký phải lớn hơn 6 ký tự',
			'max_length' => 'Tên đăng ký phải nhỏ hơn 16 ký tự',
			'check_isset_user_name'=> 'Tên đã tồn tại vui lòng chọn một tên khác',
			'xss_clean' => ''
		]);
		$this->form_validation->set_rules('password', 'Mật khẩu','required|xss_clean|min_length[6]|max_length[16]', [
			'required'=>'Vui lòng nhập vào mật khẩu',
			'min_length' => 'Mật khẩu phải lớn hơn 6 ký tự',
			'max_length' => 'Mật khẩu phải nhỏ hơn 16 ký tự',
			'xss_clean' => ''
		]);
		$this->form_validation->set_rules('fullname', 'Họ và tên','xss_clean|required|max_length[50]', [
			'required'=>'Vui lòng nhập vào tên hiển thị',
			'max_length' => 'Tên của bạn phải nhỏ hơn 50 ký tự',
			'xss_clean' => ''
		]);
		$this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', "matches[password]", [
			'matches'=>'Mật khẩu vừa nhập không khớp'
		]);

		if($this->form_validation->run()) {
			$user_name = $this->input->post('user_name');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$this->userModel->created_user($user_name, $fullname, $password);
		} 
		$this->load->view('registration');
	}
}