<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/IMS_controller.php");

class User_controller extends IMS_controller
{
    function login_authentication()
    {
        $user_username = $this->input->post("user_username");
        $user_password = $this->input->post("user_password");

        $this->load->model('M_user', 'mu');

        $this->mu->user_username = $user_username;
        $this->mu->user_password = $user_password;

        $user_info = $this->mu->get_by_username()->result();
        // $user_position = $this->mu->get_position_by_username()->result();

        if ($user_info != null) {
            $this->session->aurthentication = true;
            // case_code is user_id
            $this->session->user_id = $user_info[0]->user_id;
            // case_fname is user_fname
            $this->session->user_fname = $user_info[0]->user_fname;
            // case_lname is user_lname
            $this->session->user_lname = $user_info[0]->user_lname;
            // case_job is user_position
            $this->session->user_position = $user_info[0]->user_position;
            $data['user'] = $user_info;
            $data['check'] = true;
        } else {
            $data['check'] = false;
        }

        echo json_encode($data);
    }
}
