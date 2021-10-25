<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Newuser extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                // $this->load->model('student_payment_model');
                // $this->load->model('newuser_model');
               
    }

     /*accountant dashboard code to redirect to accountant page if successfull login** */
     function dashboard() {
        // if ($this->session->userdata('accountant_login') != 1) redirect(base_url(), 'refresh');
       	// $page_data['page_name'] = 'dashboard';
        // $page_data['page_title'] = get_phrase('Accountant Page');
        // $this->load->view('backend/index', $page_data);
        $this->load->view('backend/newuser','refresh');
    }


  



      


  

 



}