<?php 
/**
* 
*/
class userController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('userModel');
		// dd($_SESSION);
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
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('img_file')) {
             $_SESSION['error']=$this->upload->display_errors();

        } else {
            $data = $this->upload->data();
            $this->userModel->updated_avatar($config['upload_path'].$data['file_name'], $my_id);
        }
	}

	function updated() {
		$my_id = 2;
		$this->form_validation->set_rules('fullname', 'Họ và tên','xss_clean|required|max_length[50]', [
			'required'=>'Vui lòng nhập vào tên hiển thị',
			'max_length' => 'Tên của bạn phải nhỏ hơn 50 ký tự',
			'xss_clean' => ''
		]);
		if($this->form_validation->run()) {
			$this->userModel->updated_info([
				'fullname'=> $this->input->post('fullname')
			], $my_id);
			echo "<script>slert('Thay đổi thông tin thành công');</script>";
		}
		$info_user = $this->userModel->get_user_by_id($my_id);
		$this->load->view('layout/main',['sub_view'=>'info_user','info'=>$info_user]);
	}
}