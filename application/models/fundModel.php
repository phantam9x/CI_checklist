<?php 

/**
* 
*/
class fundModel extends CI_Model {
	
	function add($data, $time) {
		$data['fun_time'] = $time;
		$data['fun_created_by'] = get_user_id();
		return $this->db->insert('funds', $data);
	}

	function get_fund_by_date($time) {
		return $this->db->get_where('funds', ['fun_time' => $time,'fun_created_by'=> get_user_id()])->result_array();
	}

	function delete($fund_id) {
		$this->db->where('fun_id', $fund_id)->delete('funds');
	}
}