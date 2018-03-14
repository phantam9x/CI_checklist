<?php 

/**
* 
*/
class incomeModel extends CI_Model {
	
	function add($data, $time) {
		$data['inc_time'] = $time;
		$data['inc_created_by'] = get_user_id();
		return $this->db->insert('income', $data);
	}

	function updated($data, $income_id) {
		$this->db->where('inc_id', $income_id)->update('income', $data);
	}



	function get_income_by_date($time) {
		return $this->db->get_where('income', ['inc_time' => $time,'inc_created_by'=> get_user_id()])->result_array();
	}

	function delete($income_id) {
		$this->db->where('inc_id', $income_id)->delete('income');
	}

	function get_detail($income_id) {
		return $this->db->get_where('income',['inc_id'=>$income_id])->row_array();
	}
}