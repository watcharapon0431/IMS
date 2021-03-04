<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class Income_manage_controller extends IMS_controller
{
	function index()
	{
		$this->load_v_income_manage();
	}


	function load_v_income_manage()
	{

		$this->output('v_income_manage');
	}

	function insert_data()
	{
		$this->load->model('M_income', 'mc');
		$this->mc->list_user_id = $this->session->case_code;
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
		// $this->mc->update_delete();
		$data =  true;
		echo json_encode($data);
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
		// set user_name at M_user by session case_code	
		
		$this->mis->list_user_id = $this->session->case_code;
		//echo $this->mis->list_user_id;
		$this->mis->start_limit = ($this->input->post('page_number') - 1) * 10;
		// $type_sorting_date = $this->input->post("type_sorting_date");

		// // if condition when create_date is not null
		// if ($create_date != "") {
		// 	// set temp_date is date type by input post date_begin
		// 	$temp_date = date("Y-m-d", strtotime($this->input->post('date_begin')));
		// 	// set create_date and change date's form 
		// 	$create_date = splitDateForm6($temp_date);
		// }

		
		// // if condition when create_date is not null
		// if ($modify_date != "") {
		// 	// set temp_date is date type by input post date_end
		// 	$temp_date = date("Y-m-d", strtotime($this->input->post('date_end')));
		// 	// set modify_date and change date's form 
		// 	$modify_date = splitDateForm6($temp_date);
		// }

		// if condition when case_position_id is not null

	

		// if ($case_position_id == "") {
		// 	$begin_position = 0; //เจ้าหน้าที่ contact center
		// 	$end_position = 3; //เจ้าหน้าที่ภาคสนาม
		// } else {
		// 	$begin_position = $case_position_id;
		// 	$end_position = $case_position_id;
		// }


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
			$create_date_array = abbreDate2($temp_date);

			// start set array_case with html and css for view
			array_push(
				$array_case,
				array(	
					'name' => '<p title="' . $row->category_name . '">' . $row->list_detail . '</p>',
					'create_date' => $create_date_array,
					'status' => $income_status,
					'cost' => '<p>' . $row->list_cost . '</p>',
					'btn_edit' => '<a href="' . site_url() . '/Case_report_controller_ajax/load_v_edit_report/' . '" type="button" class="btn btn-warning btn-circle" title="แก้ไข"><i class="fa fa-pencil "></i></a >',
					'btn_delete' => '<a id="btn-delete" onclick="delete_list( '. $row->list_id .')"  type="button" class="btn btn-danger btn-circle" title="ลบ"><i class="fa fa-minus-circle "></i></a >',
					'btn_detail' => '<a href="' . site_url() . '/Case_report_controller_ajax/report_get_detail/' . '" type="button" class="btn btn-info btn-circle" title="รายละเอียด"><i class="fa fa-info "></i></a >',
				)
			);
			// end set array_case with html and css for view
			$i++; //เพิ่มค่าของตัวแปรiเพื่อวนลูป
		};
		// end loop set array_case from query of M_case

		// load model M_user
		// $this->load->model('Master_data/M_user', 'mus');
		// $this->mus->user_name = $this->session->case_code;
		// $data['rs_department'] = ($this->mus->get_position_by_username()->result())[0]->department_id;

		// // Json's data sent back to Ajax form
		$data['rs_income'] = $array_case;
		// // set start_limit is 0 for query all count when search
		// $this->mcs->start_limit = 0;
		// echo json back to ajax form
		echo json_encode($data);
	}


}
