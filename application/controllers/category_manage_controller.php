<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class category_manage_controller extends IMS_controller
{
	function index()
	{
		$this->load_v_category_manage();
	}


	function load_v_category_manage()
	{
		$this->output('v_category_manage');
	}

	
	function show_category_data()
	{
		$this->load->model('M_category', 'mcg');
		$this->mcg->get_all_category();
		$data['rs_all'] = $this->mcg->get_all_category()->result();
		echo json_encode($data);
	}

}