<?php 

/**
* 
*/
class FundController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('financeTimeModel');
		$this->load->model('fundModel');
	}

	function showFormAdd() {
		$time = $this->financeTimeModel->get_finance_time_by_date();
		$this->load->view('layout/main',[
			'sub_view' => 'finance/fund_add',
			'day' =>$this->financeTimeModel->day,
			'list_fund' => $this->fundModel->get_fund_by_date($time)
		]);
	}

	function handleFormAdd() {
		$time = $this->financeTimeModel->get_finance_time_by_date();
		$this->form_validation->set_rules('value','Số tiền','required|regex_match[/\d/]',[
			'required'=>'Vui lòng nhập vào số tiền',
			'regex_match' =>'Vui lòng nhập vào một số'
		]);
		$this->form_validation->set_rules('title','Tên quỹ','required',['required'=>'Vui lòng nhập tên quỹ']);
		if($this->form_validation->run()) {
			$this->fundModel->add([
				'fun_note' => $this->input->post('note'),
				'fun_value' => $this->input->post('value'),
				'fun_title' => $this->input->post('title')
			], $time);
		}
		$this->load->view("layout/main",[
			'sub_view' => 'finance/fund_add',
			'list_fund' => $this->fundModel->get_fund_by_date($time),
			'day' =>$this->financeTimeModel->day
		]);
	}

	function delete($id) {
		$this->fundModel->delete($id);
		set_message('Xóa thành công','SUCCESS');
		redirect(base_url('income/add'));
	}

}