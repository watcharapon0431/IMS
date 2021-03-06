<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IMS_controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('date_helper');
		$this->load->helper('guid_helper');
		$this->load->helper('file_mime_type_helper');
		$this->load->helper("file");
		$this->load->helper('download');
		$this->load->helper('url');
	}

	function output($body = '', $data = '')
	{
		if ($this->session->aurthentication) {

			// declare data_alert
			$this->load->model("M_note", "mn");
			$this->mn->note_user_id = $this->session->user_id;
			$this->mn->note_create_date = date("Y-m-d");
			$this->mn->note_read_date = date("Y-m-d");
			$this->mn->update_repet();
			$data_alert["rs_notification_unreaded"] = $this->mn->get_note_by_date_unreaded()->result();
			$data_alert["rs_notification_readed"] = $this->mn->get_note_by_date_readed()->result();

			// Load header
			$this->load->view('Template_Custom/v_header');
			// Load Topbar
			$this->load->view('Template_Custom/v_topbar_home', $data_alert);
			// Load Footer
			$this->load->view('Template_Custom/v_footer');

			$this->load->view($body, $data);
		} else {
			redirect(site_url() . "/IMS_controller", "refresh");
		}
	}

	function index()
	{

		$this->load_v_login();
	}

	function load_v_login()
	{
		$this->session->aurthentication = false;
		$this->load->view('Template_Custom/v_header');
		$this->load->view('Template_Custom/v_footer');
		$this->load->view('v_login');
	}
}
