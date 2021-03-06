<?php

class Da_income extends CI_Model
{

	public $list_id;
	public $list_cost;
	public $list_user_id;
	public $list_category_id;
	public $list_detail;
	public $list_create_date;
	public $list_type;
	public $start_limit;

	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		$sql = "INSERT INTO list ( list_user_id,list_cost,list_category_id,list_detail , list_create_date,list_type )
    			VALUES (?,?, ?, ?, ?, ?)";
		$this->db->query($sql, array($this->list_user_id, $this->list_cost, $this->list_category_id, $this->list_detail, $this->list_create_date, $this->list_type));
		$this->last_insert_id = $this->db->insert_id();
		return true;
	}

	function update()
	{
		$sql = "UPDATE list
    			SET list_cost=?, list_category_id=?,list_detail=? , list_create_date=?,list_type=?
    			WHERE `list_id`=?";
		$this->db->query($sql, array( $this->list_cost, $this->list_category_id, $this->list_detail, $this->list_create_date, $this->list_type,$this->list_id));
	}

	function delete()
	{
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM list
    			WHERE `list_id`=?";
		$this->db->query($sql, array($this->list_id));
	}

	function get_by_key()
	{
		$sql = "SELECT *
    			FROM list
   				WHERE `list_id`=?";
		return $this->db->query($sql, array($this->list_id));
	}
}
