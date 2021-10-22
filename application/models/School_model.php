<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class School_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into school table //
    function createSchoolFunction(){

        $page_data = array(
            'location'       => html_escape($this->input->post('location')),
            'school_id'      => html_escape($this->input->post('school_id')),
            'school_name'    => html_escape($this->input->post('school_name')),
            'school_id' => $this->session->userdata('school_id'),
	    );

        $this->db->insert('school', $page_data);
    }

// The function below update school table //
    function updateSchoolFunction($param2){
        $page_data = array(
            'location'          => html_escape($this->input->post('location')),
            'school_id'      => html_escape($this->input->post('school_id')),
            'school_name'    => html_escape($this->input->post('school_name'))
	    );

        $this->db->where('school_id', $param2);
        $this->db->update('school', $page_data);
    }

    // The function below delete from school table //
    function deleteSchoolFunction($param2){
        $this->db->where('school_id', $param2);
        $this->db->delete('school');
    }

	
	
}

