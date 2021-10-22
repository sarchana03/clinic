<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class School extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('super_admin_model');                    // Load vacancy Model Here
    }


    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('super_admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'schools_setting';
        $page_data['page_title'] = get_phrase('schools_setting');
        $this->load->view('school/schools_setting', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */



    function school ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->crud_model->createSchoolFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'school/schools_setting', 'refresh');
        }

        if($param1 == 'update'){
            $this->crud_model->updateSchoolFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'school/schools_setting', 'refresh');
        }


        if($param1 == 'delete'){
            $this->crud_model->deleteSchoolFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'school/schools_setting', 'refresh');
    
            }

        $page_data['page_name']     = 'school';
        $page_data['page_title']    = get_phrase('Schools Setting');

        $school_id = $this->session->userdata('school_id');
        $page_data['select_school']   = $this->db->get_where('school', array('school_id'=>$school_id))->result_array();

        //$page_data['select_club']  = $this->db->get('club')->result_array();
        $this->load->view('school/schools_setting', $page_data);

    }



}
