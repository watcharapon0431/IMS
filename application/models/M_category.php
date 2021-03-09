<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_category.php");

class M_category extends Da_category
{
    function get_all_category()
	{
		$sql = " SELECT category_id,category_name,category_sequence,SUBSTRING(category_create_date, 1, 10) AS date_create, SUBSTRING(category_modify_date, 1, 10) AS date_modify
        FROM   category";
		$query = $this->db->query($sql);
		return $query;
	}
	function update_edit() {
		$sql = "UPDATE `category`
				SET	category_modify_date=NOW(),category_name=?, category_type=? 
				WHERE `category_id`=?";	
		$this->db->query($sql, array($this->category_name, $this->category_type, $this->category_id));
	}
	function get_count_category()
	{
	 $sql = " SELECT count(category_id) as count_cata
		   FROM   category";
	 $query = $this->db->query($sql);
	 return $query;
	}

}