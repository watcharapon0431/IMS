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
	public $list_create_date;
	public $list_create_date_year;
	public $list_create_date_month;
	public $list_user_id;

	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		$sql = "INSERT INTO summary_list (sl_income,sl_expend,sl_balance,sl_user_id,sl_month,sl_year)
		  VALUES (?,?,?,?,?,?)";
		$this->db->query($sql, array($this->sl_income,$this->sl_expend,$this->sl_balance,$this->sl_user_id,$this->sl_month,$this->sl_year));
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
