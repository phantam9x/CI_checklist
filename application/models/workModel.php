<?php 

/**
* 
*/
class workModel extends CI_Model
{
	
	function add_work($data,$d, $m, $y) {
		$work_time = $this->get_time_work_by_date($d, $m, $y);
		if(empty($work_time)) { 
			$work_time = $this->db->insert('work_time',[
				'wot_day'=> $d,
				'wot_month'=> $m,
				'wot_year'=> $y
			]);
		};
		$data['wor_time'] = $work_time;
		return $this->db->insert('works',$data);
	}

	function updated_work($data, $work_id) {
		$this->db->where('wor_id', $work_id)->update('works', $data);
	}

	function get_detail_work($work_id) {
		return $this->db->get_where('works',['wor_id'=>$work_id])->row_array();
	}

	function set_work_success($work_id) {
		$this->db->where('wor_id', $work_id)->update('works', ['wor_status'=>'yes']);
		return 'hoàn thành';
	}

	function set_work_failed($work_id) {
		$this->db->where('wor_id', $work_id)->update('works', ['wor_status'=>'no']);
		return 'hủy';
	}

	function set_work_pending($work_id) {
		$this->db->where('wor_id', $work_id)->update('works', ['wor_status'=>'pending']);
		return 'chờ';
	}

	function set_work_active($work_id) {
		$this->db->where('wor_id', $work_id)->update('works', ['wor_status'=>'active']);
		return 'đang làm ';
	}

	function delete_work($work_id) {
		$this->db->where('wor_id', $work_id)->delete('works');
	}

	function get_time_work_by_date($d='',$m='',$y='') {
		$d = empty($d) ? date('d',time()) : $d;
		$m = empty($m) ? date('m',time()) : $m;
		$y = empty($y) ? date('Y',time()) : $y;
		$result = $this->db->get_where('work_time', [
			'wot_day'=> $d,
			'wot_month'=> $m,
			'wot_year'=> $y
		])->row_array();
		return empty($result) ? 0 : $result['wot_id'];
	}
	function get_all_work_by_date($work_time) {
		$user_id = get_user_id();
		$list_work = $this->db->get_where('works',['wor_created_by'=> $user_id,'wor_time'=>$work_time])->result_array();
		$result = [];
		$work_success = [];
		foreach($list_work as &$item) {
			if(!in_array($item['wor_status'], ['yes','no'])) {
				switch ($item['wor_type']) {
								case 1:
									$item['wor_type'] = 'danger';
									$result[] = $item;
									break;				
								case 2:
									$item['wor_type'] = 'warning';
									$result[] = $item;
									break;
								case 3:
									$item['wor_type'] = 'info';
									$result[] = $item;
									break;
								case 4:
									$item['wor_type'] = 'light';
									$result[] = $item;
									break;
							}
			} else {
				$work_success[] = $item;
			}
		}
		$list_work =  array_merge($result, $work_success);
		foreach ($list_work as &$item) {
			switch ($item['wor_status']) {
				case 'pending':
					$item['wor_status'] = '<span class="label label-info" style="min-width:60px;display:inline-block;padding:4px 0">Chưa song</span>';
					break;
				case 'yes':
					$item['wor_status'] = '<span class="label label-success" style="min-width:60px;display:inline-block;padding:4px 0">Đã xong</span>';
					break;
				case 'no':
					$item['wor_status'] = '<span class="label label-danger" style="min-width:60px;display:inline-block;padding:4x 0">Thất bại</span>';
					break;
				case 'active':
					$item['wor_status'] = '<span class="label label-warning" style="min-width:60px;display:inline-block;padding:4px 0">Đang làm</span>';
					break;
			}
		}
		return $list_work;
	}
}