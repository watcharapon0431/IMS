<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_income.php");

class M_income extends Da_income
{
    function update_delete()
	{
		$sql = " UPDATE list
		SET list_id = list_id-1
	    WHERE list_id > ? ";
		$this->db->query($sql, array($this->list_id));
	}
}