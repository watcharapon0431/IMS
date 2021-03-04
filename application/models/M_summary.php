<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_summary.php");

class M_summary extends Da_summary
{
	function get_summary()
	{
		$sql = " SELECT *
		FROM summary_list
	
	    WHERE sl_user_id = ? AND sl_month = ? AND sl_year = ? ";
		$query = $this->db->query($sql, array($this->sl_user_id,$this->sl_month,$this->sl_year));
		return $query;
	}

	




	
}