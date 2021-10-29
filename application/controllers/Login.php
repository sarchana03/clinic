<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
      parent::__construct();

		$this->load->database();
		$this->load->library('session');
    }

    //***************** The function below redirects to logged in user area
    public function index() {
      
        if ($this->session->userdata('superadmin_login') == 1) redirect (base_url(). 'superadmin/school_setting');
        if ($this->session->userdata('admin_login', 'clinic_id')== 1) redirect (base_url(). 'admin/dashboard');
        // if ($this->session->userdata('hrm_login')== 1) redirect (base_url(). 'hrm/dashboard'); 
        // if ($this->session->userdata('hostel_login')== 1) redirect (base_url(). 'hostel/dashboard');
        // if ($this->session->userdata('accountant_login')== 1) redirect (base_url(). 'accountant/dashboard');
        // if ($this->session->userdata('librarian_login')== 1) redirect (base_url(). 'librarian/dashboard'); 
        // if ($this->session->userdata('teacher_login')== 1) redirect (base_url(). 'teacher/dashboard');   
        if ($this->session->userdata('parent_login')== 1) redirect (base_url(). 'parent/dashboard'); 
        // if ($this->session->userdata('student_login')== 1) redirect (base_url(). 'student/dashboard'); 
        if ($this->session->userdata('doctor_login')== 1) redirect (base_url(). 'doctor/dashboard'); 
        if ($this->session->userdata('patient_login')== 1) redirect (base_url(). 'patient/dashboard'); 
        $this->load->view('backend/login');
    }
  //***************** / The function below redirects to logged in user area

  //********************************** the function below validating user login request 
    function validate_login() {
      
        $login_check_model = $this->login_model->loginFunctionForAllUsers();
        $login_user = $this->session->userdata('login_type');
        if(!$login_check_model){
          // Here, if the above conditions are not meant, the user will be redirected to login page again.
          $this->session->set_flashdata('error_message', get_phrase('Wrong email or password'));
          redirect(base_url() . 'login', 'refresh');
        }

        if($login_user == 'superadmin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'superadmin/school_setting', 'refresh');
         
        }

        if($login_user == 'admin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'admin/dashboard', 'refresh');
        }


        // if($login_user == 'hrm') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'hrm/dashboard', 'refresh');
        // }

        // if($login_user == 'hostel') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'hostel/dashboard', 'refresh');
        // }

        // if($login_user == 'accountant') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'accountant/dashboard', 'refresh');
        // }
        // if($login_user == 'librarian') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'librarian/dashboard', 'refresh');
        // }
        if($login_user == 'parent') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'parents/dashboard', 'refresh');
        }

        // if($login_user == 'student') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'student/dashboard', 'refresh');
        // }
        // if($login_user == 'teacher') {
        //   $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        //   redirect(base_url() . 'teacher/dashboard', 'refresh');
        // }
        if($login_user == 'doctor') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'doctor/dashboard', 'refresh');
        }

        if($login_user == 'patient') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'patient/dashboard', 'refresh');
        }
     }


    function logout(){
      $login_user = $this->session->userdata('login_type');

      if($login_user == 'superadmin'){
          $this->login_model->logout_model_for_super_admin();
      }

      if($login_user == 'admin'){
          $this->login_model->logout_model_for_admin();
      }
      // if($login_user == 'hrm'){
      //   $this->login_model->logout_model_for_hrm();
      // }
      // if($login_user == 'hostel'){
      //   $this->login_model->logout_model_for_hostel();
      // }
      // if($login_user == 'accountant'){
      //   $this->login_model->logout_model_for_accountant();
      // }
      // if($login_user == 'librarian'){
      //   $this->login_model->logout_model_for_librarian();
      // }
      if($login_user == 'parent'){
        $this->login_model->logout_model_for_parent();
      }
      // if($login_user == 'student'){
      //   $this->login_model->logout_model_for_student();
      // }
      // if($login_user == 'teacher'){
      //   $this->login_model->logout_model_for_teacher();
      // }
      if($login_user == 'doctor'){
        $this->login_model->logout_model_for_doctor();
      }

      if($login_user == 'patient'){
        $this->login_model->logout_model_for_patient();
      }

      $this->session->sess_destroy();
      redirect('login', 'refresh');

     }


    
}
