<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class   Group_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into class table //
    function createGroupFunction(){

        $page_data = array(
            'clinic_id' => $this->session->userdata('clinic_id'),
            'name' => $this->input->post('name'),
            // 'name_numeric' => $this->input->post('name_numeric'),
            'doctor_id' => $this->input->post('doctor_id')
			);

        $this->db->insert('group', $page_data);
    }

// The function below update class table //
    function updateGroupFunction($param2){
        $page_data = array(
            'name' => $this->input->post('name'),
            // 'name_numeric' => $this->input->post('name_numeric'),
            'doctor_id' => $this->input->post('doctor_id')
			);

        $this->db->where('group_id', $param2);
        $this->db->update('group', $page_data);
    }

    // The function below delete from group table //
    function deleteGroupFunction($param2){
        $this->db->where('group_id', $param2);
        $this->db->delete('group');
    }
	


	
	
}

