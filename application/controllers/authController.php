<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller
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
		$redirect_url = base_url('/login/fb');
		$login_url = $helper->getLoginUrl($redirect_url, $permissions);
		$this->load->view('layout/auth',[
			'url_login_fb'	=> $login_url,
			'sub_view'		=> 'login',
			'title'         => 'Đăng nhập'
		]);		
	}
	
	function logout() {
		unset($_SESSION['login']);
		redirect(base_url('login'));
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
						$_SESSION['login'] = TRUE;
						$_SESSION['use_id'] = $info_user['use_id'];
						$_SESSION['use_fullname'] = $info_user['use_fullname'];
						$_SESSION['use_avatar'] = $info_user['use_avatar'];
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
						set_message('Xin chào bạn '.$info_user['use_fullname'],'SUCCESS');
						redirect(base_url('/'));
					}
				}
				]],['check_isset_user'=> 'Tài khoản hoặc mật khẩu không đúng']
			);
			$this->form_validation->run();
		}

		$helper = $this->fb->FB->getRedirectLoginHelper();
		$permissions = $this->config->item('permissions');
		$redirect_url = base_url('/login/fb');
		$login_url = $helper->getLoginUrl($redirect_url, $permissions);
		$this->load->view('layout/auth',[
			'url_login_fb'	=> $login_url,
			'sub_view'		=> 'login',
			'title'         => 'Đăng nhập'
		]);	
	}

	function handleLoginFb() {
		$fb = $this->fb->FB;
		$helper = $fb->getRedirectLoginHelper();

		try {
  			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// set_message('Lỗi Graph: '.$e->getMessage(),'ERROR');
			redirect(base_url('login'));
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// set_message($e->getMessage(), 'ERROR');
			redirect(base_url('login'));
		}

		$this->fb->set_token($accessToken);
		$result 	= $this->fb->set_fields(['id', 'name', 'picture'])
							   ->get_data_by_graph('me');
		$fullname 	= $result['name'];
		$id_fb 		= $result['id'];
		$avatar_fb 	= $result['picture']['url'];
		$info_user = $this->userModel->get_user_by_id_fb($id_fb);
		if(empty($info_user)) $user_id = $this->userModel->created_user_login_fb($id_fb, $fullname, $avatar_fb);
		else {
			$user_id = $info_user['use_id'];
			$fullname = $info_user['use_fullname'];
		} 
		$_SESSION['login'] = TRUE;
		$_SESSION['use_id'] = $user_id;
		$_SESSION['use_fullname'] = $fullname;
		$_SESSION['use_avatar'] = $info_user['use_avatar'];
		redirect(base_url());
	}

	function showFormRegistration() {
		$this->load->view('layout/auth',[
		    'sub_view'=>'registration',
		    'title'         => 'Đăng ký'
		]);	
	}

	function handleFormRegistration() {
		$this->form_validation->set_rules('user_name', 'Tên đăng ký',[
			'required',
			'min_length[6]',
			'max_length[16]',
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
			'check_isset_user_name'=> 'Tên đã tồn tại vui lòng chọn một tên khác'
		]);
		$this->form_validation->set_rules('password', 'Mật khẩu','required|min_length[6]|max_length[16]', [
			'required'=>'Vui lòng nhập vào mật khẩu',
			'min_length' => 'Mật khẩu phải lớn hơn 6 ký tự',
			'max_length' => 'Mật khẩu phải nhỏ hơn 16 ký tự'
		]);
		$this->form_validation->set_rules('fullname', 'Họ và tên','required|max_length[50]', [
			'required'=>'Vui lòng nhập vào tên hiển thị',
			'max_length' => 'Tên của bạn phải nhỏ hơn 50 ký tự'
		]);
		$this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', "matches[password]", [
			'matches'=>'Mật khẩu vừa nhập không khớp'
		]);

		if($this->form_validation->run()) {
			$user_name = $this->input->post('user_name');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$this->userModel->created_user($user_name, $fullname, $password);
			set_message("{$fullname} đã tạo tài khoản thành công! Vui lòng đăng nhập ");
			redirect(base_url('login'));
		}
		
		$this->load->view('layout/auth',[
		    'sub_view'=>'registration',
		    'title'         => 'Đăng ký'
		]);	
	}
}