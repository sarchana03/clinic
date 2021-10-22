<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Superadmin_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    function insert_school(){

        $page_data = array(
            'school_id'             => $this->input->post('school_id'),
            'school_name'           => $this->input->post('school_name'),
            'school_admin_email'    => $this->input->post('school_admin_email'),
			'password'              => sha1($this->input->post('password')),
			'location'              => $this->input->post('location'),
        	'phone'                 => $this->input->post('phone'),
        	'school_email'          => $this->input->post('school_email'),
            'language'              => $this->input->post('language'),
            'text_align'            => $this->input->post('text_align'),
            'skin_colour'           => $this->input->post('skin_colour'),
            'session'               => $this->input->post('session'),
            'footer'                => $this->input->post('footer'),
           
			);
        $this->db->insert('school', $page_data);
    }


    function update_school($param2){
        $page_data = array(
            'school_name'           => $this->input->post('school_name'),
            'school_admin_email'    => $this->input->post('school_admin_email'),
			'password'              => sha1($this->input->post('password')),
			'location'              => $this->input->post('location'),
        	'phone'                 => $this->input->post('phone'),
        	'school_email'          => $this->input->post('school_email'),
            'language'              => $this->input->post('language'),
            'text_align'            => $this->input->post('text_align'),
            'skin_colour'           => $this->input->post('skin_colour'),
            'session'               => $this->input->post('session'),
            'footer'                => $this->input->post('footer'),
            'paypal_email'          => $this->input->post('paypal_email'),
            'stripe_setting'        => $this->input->post('stripe_setting'),
            'paypal_setting'        => $this->input->post('paypal_setting'),
			);

        $this->db->where('school_id', $param2);
        $this->db->update('school', $page_data);
    }

    function delete_school($param2){
        $this->db->where('school_id', $param2);
        $this->db->delete('school');
    }


	
}

