<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Superadmin extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('superadmin_model');
          

    }


       /* function dashboard() {
        if ($this->session->userdata('super_admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('Super_admin_dashboard');
        $this->load->view('backend/index', $page_data);
    } */


    // function superadmin_setting($data,$data2,$data3)
    // function system_setting()
    // {
    //      //exit($data.$data2.$data3);
    //     $page_data['page_name'] = 'superadmin_setting';
    //     $page_data['page_title'] = get_phrase('Super Admin Dashboard');
        //$this->load->view('backend/superadmin/superadmin_setting', $page_data);
    
	/******************* / super admin page if successfull login** */
/*
    function school_setting($param1 = '', $param2 = '', $param3 = '') 
	{
    if ($this->session->userdata('superadmin_login', ) != 1)
        redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'do_update') {
           
        $this->crud_model->update_settings();
        $this->session->set_flashdata('flash_message', get_phrase('Data Updated'));
        redirect(base_url(). 'superadmin/school_setting', 'refresh');
    }
 
    if ($param1 == 'upload_logo') 
	{
       $this->crud_model->system_logo();
       $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
       redirect(base_url() . 'superadmin/school_setting', 'refresh');
    }


    if ($param1 == 'themeSettings') 
	{
        $this->crud_model->update_theme();
        $this->session->set_flashdata('flash_message', get_phrase('Theme Selected'));
        redirect(base_url() . 'superadmin/school_setting', 'refresh');
    }


     $page_data['page_name'] = 'school_setting';
    
     $page_data['page_title'] = get_phrase('superadmin_school_setting');

     $page_data['school_setting'] = $this->db->get_where('school')->result_array();
    //$this->load->view('backend/index', $page_data);
    $this->load->view('backend/index-superadmin', $page_data);

     } */


    function school_setting($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_school();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'superadmin/school_setting', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_school($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'superadmin/school_setting', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_school($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'superadmin/school_setting', 'refresh');

        }

        $page_data['page_name']         = 'school_setting';
        $page_data['page_title']        = get_phrase('Manage School');

        $school_id = $this->session->userdata('school_id');
        $page_data['select_school']   = $this->db->get_where('school')->result_array();
        
        $this->load->view('backend/index-superadmin', $page_data);
    }

  






}