<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_user.php");

class M_user extends Da_user
{
    function get_by_username(){
        $sql = "SELECT *
				FROM `user`
                WHERE user_username=? AND user_password=?" ;
        return $this->db->query($sql, array($this->user_username, $this->user_password));
    }
}
