<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class Note_manage_controller extends IMS_controller
{
	function index()
	{
		$this->load_v_note_manage();
	}


	function load_v_note_manage()
	{
		$this->output('v_note_manage');
	}

	
	function show_note_data()
	{
        $this->load->model('M_note', 'mn');
		$this->mn->get_all_note();
		$data['rs_all'] = $this->mn->get_all_note()->result();
		$this->mn->get_count_data();
		$data['rs_count'] = $this->mn->get_count_data()->result();
		echo json_encode($data);
	}

	function insert_data()
	{
		$this->load->model('M_note', 'mn');
		$this->mn->note_user_id = $this->session->user_id;
		$this->mn->note_to_do_list = $this->input->post("note_to_do_list");
		$this->mn->note_create_date = $this->input->post("note_create_date");
		$this->mn->insert();
	}

}