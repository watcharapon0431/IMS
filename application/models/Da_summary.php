<?php

class Da_summary extends CI_Model
{

	public $sl_id;
	public $sl_income;
	public $sl_expend;
	public $sl_balance;
	public $sl_month;
	public $sl_year;
	public $sl_user_id;

	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		
	}

	function update()
	{
		
	}

	function delete()
	{
		
	}

	function get_by_key()
	{
		$sql = "SELECT *
    FROM sl
    WHERE `sl_id`=?";
		return $this->db->query($sql, array($this->sl_id));
	}
}
