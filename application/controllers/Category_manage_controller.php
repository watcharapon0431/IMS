<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class Category_manage_controller extends IMS_controller
{
	function index()
	{
		$this->load_v_category_manage();
	}


	function load_v_category_manage()
 	{
  		$this->load->model('M_category', 'mcg');
  		$data['count'] = ($this->mcg->get_count_category("")->result())[0]->count_cata + 1;
  		$this->output('v_category_manage', $data);
 	}

	
	function show_category_data()
	{
		$this->load->model('M_category', 'mcg');
		$this->mcg->get_all_category();
		$data['rs_all'] = $this->mcg->get_all_category()->result();
		$data['rs_count'] = $this->mcg->count_category()->result();
		echo json_encode($data);
	}

	public function category_edit()
	{
		$this->load->model('M_category', 'mc');
		$this->mc->category_id = $this->input->post("category_id");
		$rs_category = $this->mc->get_by_key()->result();
		// load department model
		echo json_encode($rs_category);
	}

	public function category_update()
	{
		$this->load->model('M_category', 'mc');
		$category_id = $this->input->post("category_id");
		$this->mc->category_id = $category_id;
		$category_name = $this->input->post("category_name");
		$this->mc->category_name = $category_name;
		$category_type = $this->input->post("category_type");
		$this->mc->category_type = $category_type;
		// var_dump($category_name);
		// die;
		$this->mc->update_edit();
		$check = true;
		echo json_encode($check);
	}
	function category_insert()
	{
	$this->load->model('M_category', 'mcg');
	$this->mcg->category_name = $this->input->post("category_name");
	$this->mcg->category_type = $this->input->post("category_tpye");
	$this->mcg->category_sequence = $this->input->post("category_seq");
	$this->mcg->category_status = 1;
	$this->mcg->insert();
	$data = true;
	echo json_encode($data);
	}
	public function category_delete()
	{
		$this->load->model('M_category', 'mcg');
		$this->mcg->category_id = $this->input->post("category_id");
		$this->mcg->delete_category();
		$data =  true;
		echo json_encode($data);
	}
}
