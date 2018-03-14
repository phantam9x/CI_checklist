<?php 

/**
* 
*/
class IncomeController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('incomeModel');
		$this->load->model('financeTimeModel');
	}

	function showFormAdd() {
		$time = $this->financeTimeModel->get_finance_time_by_date();
		$this->load->view("layout/main",[
			'sub_view' => 'finance/income_add',
			'list_income' => $this->incomeModel->get_income_by_date($time),
			'day' =>$this->financeTimeModel->day
		]);
	}

	function handleFormAdd() {
		$time = $this->financeTimeModel->get_finance_time_by_date();
		$this->form_validation->set_rules('value','Số tiền','required|regex_match[/\d/]',[
			'required'=>'Vui lòng nhập vào số tiền',
			'regex_match' =>'Vui lòng nhập vào một số'
		]);
		$this->form_validation->set_rules('source','Nguồn thu nhập từ','required',['required'=>'Vui lòng nhập nguồn thu nhập']);
		if($this->form_validation->run()) {
			$this->incomeModel->add([
				'inc_note' => $this->input->post('note'),
				'inc_value' => $this->input->post('value'),
				'inc_source' => $this->input->post('source'),
				'inc_type' => $this->input->post('type')
			], $time);
		}
		$this->load->view("layout/main",[
			'sub_view' => 'finance/income_add',
			'list_income' => $this->incomeModel->get_income_by_date($time),
			'day' =>$this->financeTimeModel->day
		]);
	}

	function delete($id) {
		$this->incomeModel->delete($id);
		set_message('Xóa thành công','SUCCESS');
		redirect(base_url('income/add'));
	}


	function showFormEdit($income_id) {
		$detail_income = $this->incomeModel->get_detail($income_id);
		!empty($detail_income) ||redirect(base_url('/work'));
		$_POST = [
			'source'=> $detail_income['inc_source'],
			'value'=> $detail_income['inc_value'],
			'type'=> $detail_income['inc_type'],
			'note'=> $detail_income['inc_note']
		];
		$this->form_validation->run();
		$this->load->view('layout/main',[
			'sub_view'=>'finance/income_edit'
		]);		
	}

	function handleFormEdit($income_id) {
		$detail_income = $this->incomeModel->get_detail($income_id);
		!empty($detail_income) ||redirect(base_url('/work'));
		$this->form_validation->set_rules('value','Số tiền','required|regex_match[/\d/]',[
			'required'=>'Vui lòng nhập vào số tiền',
			'regex_match' =>'Vui lòng nhập vào một số'
		]);
		$this->form_validation->set_rules('source','Nguồn thu nhập từ','required',['required'=>'Vui lòng nhập nguồn thu nhập']);
		if($this->form_validation->run()) {
			$this->incomeModel->updated([
				'inc_note' => $this->input->post('note'),
				'inc_value' => $this->input->post('value'),
				'inc_source' => $this->input->post('source'),
				'inc_type' => $this->input->post('type')
			], $income_id);
			set_message('Cập nhật nguồn thu thành công','SUCCESS');
			redirect(base_url('/work'));
		} else $this->form_validation->set_error_delimiters('<p class="help-block"><span class="text-danger">','</span></p>');
		$this->load->view('layout/main',[
			'sub_view'=>'finance/income_edit'
		]);
	}
}