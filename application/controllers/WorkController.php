<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class WorkController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('workModel');
	}

	function index() {
	    $month      =  $this->input->get('m');
	    $year 		= $this->input->get('y');
	    $today 		= $this->input->get('d');
		$month 		=  empty($month) ? (int)date('m', time()) : (int)$month;
		$year 		=  empty($year) ? (int)date('Y', time()) : (int)$year;
		$today 		=  empty($today) ? (int)date('d', time()) : (int)$today;

		checkdate($month, $today, $year)|| redirect(base_url('/work'));
		$work_time  = $this->workModel->get_time_work_by_date($today, $month, $year);
		$list_work 	= $this->workModel->get_all_work_by_date($work_time, $month, $year);
		$this->load->view('layout/main',[
			'sub_view'	=> 'work/list',
			'month' 	=> $month,
			'year'  	=> $year,
			'list_work' => $list_work,
			'today'     => $today,
			'title'     => 'Danh sách công việc'
		]);
	}
	function showFormAdd($d,$m,$y) {
		checkdate($m, $d, $y)&&$d>=date('d',time())&&$m==date('m',time())&&$y==date('Y',time())|| redirect(base_url('/work'));
		$this->load->view('layout/main',[
			'sub_view'=>'work/add',
			'day' =>$d,
			'mont' =>$m,
			'year' =>$y,
			'title'     => 'Thêm mới công việc',
			'list_work'=> $this->workModel->get_all_work_by_date($this->workModel->get_time_work_by_date($d,$m,$y))
		]);
	}

	function handleFormAdd($d,$m,$y) {
		checkdate($m, $d, $y)&&$d>=date('d',time())&&$m==date('m',time())&&$y==date('Y',time())|| redirect(base_url('/work'));
		$this->form_validation->set_rules('title','Tên công việc','required',['required'=>'Không được phép bỏ trống trường này']);
		$this->form_validation->set_rules('time_start','Thời gian bắt dầu','required',['required'=>'Không được bỏ trống']);
		$this->form_validation->set_rules('time_stop','Thời gian kết thúc','required',['required'=>'Không được bỏ trống']);
		if($this->form_validation->run()) {
			$this->workModel->add_work([
				'wor_title'=> $this->input->post('title'),
				'wor_time_start'=> $this->input->post('time_start').':00',
				'wor_time_stop'=> $this->input->post('time_stop').':00',
				'wor_note'=> $this->input->post('note'),
				'wor_type'=> $this->input->post('type'),
				'wor_created_at'=> time(),
				'wor_created_by'=> get_user_id()
			],$d , $m, $y);
			set_message('Thêm mới công việc thành công','SUCCESS');
		} else $this->form_validation->set_error_delimiters('<p class="help-block"><span class="text-danger">','</span></p>');
		$this->load->view('layout/main',[
			'sub_view'=>'work/add',
			'day' =>$d,
			'mont' =>$m,
			'year' =>$y,
			'title'     => 'Thêm mới công việc',
			'list_work'=> $this->workModel->get_all_work_by_date($this->workModel->get_time_work_by_date($d,$m,$y))
		]);
	}

	function showFormEdit($work_id) {
		$detail_work = $this->workModel->get_detail_work($work_id);
		!empty($detail_work) ||redirect(base_url('/work'));
		$_POST = [
			'title'=> $detail_work['wor_title'],
			'time_start'=> $detail_work['wor_time_start'],
			'time_stop'=> $detail_work['wor_time_stop'],
			'type'=> $detail_work['wor_type'],
			'created_at'=> $detail_work['wor_created_at'],
			'note'=> $detail_work['wor_note']
		];
		$this->form_validation->run();
		$this->load->view('layout/main',[
			'sub_view'=>'work/edit',
			'title'     => 'Chỉnh sửa công việc'
		]);		
	}

	function handleFormEdit($work_id) {
		$detail_work = $this->workModel->get_detail_work($work_id);
		!empty($detail_work) ||redirect(base_url('/work'));
		$_POST['created_at'] = $detail_work['wor_created_at'];
		$this->form_validation->set_rules('title','Tên công việc','required',['required'=>'Không được phép bỏ trống trường này']);
		$this->form_validation->set_rules('time_start','Thời gian bắt dầu','required',['required'=>'Không được bỏ trống']);
		$this->form_validation->set_rules('time_stop','Thời gian kết thúc','required',['required'=>'Không được bỏ trống']);
		if($this->form_validation->run()) {
			$this->workModel->updated_work([
				'wor_title'=> $this->input->post('title'),
				'wor_time_start'=> $this->input->post('time_start').':00',
				'wor_time_stop'=> $this->input->post('time_stop').':00',
				'wor_note'=> $this->input->post('note'),
				'wor_type'=> $this->input->post('type')
			], $work_id);
			set_message('Cập nhật công việc thành công','SUCCESS');
			redirect(base_url('/work'));
		} else $this->form_validation->set_error_delimiters('<p class="help-block"><span class="text-danger">','</span></p>');
		$this->load->view('layout/main',[
			'sub_view'=>'work/edit',
			'title'     => 'Chỉnh sửa công việc'
		]);
	}

	function deleteWork($id) {
		$this->workModel->delete_work($id);
		set_message('Xóa thành công','SUCCESS');
		redirect(base_url('work/add'));
	}

	function optionAct($type, $work_id) {
		$result = '';
		switch ($type) {
			case 'yes':
				$result = $this->workModel->set_work_success($work_id);
				break;
			case 'no':
				$result = $this->workModel->set_work_failed($work_id);
				break;
			case 'pending':
				$result = $this->workModel->set_work_pending($work_id);
				break;
			case 'active':
				$result = $this->workModel->set_work_active($work_id);
				break; 
		}
		set_message("Đưa công việc về trạng thái {$result} thành công !");
		redirect(base_url('work'));
	}
}