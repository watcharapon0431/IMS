<?php

class Da_category extends CI_Model
{

	public $category_id;
	public $category_name;
	public $category_status;
	public $category_sequence;
	public $category_create_date;
	public $category_modify_date;

	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		$sql = "INSERT INTO category (category_create_date,category_name, category_type,category_sequence,category_status)
		  VALUES (NOW(),?, ?,?,?)";
		$this->db->query($sql, array($this->category_name, $this->category_type, $this->category_sequence, $this->category_status));
	}

	function update()
	{
		$sql = "UPDATE `category`
				SET	category_name=?, category_type=?, category_status=?, category_sequence =?, category_create_date =?, category_modify_date =?
				WHERE `category_id`=?";
		$this->db->query($sql, array($this->category_name, $this->category_type, $this->category_status, $this->category_sequence, $this->category_create_date, $this->category_modify_date, $this->category_id));
	}

	function delete()
	{
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM `category`
				WHERE `category_id`=?";
		$this->db->query($sql, array($this->category_id));
	}
	function get_by_key()
	{
		$sql = "SELECT *
    			FROM `category`
   				WHERE `category_id`=?";
		return $this->db->query($sql, array($this->category_id));
	}
}
