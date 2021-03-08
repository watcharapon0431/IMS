<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_category.php");

class M_category extends Da_category
{
    function get_all_category()
	{
		$sql = " SELECT category_name,category_sequence,SUBSTRING(category_create_date, 1, 10) AS date_create, SUBSTRING(category_modify_date, 1, 10) AS date_modify
        FROM   category";
		$query = $this->db->query($sql);
		return $query;
	}
}