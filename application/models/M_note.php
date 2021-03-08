<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_note.php");

class M_note extends Da_note
{
    function get_all_note()
	{
		$sql = " SELECT note_to_do_list,DATE_FORMAT(note_create_date,'%d') AS Day,
		case 
			when DATE_FORMAT(note_create_date,'%m') = 01 then 'ม.ค.'
			when DATE_FORMAT(note_create_date,'%m') = 02 then 'ก.พ.'
			when DATE_FORMAT(note_create_date,'%m') = 03 then 'มี.ค.'
			when DATE_FORMAT(note_create_date,'%m') = 04 then 'เม.ย.'
			when DATE_FORMAT(note_create_date,'%m') = 05 then 'พ.ค.'
			when DATE_FORMAT(note_create_date,'%m') = 06 then 'มิ.ย.'
			when DATE_FORMAT(note_create_date,'%m') = 07 then 'ก.ค.'
			when DATE_FORMAT(note_create_date,'%m') = 08 then 'ส.ค.'
			when DATE_FORMAT(note_create_date,'%m') = 09 then 'ก.ย.'
			when DATE_FORMAT(note_create_date,'%m') = 10 then 'ต.ค.' 
			when DATE_FORMAT(note_create_date,'%m') = 11 then 'พ.ย.' 
			else 'ธ.ค.'
		 end as 'Month',DATE_FORMAT(date_add(note_create_date, INTERVAL 543 YEAR),'%Y') AS 'year'
		FROM   note";
		$query = $this->db->query($sql);
		return $query;
	}
}