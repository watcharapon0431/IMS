<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_income.php");

class M_income extends Da_income
{
	function delete_list()
	{
		$sql = "DELETE FROM list
    	WHERE list_id = ?";
		// echo $sql;
		$this->db->query($sql, array($this->list_id));
	}

	function search_case(){
		$sql = " SELECT *
		FROM list
		LEFT JOIN category
		ON category.category_id = list.list_category_id
	    WHERE list.list_user_id = ? 
		ORDER BY list.list_create_date DESC
		LIMIT ? , 10";
		$query = $this->db->query($sql, array($this->list_user_id,$this->start_limit));
		return $query;
	}

	function count_search_case(){
		$sql = " SELECT COUNT(list.list_id) AS count_case
		FROM list
		LEFT JOIN category
		ON category.category_id = list.list_category_id
	    WHERE list.list_user_id = ? 
		ORDER BY list.list_create_date 
		LIMIT ? , 10";
		$query = $this->db->query($sql, array($this->list_user_id,$this->start_limit));
		return $query;
	}

	function get_category_dropdown()
	{
		$sql = "SELECT category_id, category_name, category_type
    			FROM category
    			WHERE category_status=1";
		$query = $this->db->query($sql);
		return $query;
	}
	
	
}