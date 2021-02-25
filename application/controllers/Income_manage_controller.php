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

	function insert_data(){
		$this->load->model('M_income', 'mc');
	    $this->mc->list_type = $this->input->post("list_type");
		$this->mc->list_detail = $this->input->post("list_detail");
		$this->mc->list_category_id = $this->input->post("list_category_id");
		$this->mc->list_create_date = $this->input->post("list_create_date");
		$this->mc->list_cost = $this->input->post("list_cost");
		$this->mc->insert();
	}
		// 

}
