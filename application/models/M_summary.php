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

	function update_sum_list(){
	$sql = "UPDATE summary_list
	SET  sl_income =? , sl_expend =? , sl_balance =?
	WHERE sl_month =? AND sl_year =?";
	$query = $this->db->query($sql, array($this->sl_income,$this->sl_expend,$this->sl_balance,$this->sl_month,$this->sl_year));
	return $query;

	}
	
	function get_year(){
		$sql = " SELECT DISTINCT sl_year
		FROM `summary_list`
		WHERE sl_user_id = ?
		ORDER BY sl_year DESC";
		$query = $this->db->query($sql,array($this->sl_user_id));
		return $query;
	}

	function get_search_summary(){
		$sql = "SELECT *
		FROM summary_list
		WHERE sl_user_id = ? AND sl_year = ? 
		ORDER BY sl_month";
		$query = $this->db->query($sql,array($this->sl_user_id,$this->sl_year));
		return $query;
	}

	function get_list_detail(){
		$sql = " SELECT SUM(list_cost) as list_cost, category_name, category_type
		FROM `list`
		LEFT JOIN category ON list.list_category_id = category.category_id
		WHERE MONTH(list_create_date) = ? AND YEAR(list_create_date) = ? AND list_user_id = ?
		GROUP BY list_category_id 
		ORDER BY category_type";
		$query = $this->db->query($sql,array($this->list_create_date_month,$this->list_create_date_year,$this->list_user_id));
		return $query;
	}
	
}