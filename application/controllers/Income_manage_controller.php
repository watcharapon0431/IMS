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

}
