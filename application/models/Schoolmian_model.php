<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Schoolmain_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

    // The function below insert into school table //
    function createSchoolFunction(){

        $page_data = array(
            //'school_id' => $this->session->userdata('school_id'),
            'school_id'            => html_escape($this->input->post('school_id')),
            'school_name'          => html_escape($this->input->post('school_name')),            
            'school_admin_email'   => html_escape($this->input->post('school_admin_email')),
            'password'             => html_escape($this->input->post('location')),
            'location'             => html_escape($this->input->post('location')),
            'phone'                => html_escape($this->input->post('phone')),
            'currency'             => html_escape($this->input->post('currency')),
            'system_email'         => html_escape($this->input->post('system_email')),
            'language'             => html_escape($this->input->post('language')),
            'text_align'           => html_escape($this->input->post('text_align')),
            'skin_colour'          => html_escape($this->input->post('skin_colour')),
            'session'              => html_escape($this->input->post('session')),
            'footer'               => html_escape($this->input->post('footer')),
            'paypal_email'         => html_escape($this->input->post('paypal_email')),
            'stripe_setting'       => html_escape($this->input->post('stripe_setting')),
            'paypal_setting'       => html_escape($this->input->post('paypal_setting')),
	    );

        $this->db->insert('school', $page_data);
    }

// The function below update school table //
    function updateSchoolFunction($param2){
        $page_data = array(
            'school_id'            => html_escape($this->input->post('school_id')),
            'school_name'          => html_escape($this->input->post('school_name')),            
            'school_admin_email'   => html_escape($this->input->post('school_admin_email')),
            'password'             => html_escape($this->input->post('location')),
            'location'             => html_escape($this->input->post('location')),
            'phone'                => html_escape($this->input->post('phone')),
            'currency'             => html_escape($this->input->post('currency')),
            'system_email'         => html_escape($this->input->post('system_email')),
            'language'             => html_escape($this->input->post('language')),
            'text_align'           => html_escape($this->input->post('text_align')),
            'skin_colour'          => html_escape($this->input->post('skin_colour')),
            'session'              => html_escape($this->input->post('session')),
            'footer'               => html_escape($this->input->post('footer')),
            'paypal_email'         => html_escape($this->input->post('paypal_email')),
            'stripe_setting'       => html_escape($this->input->post('stripe_setting')),
            'paypal_setting'       => html_escape($this->input->post('paypal_setting')),
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

