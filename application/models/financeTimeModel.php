<?php 
/**
* 
*/
class financeTimeModel extends CI_Model {
	
	//Ngày bắt đầu và kết thúc của tháng
	public $day = 10;
	function get_finance_time_by_date() {
		$month = date('m', time());
		$year = date('Y', time());
		$result = $this->db->select('fit_id')
							->get_where('finance_time',[
			'fit_month_start'=>$month,
			'fit_month_stop' => $month+1,
			'fit_year' => $year
		])
						   ->row_array();
		if(empty($result)) $fit_id = $this->set_finance_time();
		else $fit_id = $result['fit_id'];
		return $fit_id; 
	}

	function set_finance_time() {
		$this->db->insert('finance_time',[
			'fit_day' 			=> $this->day,
			'fit_month_start' 	=> date('m', time()),
			'fit_month_stop' 	=> date('m', time())+1,
			'fit_year' 			=> date('Y', time())
		]);
		$time =  $this->db->insert_id();
		$this->auto_add_fund($time);
		return $time;
	}

	protected function auto_add_fund($time) {
		$list_title = [
			'Qũy 1','Qũy 2'
		];
		$data = [];
		foreach ($list_title as $title) {
			$data[] = [
				'fun_time' => $time,
				'fun_title' => $title,
				'fun_created_by' => get_user_id()
			];
		}
		$this->db->insert_batch('funds', $data);
	}

}