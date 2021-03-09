<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class Income_manage_controller extends IMS_controller
{
	function load_v_income_manage()
	{

		$this->output('v_income_manage');
	}

	function insert_data()
	{
		$this->load->model('M_income', 'mc');
		$this->mc->list_user_id = $this->session->user_id;
		$this->mc->list_type = $this->input->post("list_type");
		$this->mc->list_detail = $this->input->post("list_detail");
		$this->mc->list_category_id = $this->input->post("list_category_id");
		$this->mc->list_create_date = $this->input->post("list_create_date");
		$this->mc->list_cost = $this->input->post("list_cost");
		$this->mc->insert();
	}
	// 
	public function delete_list()
	{
		$this->load->model('M_income', 'mic');
		$this->mic->list_id = $this->input->post("list_id");
		$this->mic->delete_list();
		$this->load->model('M_summary', 'ms');
		$this->ms->sl_user_id = $this->session->user_id;
		// $sum_income = $this->ms->get_summary()->result();
		$this->ms->sl_month =  3; //substr($this->mic->list_create_date,6,1);
		$this->ms->sl_year = 2021; //substr($this->mic->list_create_date,0,4);
		$sum_income = $this->ms->get_summary()->result();
		$cost_income = intval($sum_income[0]->sl_income);
		$cost_expend = intval($sum_income[0]->sl_expend);
		$cost_balance = intval($sum_income[0]->sl_balance);
		$type =  $this->input->post("list_type");
		$cost =  $this->input->post("list_cost");
		if ($type == 1) {
			$cost_income -= $cost;
			$cost_balance -= $cost;
		} else {
			$cost_expend -= $cost;
			$cost_balance += $cost;
		}
		$this->ms->sl_income = $cost_income;
		$this->ms->sl_expend = $cost_expend;
		$this->ms->sl_balance = $cost_balance;
		$this->ms->update_sum_list();

		// $this->mc->update_delete();
		$data =  true;
		echo json_encode($data);
	}
	// public function update_summary()
	// {	
	// 	$this->load->model('M_summary', 'ms');
	// 	$this->ms->sl_income = $this->input->post("sl_income");
	// 	$this->ms->sl_expend = $this->input->post("sl_expend");
	// 	$this->ms->sl_balance = $this->input->post("sl_balance");
	// 	// $this->ms->sl_month = $this->input->post("sl_month");
	// 	// $this->ms->update_sum_list();
	// 	// $this->mc->update_delete();
	// 	$data =  true;
	// 	echo json_encode($data);
	// }

	public function list_edit()
	{
		$this->load->model('M_income', 'mc');
		$this->mc->list_id = $this->input->post("list_id");
		$rs_list = $this->mc->get_by_key()->result();
		// load department model
		echo json_encode($rs_list);
	}

	public function list_update()
	{
		$this->load->model('M_income', 'mc');
		$this->load->model('M_summary', 'ms');
		$list_id = $this->input->post("list_id_edit");
		$this->mc->list_id = $list_id;
		$list_data = $this->mc->get_by_key()->result();
		$cost = $this->input->post("const_list_edit");
		$this->mc->list_cost = $cost;
		$this->mc->list_category_id = $this->input->post("list_category_edit");
		$this->mc->list_detail = $this->input->post("list_detail");
		$this->mc->list_create_date = $this->input->post("list_create_date");
		$list_type = $this->input->post("list_type");
		$this->mc->list_type = $list_type;


		$date = $this->input->post("date");
		$mount = $this->input->post("mount");

		$this->ms->sl_user_id = $this->session->user_id;
		$this->ms->sl_month = 3;
		$this->ms->sl_year = 2021;

		$sum_income = $this->ms->get_summary()->result();
		$cost_income = intval($sum_income[0]->sl_income);
		$cost_expend = intval($sum_income[0]->sl_expend);
		$cost_balance = intval($sum_income[0]->sl_balance);

		$list_type_edit = $list_data[0]->list_type;

		if ($list_type == 2 && $list_type_edit == 1) {
			$cost_edit = $list_data[0]->list_cost;
			$cost_income = $cost_income - $cost_edit;
			$cost_expend = $cost_expend + $cost;
			$cost_balance = $cost_income - $cost_expend;
		}

		if ($list_type == 1 && $list_type_edit == 2) {
			$cost_edit = $list_data[0]->list_cost;
			$cost_expend = $cost_expend - $cost_edit;
			$cost_income = $cost_income + $cost;
			$cost_balance = $cost_income - $cost_expend;
		}


		if ($list_type == 1 && $list_type_edit == 1) {
			$cost_edit = $list_data[0]->list_cost;
			if ($cost_edit > $cost) {
				$cost_edit_income = $cost_edit - $cost;
				$cost_income = $cost_income - $cost_edit_income;
				$cost_balance = $cost_balance - $cost_edit_income;
			}

			if ($cost_edit < $cost) {
				$cost_outcome = $cost - $cost_edit;
				$cost_income = $cost_income + $cost_outcome;
				$cost_balance = $cost_balance + $cost_outcome;
			}
		} else if ($list_type == 2 && $list_type_edit == 2) {
			$cost_edit = $list_data[0]->list_cost;
			if ($cost_edit > $cost) {
				$cost_edit_income = $cost_edit - $cost;
				$cost_expend = $cost_expend - $cost_edit_income;
				$cost_balance = $cost_balance + $cost_edit_income;
			}
			if ($cost_edit < $cost) {
				$cost_outcome = $cost - $cost_edit;
				$cost_expend = $cost_expend + $cost_outcome;
				$cost_balance = $cost_balance - $cost_outcome;
			}
		}
		// var_dump($cost_income);
		// die;
		$this->ms->sl_income = $cost_income;
		$this->ms->sl_expend = $cost_expend;
		$this->ms->sl_balance = $cost_balance;

		$this->ms->update_sum_list();
		$this->mc->update();
		$check = true;
		echo json_encode($check);
	}
	/*
	* report_search
	* Search data from v_report and query search's data 
	* @input channel_id, category_id, case_status_id, create_date, modify_date, modify_user_id
	* @output code, subject, name, user_name, is_active, btn-edit, btn-delete, btn-info
	* @author Chutipong
	* @Create Date 2563-02-25	
	*/
	/*
	* report_search
	* Search data from v_report and query search's data 
	* @input channel_id, category_id, case_status_id, case_position_id,create_date, modify_date, modify_user_id
	* @output code, subject, name, user_name, is_active, btn-edit, btn-delete, btn-info
	* @author Alongkon
	* @Update Date 2563-10-01	
	*/
	function income_search()
	{
		// load M_case and define mcs
		$this->load->model('M_income', 'mis');
		// set start_limit is with page_number
		$this->mis->start_limit = ($this->input->post('page_number') - 1) * 10;
		// set user_name at M_user by session user_id	

		$this->mis->list_user_id = $this->session->user_id;
		//echo $this->mis->list_user_id;
		$this->mis->start_limit = ($this->input->post('page_number') - 1) * 10;
		// $type_sorting_date = $this->input->post("type_sorting_date");
		$rs_case = $this->mis->search_case()->result();
		//$rs_create_fullname = $this->mcs->search_create_use($keyword, $create_date, $modify_date, $type_sorting_date, $position_id, $department_id)->result();
		// set case_count is count of all case's search data
		$data['case_count'] = $this->mis->count_search_case()->result();
		// set array_case is array 
		//print_r($rs_case);
		$array_case = array();
		// start loop set array_case from query of M_case
		$i = 0; //กำหนดค่าเริ่มต้นลูปของการใส่ชื่อผู้สร้าง
		foreach ($rs_case as $row) {
			// start if condition change value of case_status
			if ($row->list_type == 1) {
				$income_status = "รายรับ";
			} else if ($row->list_type == 2) {
				$income_status = "รายจ่าย";
			}
			// end if condition change value of case_status

			// set temp_date is date type by case_create_date of query M_case
			$temp_date = date("Y-m-d", strtotime($row->list_create_date));
			// set create_date_array and change date's form  
			//$create_date_array = abbreDate2($temp_date);

			// start set array_case with html and css for view
			array_push(
				$array_case,
				array(
					'name' => '<p title="' . $row->category_name . '">' . $row->list_detail . '</p>',
					'create_date' => $temp_date,
					'status' => $income_status,
					'cost' => '<p>' . $row->list_cost . '</p>',
					'btn_edit' => '<a data-toggle="modal" data-target="#modal_edit"  onclick="master_data_edit(' . $row->list_id . ')" type="button" class="btn btn-warning btn-circle" title="แก้ไข"><i class="fa fa-pencil "></i></a >',
					'btn_delete' => '<a id="btn-delete" onclick="delete_list( ' . $row->list_id . ',' . $row->list_cost . ',' . $row->list_type . ')"  type="button" class="btn btn-danger btn-circle" title="ลบ"><i class="fa fa-minus-circle "></i></a >'
				)
			);
			// end set array_case with html and css for view
			$i++; //เพิ่มค่าของตัวแปรiเพื่อวนลูป
		};
		// end loop set array_case from query of M_case

		// // Json's data sent back to Ajax form
		$data['rs_income'] = $array_case;

		$this->load->model('M_summary', 'msl');
		$this->msl->sl_user_id = $this->session->user_id;
		$this->msl->sl_month = 3;
		$this->msl->sl_year = 2021;
		$data['sum_income'] = $this->msl->get_summary()->result();
		// echo json back to ajax form
		echo json_encode($data);
	}

	function get_category()
	{
		$this->load->model('M_income', 'mis');
		// $status = $this->input->post('case_status');
		$data['rs_category'] = $this->mis->get_category_dropdown()->result();
		echo json_encode($data);
	}

	function load_v_summary_income()
	{
		$this->load->model('M_summary', 'msl');
		$this->msl->sl_user_id = $this->session->user_id;
		$data["years"] = $this->msl->get_year()->result();
		$this->output('v_summary_income', $data);
	}

	function get_summary_list()
	{
		$year = $this->input->post("year");
		$this->load->model('M_summary', 'msl');
		$this->msl->sl_user_id = $this->session->user_id;
		$this->msl->sl_year = $year;
		$data["summary_list"] = ($this->msl->get_search_summary()->result() != null) ? $this->msl->get_search_summary()->result() : null;
		echo json_encode($data);
	}

	function get_detail_list(){
		$year = $this->input->post("year");
		$month = $this->input->post("month");
		$this->load->model('M_summary', 'msl');
		$this->msl->list_user_id = $this->session->user_id;
		$this->msl->list_create_date_year = $year;
		$this->msl->list_create_date_month = $month;
		$data["list"] = ($this->msl->get_list_detail()->result() != null) ? $this->msl->get_list_detail()->result() : null;
		echo json_encode($data);
	}
}
