<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sub_group_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into section table //
    function createSub_groupFunction(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            // 'nick_name'     => html_escape($this->input->post('nick_name')),
            // 'class_id'      => html_escape($this->input->post('class_id')),
            'group_id'      => html_escape($this->input->post('group_id')),
            'doctor_id'    => html_escape($this->input->post('doctor_id')),
            'clinic_id' => $this->session->userdata('clinic_id'),
	    );

        $this->db->insert('sub_group', $page_data);
    }

// The function below update sub_group table //
    function updateSub_groupFunction($param2){
        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            // 'nick_name'     => html_escape($this->input->post('nick_name')),
            'group_id'      => html_escape($this->input->post('group_id')),
            'doctor_id'    => html_escape($this->input->post('doctor_id'))
	    );

        $this->db->where('sub_group_id', $param2);
        $this->db->update('sub_group', $page_data);
    }

    // The function below delete from sub_group table //
    function deleteSub_groupFunction($param2){
        $this->db->where('sub_group_id', $param2);
        $this->db->delete('sub_group');
    }
	
	
}

