<?php 
/**
* 
*/
class UserController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('userModel');
		$this->form_validation->set_error_delimiters('<p class="text-error help-block">', '</p>');
	}

	function info() {
		$id = 2;
		$info_user = $this->userModel->get_user_by_id($id);
		$this->load->view('layout/main',['sub_view'=>'info_user','info'=>$info_user]);
	}

	function uploadAvatar() {
		$my_id = 2;
		$config['upload_path']          = 'public/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 2024;
        $config['max_height']           = 1168;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('img_file')) {
            $this->upload->display_errors();
			return false;
        } else {
            $data = $this->upload->data();
            $this->userModel->updated_avatar($config['upload_path'].$data['file_name'], $my_id);
        }
	}

	function updated() {

		$my_id = 2;
		$this->form_validation->set_rules('fullname', 'Họ và tên','required|max_length[50]', [
			'required'=>'Vui lòng nhập vào tên hiển thị',
			'max_length' => 'Tên của bạn phải nhỏ hơn 50 ký tự'
		]);
		if($this->form_validation->run()) {
			$this->userModel->updated_info([
				'use_fullname'=> $this->input->post('fullname')
			], $my_id);
			set_message('Thay đổi thông tin thành công','SUCCESS');
			 // dd($_SESSION);
		} 
		$info_user = $this->userModel->get_user_by_id($my_id);
		$this->load->view('layout/main',[
			'sub_view'			=>'info_user',
			'info'				=>$info_user
		]);
		
	}
}