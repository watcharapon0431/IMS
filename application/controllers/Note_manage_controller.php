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
		echo json_encode($data);
	}

}