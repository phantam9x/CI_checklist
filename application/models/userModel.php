<?php 

class userModel extends CI_Model {

	function get_user_by_name($name) {
		return $result = $this->db->get_where('users',['use_name'=>$name])->row_array();
	}

	function get_user_by_id_fb($id) {
		return $result = $this->db->get_where('users',['use_id_fb'=>$id])->row_array();
	}

	function get_user_by_id($id) {
		return $result = $this->db->get_where('users',['use_id'=>$id])->row_array();
	}

	function created_user($user_name, $fullname, $password) {
		$salt 		=  md5($user_name.time());
		$password 	= md5($password.$salt);
		$this->db->insert('users',[
			'use_salt' => $salt,
			'use_fullname' => $fullname,
			'use_password' => $password,
			'use_name' => $user_name
		]);
	}

	function updated_avatar($path, $id) {
		$this->db->where('use_id', $id)->update('users', ['use_avatar'=>$path]);
	}

	function created_user_login_fb($id, $fullname, $avatar) {
		return $this->db->insert('users',[
			'use_fullname' => $fullname,
			'use_avatar' => $avatar,
			'use_id_fb' => $id
		]);
	}

	function updated_info($data, $id) {
		$this->db->where('use_id', $id)->update('users', $data);
	}
}