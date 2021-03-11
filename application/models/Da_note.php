<?php
class Da_note extends CI_Model
{

	public $note_id;
	public $note_user_id;
	public $note_to_do_list;
	public $note_type;
	public $note_create_date;
	public $note_read_date;

	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		$sql = "INSERT INTO `note` (note_to_do_list, note_type, note_create_date, note_user_id)
				VALUES (?, ?, ?, ?)";
		$this->db->query($sql, array($this->note_to_do_list, $this->note_type, $this->note_create_date, $this->note_user_id));
	}

	function update() {
		$sql = "UPDATE `note`
				SET	note_to_do_list=?,note_type=?,note_create_date=?
				WHERE `note_id`=?";	
		$this->db->query($sql, array($this->note_to_do_list,$this->note_type, $this->note_create_date,$this->note_id));
	}

	function delete()
	{
		$sql = "DELETE FROM `note`
				WHERE note_id=?";
		$this->db->query($sql, array($this->note_id));
	}

	function get_by_key()
	{
		$sql = "SELECT *
    			FROM note
   				WHERE note_id=?";
		return $this->db->query($sql, array($this->note_id));
	}
}