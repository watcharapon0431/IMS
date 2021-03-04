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


	
}