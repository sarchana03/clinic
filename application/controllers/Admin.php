<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->table        = 'calendar';

        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('vacancy_model');                    // Load vacancy Model Here
                $this->load->model('application_model');                // Load Apllication Model Here
                $this->load->model('leave_model');                      // Load Apllication Model Here
                $this->load->model('award_model');                      // Load Apllication Model Here
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('student_model');                    // Load Apllication Model Here
                $this->load->model('exam_question_model');              // Load Apllication Model Here
                $this->load->model('student_payment_model');            // Load Apllication Model Here
                $this->load->model('event_model');                      // Load Apllication Model Here
                $this->load->model('language_model');                      // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
                $this->load->model('live_class_model');	
                $this->load->model('doctor_model');	
                $this->load->model('patient_model');	
                $this->load->model('group_model');	
                $this->load->model('sub_group_model');	
                $this->load->model('newuser_model');
                $this->load->model('appointment_list_model');
                
                
                $this->load->model('schedule_list_model');	
             // $this->load->model('superadmin_model');	
             
    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() 
	{
    if ($this->session->userdata('admin_login',) != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login',) == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */


   

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');
        $data['clinic_id'] = $this->session->user_data('clinic_id');

        $this->db->where('clinic_id', $this->session->userdata('clinic_id'));
        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
     

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function enquiry_category($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'insert'){
   
        $this->crud_model->enquiry_category();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

       $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');

        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['enquiry_category']   = $this->db->get_where('enquiry_category', array('clinic_id'=>$clinic_id))->result_array();

        //$page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function list_enquiry ($param1 = null, $param2 = null, $param3 = null){


        if($param1 == 'delete')
        {
            $this->crud_model->delete_enquiry($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
    
        }

        $page_data['page_name']     = 'list_enquiry';
        $page_data['page_title']    = get_phrase('All Enquiries');

        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_enquiry']   = $this->db->get_where('enquiry', array('clinic_id'=>$clinic_id))->result_array();

        //$page_data['select_enquiry']  = $this->db->get('enquiry')->result_array();
        $this->load->view('backend/index', $page_data);

    }



    // function club ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'insert'){
    //         $this->crud_model->insert_club();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/club', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->crud_model->update_club($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/club', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_club($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/club', 'refresh');
    
    //         }


    //     $page_data['page_name']     = 'club';
    //     $page_data['page_title']    = get_phrase('Manage Club');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_club']   = $this->db->get_where('club', array('school_id'=>$school_id))->result_array();

    //     //$page_data['select_club']  = $this->db->get('club')->result_array();
    //     $this->load->view('backend/index', $page_data);

    // }


    // function circular($param1 = null, $param2 = null, $param3 = null){

    //     if ($param1 == 'insert'){

    //         $this->crud_model->insert_circular();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/circular', 'refresh');
    //     }


    //     if($param1 == 'update'){

    //         $this->crud_model->update_circular($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/circular', 'refresh');

    //     }


    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_circular($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/circular', 'refresh');


    //     }

    //     $page_data['page_name']         = 'circular';
    //     $page_data['page_title']        = get_phrase('Manage Circular');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_circular']   = $this->db->get_where('circular', array('school_id'=>$school_id))->result_array();

    //     //$page_data['select_circular']   = $this->db->get('circular')->result_array();
    //     $this->load->view('backend/index', $page_data);

    // }


    function parent($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_parent();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/parent', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        $page_data['page_name']         = 'parent';
        $page_data['page_title']        = get_phrase('Manage Parent');

        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_parent']   = $this->db->get_where('parent', array('clinic_id'=>$clinic_id))->result_array();
       
       // $page_data['select_parent']   = $this->db->get_where('parent')->result_array();

        $this->load->view('backend/index', $page_data);
    }


    // function librarian($param1 = null, $param2 = null, $param3 = null){

    //     if ($param1 == 'insert'){

    //         $this->crud_model->insert_librarian();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/librarian', 'refresh');
    //     }


    //     if($param1 == 'update'){

    //         $this->crud_model->update_librarian($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/librarian', 'refresh');

    //     }

    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_librarian($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/librarian', 'refresh');

    //     }

    //     $page_data['page_name']         = 'librarian';
    //     $page_data['page_title']        = get_phrase('Manage Librarian');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_librarian']   = $this->db->get_where('librarian', array('school_id'=>$school_id))->result_array();
        
    //     $this->load->view('backend/index', $page_data);
    // }

  

    // function accountant($param1 = null, $param2 = null, $param3 = null){

    //     if ($param1 == 'insert'){

    //         $this->crud_model->insert_accountant();

    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/accountant', 'refresh');
    //     }


    //     if($param1 == 'update'){

    //         $this->crud_model->update_accountant($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/accountant', 'refresh');

    //     }

    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_accountant($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/accountant', 'refresh');

    //     }

    //     $page_data['page_name']         = 'accountant';
    //     $page_data['page_title']        = get_phrase('Manage Accountant');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_accountant']   = $this->db->get_where('accountant', array('school_id'=>$school_id))->result_array();
        
    //     $this->load->view('backend/index', $page_data);
    // }




    // function hostel($param1 = null, $param2 = null, $param3 = null){

    //     if ($param1 == 'insert'){

    //         $this->crud_model->insert_hostel();

    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/hostel', 'refresh');
    //     }


    //     if($param1 == 'update'){

    //         $this->crud_model->update_hostel($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/hostel', 'refresh');

    //     }

    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_hostel($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/hostel', 'refresh');

    //     }

    //     $page_data['page_name']         = 'hostel';
    //     $page_data['page_title']        = get_phrase('Manage Hostel');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_hostel']   = $this->db->get_where('hostel', array('school_id'=>$school_id))->result_array();
        
    //     $this->load->view('backend/index', $page_data);
    // }





    // function hrm($param1 = null, $param2 = null, $param3 = null){

    //     if ($param1 == 'insert'){

    //         $this->crud_model->insert_hrm();

    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/hrm', 'refresh');
    //     }


    //     if($param1 == 'update'){

    //         $this->crud_model->update_hrm($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/hrm', 'refresh');

    //     }

    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_hrm($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/hrm', 'refresh');

    //     }

    //     $page_data['page_name']         = 'hrm';
    //     $page_data['page_title']        = get_phrase('Manage HRM');

    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_hrm']   = $this->db->get_where('hrm', array('school_id'=>$school_id))->result_array();
        
    //     $this->load->view('backend/index', $page_data);
    // }




    function alumni($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->alumni_model->insert_alumni();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/alumni', 'refresh');
        }


        if($param1 == 'update'){

            $this->alumni_model->update_alumni($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/alumni', 'refresh');

        }

        if($param1 == 'delete'){
        $this->alumni_model->delete_alumni($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'admin/alumni', 'refresh');

        }

        $page_data['page_name']         = 'alumni';
        $page_data['page_title']        = get_phrase('Manage Alumni');

        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_alumni']   = $this->db->get_where('alumni', array('clinic_id'=>$clinic_id))->result_array();
        
        $this->load->view('backend/index', $page_data);
    }

    // function teacher ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'insert'){
    //         $this->teacher_model->insetTeacherFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/teacher', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->teacher_model->updateTeacherFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/teacher', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->teacher_model->deleteTeacherFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/teacher', 'refresh');
    //     }

    //     $page_data['page_name']     = 'teacher';
    //     $page_data['page_title']    = get_phrase('Manage Teacher');
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_teacher']  = $this->db->get_where('teacher',array('school_id'=>$school_id))->result_array();
    //     $this->load->view('backend/index', $page_data);

    // }


    /**   admin to doctor funtion ***/ 


   function doctor ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->doctor_model->insetdoctorFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/doctor', 'refresh');
        }

        if($param1 == 'update'){
            $this->doctor_model->updatedoctorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/doctor', 'refresh');
        }


        if($param1 == 'delete'){
            $this->doctor_model->deletedoctorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/doctor', 'refresh');
        }

        $page_data['page_name']     = 'doctor';
        $page_data['page_title']    = get_phrase('Manage doctor');
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_doctor']  = $this->db->get_where('doctor',array('clinic_id'=>$clinic_id))->result_array();
        $this->load->view('backend/index', $page_data);

    }







    /**  ends admin to doctor funtion ***/ 




    // function get_designation($department_id = null){

    //     $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
    //     foreach($designation as $key => $row)
    //     echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    // }

    /***********  The function manages vacancy   ***********************/
    // function vacancy ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'insert'){
    //         $this->vacancy_model->insetVacancyFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/vacancy', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->vacancy_model->updateVacancyFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/vacancy', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->vacancy_model->deleteVacancyFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/vacancy', 'refresh');
    
    //     }

    //     $page_data['page_name']     = 'vacancy';
    //     $page_data['page_title']    = get_phrase('Manage Vacancy');
        
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['select_vacancy']  = $this->db->get_where('vacancy',array('school_id'=>$school_id))->result_array();

    //     //$page_data['select_vacancy']  = $this->db->get('vacancy')->result_array();
    //     $this->load->view('backend/index', $page_data);

    // }


    /***********  The function manages job applicant   ***********************/
    function application ($param1 = 'applied', $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->application_model->insertApplicantFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
        }

        if($param1 == 'update'){
            $this->application_model->updateApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
        }


        if($param1 == 'delete'){
            $this->application_model->deleteApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
    
        }

        if($param1 != 'applied' && $param1 != 'on_review' && $param1 != 'interviewed' && $param1 != 'offered' && $param1 != 'hired' && $param1 != 'declined')
        $param1 ='applied';

        
        
        $page_data['status']        = $param1;
        $page_data['page_name']     = 'application';

        // $school_id = $this->session->userdata('school_id');
        //$page_data['select_vacancy']  = $this->db->get_where('vacancy',array('school_id'=>$school_id))->result_array();
        $page_data['page_title']    = get_phrase('Job Applicant');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages Leave  ***********************/
    // function leave ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'update'){
    //         $this->leave_model->updateLeaveFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/leave', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->leave_model->deleteLeaveFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/leave', 'refresh');
    
    //     }
        
    //     $page_data['page_name']     = 'leave';
    //     $page_data['page_title']    = get_phrase('Manage Leave');
    //     $school_id = $this->session->userdata('school_id');
    //     $this->load->view('backend/index', $page_data);

    // }


    /***********  The function manages Awards  ***********************/
    // function award ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->award_model->createAwardFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/award', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->award_model->updateAwardFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/award', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->award_model->deleteAwardFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/award', 'refresh');
    
    //     }

    //     $page_data['page_name']     = 'award';
    //     $page_data['page_title']    = get_phrase('Manage Award');
    //     $school_id = $this->session->userdata('school_id');
    //     $this->load->view('backend/index', $page_data);

    // }

    // function payroll(){
        
    //     $page_data['page_name']     = 'payroll_add';
    //     $page_data['page_title']    = get_phrase('Create Payslip');
    //     $this->load->view('backend/index', $page_data);

    // }

    function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }

    // function payroll_selector()
    // {
    //     $department_id  = $this->input->post('department_id');
    //     $employee_id    = $this->input->post('employee_id');
    //     $month          = $this->input->post('month');
    //     $year           = $this->input->post('year');
        
    //     redirect(base_url() . 'admin/payroll_view/' . $department_id. '/' . $employee_id . '/' . $month . '/' . $year, 'refresh');
    // }
    
    // function payroll_view($department_id = null, $employee_id = null, $month = null, $year = null)
    // {
    //     $page_data['department_id'] = $department_id;
    //     $page_data['employee_id']   = $employee_id;
    //     $page_data['month']         = $month;
    //     $page_data['year']          = $year;
    //     $page_data['page_name']     = 'payroll_add_view';
    //     $page_data['page_title']    = get_phrase('Create Payslip');
    //     $this->load->view('backend/index', $page_data);
    // }


    // function create_payroll(){

    //     $this->payroll_model->insertPayrollFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //     redirect(base_url(). 'admin/payroll_list/filter2/'. $this->input->post('month').'/'. $this->input->post('year'), 'refresh');
    // }


    /***********  The function manages Payroll List  ***********************/
    // function payroll_list ($param1 = null, $param2 = null, $param3 = null, $param4 = null){

    //     if($param1 == 'mark_paid'){
            
    //         $data['status'] =  1;
    //         $this->db->update('payroll', $data, array('payroll_id' => $param2));

    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/payroll_list/filter2/'. $param3.'/'. $param4, 'refresh');
    //     }

    //     if($param1 == 'filter'){
    //         $page_data['month'] = $this->input->post('month');
    //         $page_data['year'] = $this->input->post('year');
    //     }
    //     else{
    //         $page_data['month'] = date('n');
    //         $page_data['year'] = date('Y');
    //     }

    //     if($param1 == 'filter2'){
            
    //         $page_data['month'] = $param2;
    //         $page_data['year'] = $param3;
    //     }


    //     $page_data['page_name']     = 'payroll_list';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('List Payroll');
    //     $this->load->view('backend/index', $page_data);

    // }

    /***********  The function manages Class Information  ***********************/
    //   function classes ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->class_model->createClassFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/classes', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->class_model->updateClassFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/classes', 'refresh');
    //     }


    //     if($param1 == 'delete'){
    //         $this->class_model->deleteClassFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/classes', 'refresh');
    
    //     }

    //     $page_data['page_name']     = 'class';
    //     $page_data['page_title']    = get_phrase('Manage Class');
    //     $school_id = $this->session->userdata('school_id');
    //     $this->load->view('backend/index', $page_data);

    // }


    // /***********  The function manages Section  ***********************/
    // function section ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //     $this->section_model->createSectionFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/section', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //     $this->section_model->updateSectionFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/section', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //     $this->section_model->deleteSectionFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/section', 'refresh');
    //     }

    //     $page_data['page_name']     = 'section';
    //     $page_data['page_title']    = get_phrase('Manage Section');
    //     $school_id = $this->session->userdata('school_id');
    //     $this->load->view('backend/index', $page_data);
    // }

    //     function sections ($class_id = null){

    //         if($class_id == '')
    //         $class_id = $this->db->get('class')->first_row()->class_id;
    //         $page_data['page_name']     = 'section';
    //         $page_data['class_id']      = $class_id;
    //         $page_data['page_title']    = get_phrase('Manage Section');
    //         $this->load->view('backend/index', $page_data);

    //     }


    function newusers() {
        $page_data['page_name'] = 'newusers';
        $page_data['page_title'] = get_phrase('newusers');
    $clinic_id = $this->session->userdata('clinic_id');

        $this->load->view('backend/index', $page_data);
    }


/***********  The function manages Class Information  ***********************/
function groups ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->group_model->createGroupFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/groups', 'refresh');
    }

    if($param1 == 'update'){
        $this->group_model->updateGroupFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/groups', 'refresh');
    }


    if($param1 == 'delete'){
        $this->group_model->deleteGroupFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/groups', 'refresh');

    }

    $page_data['page_name']     = 'group';
    $page_data['page_title']    = get_phrase('Manage group');
    $clinic_id = $this->session->userdata('clinic_id');
    $this->load->view('backend/index', $page_data);

}




/***********  The function manages Section  ***********************/
function sub_group ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
    $this->sub_group_model->createSub_groupFunction();
    $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    redirect(base_url(). 'admin/sub_group', 'refresh');
    }

    if($param1 == 'update'){
    $this->sub_group_model->updateSub_groupFunction($param2);
    $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    redirect(base_url(). 'admin/sub_group', 'refresh');
    }

    if($param1 == 'delete'){
    $this->sub_group_model->deleteSub_groupFunction($param2);
    $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    redirect(base_url(). 'admin/sub_group', 'refresh');
    }

    $page_data['page_name']     = 'sub_group';
    $page_data['page_title']    = get_phrase('Manage sub_group');
    $clinic_id = $this->session->userdata('clinic_id');
    $this->load->view('backend/index', $page_data);
}

    function sub_groups ($group_id = null){

        if($group_id == '')
        $group_id = $this->db->get('group')->first_row()->group_id;
        $page_data['page_name']     = 'sub_group';
        $page_data['group_id']      = $group_id;
        $page_data['page_title']    = get_phrase('Manage sub_group');
        $this->load->view('backend/index', $page_data);

    }























    

    /***********  The function manages school timetable  ***********************/
    // function class_routine ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //     $this->class_routine_model->createTimetableFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
    //     }

    //     if($param1 == 'update'){
        
    //     $this->class_routine_model->updateTimetableFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
    //     }

    //     if($param1 == 'delete'){
        
    //     $this->db->where('class_routine_id', $param2);
    //     $this->db->delete('class_routine');
    //     //$this->class_routine_model->deleteTimetableFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
    //     }
    // }

    // function listStudentTimetable(){

    //     $page_data['page_name']     = 'listStudentTimetable';
    //     $page_data['page_title']    = get_phrase('School Timetable');

    //     $this->load->view('backend/index', $page_data);
    // }

    // function class_routine_add(){

    //     $page_data['page_name']     = 'class_routine_add';
    //     $page_data['page_title']    = get_phrase('School Timetable');
    //     $this->load->view('backend/index', $page_data);
    // }

    // function get_class_section_subject($class_id){
    //     $page_data['class_id']  =   $class_id;
    //     $this->load->view('backend/admin/class_routine_section_subject_selector', $page_data);

    // }

    // function studentTimetableLoad($class_id){

    //     $page_data['class_id']  =   $class_id;
    //     $this->load->view('backend/admin/studentTimetableLoad', $page_data);

    // }

    // function class_routine_print_view($class_id, $section_id){

    //     $page_data['class_id']      =   $class_id;
    //     $page_data['section_id']    =   $section_id;
    //     $this->load->view('backend/admin/class_routine_print_view', $page_data);
    // }


    // function section_subject_edit($class_id, $class_routine_id){

    // $page_data['class_id']          =   $class_id;
    // $page_data['class_routine_id']  =   $class_routine_id;
    // $this->load->view('backend/admin/class_routine_section_subject_edit', $page_data);

    // }


    /***********  The function manages school dormitory  ***********************/
    // function dormitory ($param1 = null, $param2 = null, $param3 = null){

    // if($param1 == 'create'){
    //     $this->dormitory_model->createDormitoryFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/dormitory', 'refresh');
    // }

    // if($param1 == 'update'){
    //     $this->dormitory_model->updateDormitoryFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/dormitory', 'refresh');
    // }


    // if($param1 == 'delete'){
    //     $this->dormitory_model->deleteDormitoryFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/dormitory', 'refresh');

    // }

    // $page_data['page_name']     = 'dormitory';
    // $school_id = $this->session->userdata('school_id');
    // $page_data['page_title']    = get_phrase('Manage Dormitory');
    // $this->load->view('backend/index', $page_data);

    // }


    /***********  The function manages hostel room  ***********************/
    // function hostel_room ($param1 = null, $param2 = null, $param3 = null){

    // if($param1 == 'create'){
    //     $this->dormitory_model->createHostelRoomFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //     redirect(base_url(). 'admin/hostel_room', 'refresh');
    // }

    // if($param1 == 'update'){
    //     $this->dormitory_model->updateHostelRoomFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/hostel_room', 'refresh');
    // }


    // if($param1 == 'delete'){
    //     $this->dormitory_model->deleteHostelRoomFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/hostel_room', 'refresh');

    // }

    // $page_data['page_name']     = 'hostel_room';
    //  $school_id = $this->session->userdata('school_id');
    // $page_data['page_title']    = get_phrase('Hostel Room');
    // $this->load->view('backend/index', $page_data);

    // }


    /***********  The function manages hostel category  ***********************/
    // function hostel_category ($param1 = null, $param2 = null, $param3 = null){

    // if($param1 == 'create'){
    //     $this->dormitory_model->createHostelCategoryFunction();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //     redirect(base_url(). 'admin/hostel_category', 'refresh');
    // }

    // if($param1 == 'update'){
    //     $this->dormitory_model->updateHostelCategoryFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/hostel_category', 'refresh');
    // }


    // if($param1 == 'delete'){
    //     $this->dormitory_model->deleteHostelCategoryFunction($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/hostel_category', 'refresh');

    // }

    // $page_data['page_name']     = 'hostel_category';
    //  $school_id = $this->session->userdata('school_id');
    // $page_data['page_title']    = get_phrase('Hostel Category');
    // $this->load->view('backend/index', $page_data);
    // }



    /***********  The function manages academic syllabus ***********************/
    // function academic_syllabus ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //     $this->academic_model->createAcademicSyllabus();
    //     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //     redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    // }

    // if($param1 == 'update'){
    //     $this->academic_model->updateAcademicSyllabus($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //     redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    // }


    // if($param1 == 'delete'){
    //     $this->academic_model->deleteAcademicSyllabus($param2);
    //     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //     redirect(base_url(). 'admin/academic_syllabus', 'refresh');

    //     }

    //     $page_data['page_name']     = 'academic_syllabus';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Academic Syllabus');
    //     $this->load->view('backend/index', $page_data);

    // }

    // function get_class_subject($class_id){
    //     $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    //         foreach($subjects as $key => $subject)
    //         {
    //             echo '<option value="'.$subject['subject_id'].'">'.$subject['name'].'</option>';
    //         }
    // }

    // function get_class_section($class_id){
    //     $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
    //         foreach($sections as $key => $section)
    //         {
    //             echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
    //         }
    // }

    // function get_patient_patientid($patient_id){
    //     $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
    //         foreach($sections as $key => $section)
    //         {
    //             echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
    //         }
    // }


    function get_group_sub_group($group_id){
        $sub_groups = $this->db->get_where('sub_group', array('group_id' => $group_id))->result_array();
            foreach($sub_groups as $key => $sub_group)
            {
                echo '<option value="'.$sub_group['sub_group_id'].'">'.$sub_group['name'].'</option>';
            }
    }


    // function download_academic_syllabus($academic_syllabus_code){
    //     $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
    //     // Loading download from helper.
    //     $this->load->helper('download');
    //     $get_download_content = file_get_contents('uploads/syllabus' . $get_file_name);
    //     $name = $file_name;
    //     force_download($name, $get_download_content);
    // }

    // function get_academic_syllabus ($class_id = null){

    //     if($class_id == '')
    //     $class_id = $this->db->get('class')->first_row()->class_id;
        
    //     $page_data['page_name']     = 'academic_syllabus';
    //     $page_data['class_id']      = $class_id;
        
    //     $page_data['page_title']    = get_phrase('Academic Syllabus');
    //     $this->load->view('backend/index', $page_data);

    // }

    /***********  The function below add, update and delete student from students' table ***********************/
    // function new_student ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->student_model->createNewStudent();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/student_information', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->student_model->updateNewStudent($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/student_information', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->student_model->deleteNewStudent($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/student_information', 'refresh');

    //     }

    //     $page_data['page_name']     = 'new_student';
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['page_title']    = get_phrase('Manage Student');
    //     $this->load->view('backend/index', $page_data);

    // }

    /* patients fuctions*/ 
    function new_patient ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->patient_model->createNewpatient();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/new_patient', 'refresh');
        }

        if($param1 == 'update'){
            $this->patient_model->updateNewpatient($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/patient_information', 'refresh');
        }

        if($param1 == 'delete'){
            $this->patient_model->deleteNewpatient($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/patient_information', 'refresh');

        }

        $page_data['page_name']     = 'new_patient';
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('Manage patient');
        $this->load->view('backend/index', $page_data);

    }

    function newuser ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->newuser_model->createNewuser();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'login', 'refresh');
        }

        if($param1 == 'update'){
            $this->newuser_model->updateNewuser($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'login', 'refresh');
        }

        if($param1 == 'delete'){
            $this->newuser_model->deleteNewuser($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'login', 'refresh');

        }

        $page_data['page_name']     = 'newuser';
        $clinic_id = $this->session->userdata('clinic_id');
        // $page_data['page_title']    = get_phrase('Manage user');
        $this->load->view('backend/login');

    }








    // function student_information(){

    //     $page_data['page_name']     = 'student_information';
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['page_title']    = get_phrase('List Student');
    //     $this->load->view('backend/index', $page_data);
    // }

    
    function patient_information(){

        $page_data['page_name']     = 'patient_information';
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('List patient');
        $this->load->view('backend/index', $page_data);
    }





    /**************************  search student function with ajax starts here   ***********************************/
    // function getStudentClasswise($class_id){

    //     $page_data['class_id'] = $class_id;
    //     $this->load->view('backend/admin/showStudentClasswise', $page_data);
    // }
    /**************************  search student function with ajax ends here   ***********************************/


    // function edit_student($student_id){

    //     $page_data['student_id']      = $student_id;
    //     $page_data['page_name']     = 'edit_student';
    //     $page_data['page_title']    = get_phrase('Edit Student');
    //     $this->load->view('backend/index', $page_data);
    // }


    // function resetStudentPassword ($student_id) {
    //     $password['password']               =   sha1($this->input->post('new_password'));
    //     $confirm_password['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    //     if ($password['password'] == $confirm_password['confirm_new_password']) {
    //        $this->db->where('student_id', $student_id);
    //        $this->db->update('student', $password);
    //        $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
    //     }
    //     else{
    //         $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
    //     }
    //     redirect(base_url() . 'admin/student_information', 'refresh');
    // }

    // function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
    //     $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
    //     if ($_POST) {
	
    //         // Loop all the students of $class_id
    //         $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
    //         foreach ($students as $key => $student) {
    //         $attendance_status = $this->input->post('status_' . $student['student_id']);
    //         $full_date = $year . "-" . $month . "-" . $date;
    //         $this->db->where('student_id', $student['student_id']);
    //         $this->db->where('date', $full_date);
    
    //         $this->db->update('attendance', array('status' => $attendance_status));
    
    //                if ($attendance_status == 2) 
    //         {
    //                  if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
    //                     $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
    //                     $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
    //                     $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
    //                     if($parent_id != null && $parent_id != 0){
    //                         $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
    //                         if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
    //                             $this->sms_model->send_sms($message, $recieverPhoneNumber);
    //                         }
    //                         else{
    //                             $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
    //                         }
    //                     }
    //                     else{
    //                         $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
    //                     }
    //                 }
    //        }
    //     }
    
    //         $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
    //         redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
    //     }

    //     $page_data['date'] = $date;
    //     $page_data['month'] = $month;
    //     $page_data['year'] = $year;
    //     $page_data['class_id'] = $class_id;
    //     $page_data['section_id'] = $section_id;
    //     $page_data['page_name'] = 'manage_attendance';
    //     $page_data['page_title'] = get_phrase('Manage Attendance');
    //     $this->load->view('backend/index', $page_data);

    // }

    // function attendance_selector(){
    //     $date = $this->input->post('timestamp');
    //     $date = date_create($date);
    //     $date = date_format($date, "d/m/Y");
    //     redirect(base_url(). 'admin/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
    // }


    // function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
    //     $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        
    //     if ($_POST) {
    //     redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
    //     }
        
    //     $classes = $this->db->get('class')->result_array();
    //     foreach ($classes as $key => $class) {
    //         if (isset($class_id) && $class_id == $class['class_id'])
    //             $class_name = $class['name'];
    //         }
                    
    //     $sections = $this->db->get('section')->result_array();
    //         foreach ($sections as $key => $section) {
    //             if (isset($section_id) && $section_id == $section['section_id'])
    //                 $section_name = $section['name'];
    //     }
        
    //     $page_data['month'] = $month;
    //     $page_data['year'] = $year;
    //     $page_data['class_id'] = $class_id;
    //     $page_data['section_id'] = $section_id;
    //     $page_data['page_name'] = 'attendance_report';
    //     $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
    //     $this->load->view('backend/index', $page_data);
    // }


    /******************** Load attendance with ajax code starts from here **********************/
	// function loadAttendanceReport($class_id, $section_id, $month, $year)
    // {
    //     $page_data['class_id'] 		= $class_id;					// get all class_id
	// 	$page_data['section_id'] 	= $section_id;					// get all section_id
	// 	$page_data['month'] 		= $month;						// get all month
	// 	$page_data['year'] 			= $year;						// get all class year
		
    //     $this->load->view('backend/admin/loadAttendanceReport' , $page_data);
    // }
    /******************** Load attendance with ajax code ends from here **********************/
    

    /******************** print attendance report **********************/
	// function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
    // {
    //     $page_data['class_id'] 		= $class_id;					// get all class_id
	// 	$page_data['section_id'] 	= $section_id;					// get all section_id
	// 	$page_data['month'] 		= $month;						// get all month
	// 	$page_data['year'] 			= $year;						// get all class year
		
    //     $page_data['page_name'] = 'printAttendanceReport';
    //     $page_data['page_title'] = "Attendance Report";
    //     $this->load->view('backend/index', $page_data);
    // }
    /******************** /Ends here **********************/
    


     /***********  The function below add, update and delete exam question table ***********************/
    // function examQuestion ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->exam_question_model->createexamQuestion();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/examQuestion', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->exam_question_model->updateexamQuestion($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/examQuestion', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->exam_question_model->deleteexamQuestion($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/examQuestion', 'refresh');
    //     }

    //     $page_data['page_name']     = 'examQuestion';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Exam Question');
    //     $this->load->view('backend/index', $page_data);
    // }
     /***********  The function below add, update and delete exam question table ends here ***********************/


    /***********  The function below add, update and delete examination table ***********************/
    // function createExamination ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->exam_model->createExamination();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/createExamination', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->exam_model->updateExamination($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/createExamination', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->exam_model->deleteExamination($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/createExamination', 'refresh');
    //     }

    //     $page_data['page_name']     = 'createExamination';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Create Exam');
    //     $this->load->view('backend/index', $page_data);
    // }
    /***********  The function below add, update and delete examination table ends here ***********************/

    /***********  The function below add, update and delete student payment table ***********************/
    // function student_payment ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'single_invoice'){
    //         $this->student_payment_model->createStudentSinglePaymentFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/student_invoice', 'refresh');
    //     }

    //     if($param1 == 'mass_invoice'){
    //         $this->student_payment_model->createStudentMassPaymentFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/student_invoice', 'refresh');
    //     }

    //     if($param1 == 'update_invoice'){
    //         $this->student_payment_model->updateStudentPaymentFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/student_invoice', 'refresh');
    //     }

    //     if($param1 == 'take_payment'){
    //         $this->student_payment_model->takeNewPaymentFromStudent($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/student_invoice', 'refresh');
    //     }


    //     if($param1 == 'delete_invoice'){
    //         $this->student_payment_model->deleteStudentPaymentFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/student_invoice', 'refresh');
    //     }

    //     $page_data['page_name']     = 'student_payment';
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['page_title']    = get_phrase('Student Payment');
    //     $this->load->view('backend/index', $page_data);
    // }   
    /***********  / Student payment ends here ***********************/
    
    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }


    function get_class_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }

        echo '<br><button type ="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">'.get_phrase('Unselect All').'</button>';
    }

    function student_invoice(){

        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete publisher table ***********************/
    // function publisher ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->library_model->createPublisherFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/publisher', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->library_model->updatePublisherFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/publisher', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->library_model->deletePublisherFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/publisher', 'refresh');
    //     }

    //     $page_data['page_name']     = 'publisher';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Manage Publisher');
    //     $this->load->view('backend/index', $page_data);
    // }
    /***********  The function below add, update and delete publisher table ends here ***********************/


    /***********  The function below add, update and delete publisher table ***********************/
    // function author ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->library_model->createAuthorFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/author', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->library_model->updateAuthorFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/author', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->library_model->deleteAuthorFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/author', 'refresh');
    //     }

    //     $page_data['page_name']     = 'author';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Manage Author');
    //     $this->load->view('backend/index', $page_data);
    // }

    /***********  The function below add, update and delete publisher table ends here ***********************/

    /***********  The function below add, update and delete BookCategory table ***********************/
    // function book_category ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->library_model->createBookCategoryFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/book_category', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->library_model->updateBookCategoryFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/book_category', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->library_model->deleteBookCategoryFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/book_category', 'refresh');
    //     }

    //     $page_data['page_name']     = 'book_category';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Book Category');
    //     $this->load->view('backend/index', $page_data);
    // }
    /***********  The function below add, update and delete BookCategory table ends here ***********************/



    /***********  The function below add, update and delete book table ***********************/
    // function book ($param1 = null, $param2 = null, $param3 = null){

    //     if($param1 == 'create'){
    //         $this->library_model->createBookFunction();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
    //         redirect(base_url(). 'admin/book', 'refresh');
    //     }

    //     if($param1 == 'update'){
    //         $this->library_model->updateBookFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
    //         redirect(base_url(). 'admin/book', 'refresh');
    //     }

    //     if($param1 == 'delete'){
    //         $this->library_model->deleteBookFunction($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/book', 'refresh');
    //     }

    //     $page_data['page_name']     = 'book';
    //     $school_id = $this->session->userdata('school_id');
    //     $page_data['page_title']    = get_phrase('Manage Library');
    //     $this->load->view('backend/index', $page_data);
    // }
    /***********  The function below add, update and delete book table ends here ***********************/

    /***********  The function below manages school event ***********************/
    function noticeboard ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('School Event');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }


    /***********  The function below manages school marks ***********************/
    function marks ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');

                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                    redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/marks', 'refresh');
                }
            }

            if($this->input->post('operation') == 'update_student_subject_score'){

                $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                    foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                        $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/



    /***********  The function below manages school marks ***********************/
     function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['subject_id']    =  $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

                redirect(base_url(). 'admin/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/student_marksheet_subject', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
                foreach ($select_student_first as $key => $dispay_student_from_student_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'admin/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'student_marksheet_subject';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/

    /***********  The function below manages school event ***********************/
    function exam_marks_sms ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'send'){
            $this->crud_model->send_student_score_model();
            $this->session->set_flashdata('flash_message', get_phrase('Data Sent successfully'));
            redirect(base_url(). 'admin/exam_marks_sms', 'refresh');
        }

        $page_data['page_name']     = 'exam_marks_sms';
        $page_data['page_title']    = get_phrase('Send Student Scores');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

    
    /***********  The function below manages new admin ***********************/
    function newAdministrator ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'update'){
            $this->admin_model->updateAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        $page_data['page_name']     = 'newAdministrator';
         $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('New Administrator');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages administrator ends here ***********************/

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }

    function set_language($lang){
        $this->session->set_userdata('language', $lang);
        redirect(base_url(). 'admin', 'refresh');
        recache();
    }
 /* Jitsi */

    function jitsi($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'add'){
            $this->live_class_model->createNewJitsiClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        if($param1 == 'edit'){
            $this->live_class_model->updateJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        if($param1 == 'delete'){
            $this->live_class_model->deleteJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        $page_data['page_name'] = 'jitsi';
        $clinic_id = $this->session->userdata('clinic_id');
        // $page_data['page_title'] = get_phrase('Online_Consultancy');
        $page_data['page_title'] = get_phrase('jitsi_live_class');
        $this->load->view('backend/index',$page_data);
    }

  





    function edit_jitsi($jitsi_id){

        $page_data['page_name'] = 'edit_jitsi';
        $page_data['page_title'] = get_phrase('edit_jitsi');
        $page_data['toSelectFromJitsiWithId'] = $this->live_class_model->toSelectFromJitsiWithId($jitsi_id);
        $this->load->view('backend/index',$page_data);
    }


    function stream_jitsi($jitsi_id){
        
        $page_data['jitsi_id'] = $jitsi_id;
        $this->load->view('backend/host/jitsi', $page_data);

    }
	
	
    // function chatRoomMessage(){
    //     $page_data['user_id'] = $this->input->post('user_id');
    //     $page_data['message'] = $this->input->post('chatSend');

    //     $this->db->insert('general_message', $page_data);
    //     echo json_encode($page_data);
    // }


    function appointment_list($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->appointment_list_model->insertappointment_listFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
    
        if($param1 == 'update'){
            $this->appointment_list_model->updateappointmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
    
    
        if($param1 == 'delete'){
            $this->appointment_list_model->deleteappointmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
    
        $page_data['page_name']     = 'appointment_list';
        $page_data['page_title']    = get_phrase('manage_appointment_list');
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_appointment_list']  = $this->db->get_where('calendar',array(''))->result_array();
        $this->load->view('backend/index', $page_data);
    
    }

    
function schedule_list(){

    $data_calendar = $this->schedule_list_model->get_list($this->table);
            $calendar = array();
            foreach ($data_calendar as $key => $val) 
            {
                $calendar[] = array(
                                'id'    => intval($val->id), 
                                'title' => $val->title,
    
                                 'description' => trim($val->description), 
                                'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i"),
                              'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i"),
                              'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i"),
                              'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i"),
    
                                'color' => $val->color,
                                );
            }
    
            $page_data = array();
        
        $page_data['page_name']     = 'schedule_list';
        $page_data['page_title']    = get_phrase('manage_schedule_list');
        $page_data['get_data']           = json_encode($calendar);
        $this->load->view('backend/index', $page_data);
    
    }
     function save()
        {
            $response = array();
            $this->form_validation->set_rules('title', 'Title cant be empty ', 'required');
            if ($this->form_validation->run() == TRUE)
            {
                $param = $this->input->post();
                $calendar_id = $param['calendar_id'];
                unset($param['calendar_id']);
    
                if($calendar_id == 0)
                {
                    $param['create_at']     = date('d-m-Y H:i');
                     $title = $this->input->post('title');
            $description = $this->input->post('description');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            $color = $this->input->post('color');
            $status = $this->input->post('status');
            $patient_id = $this->input->post('patient_id');
            $patient_name = $this->input->post('patient_name');
            $doctor_id = $this->input->post('doctor_id');
            $doctor_name = $this->input->post('doctor_name');
    
            
    
    
            $param = array(
                'title' => $title,
                'description' => $description,
                'start_date' => $start_date.' '.$start_time,
                'end_date' => $start_date.' '.$end_time,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'color' => $color,
                'status' => $status,
                'patient_id' => $patient_id,
                'patient_name' => $patient_name,
                'doctor_id' => $doctor_id,
                'doctor_name' => $doctor_name,
                
    
            );
                    $param['create_at']     = date('Y-m-d H:i:s');
                    $insert = $this->schedule_list_model->insert($this->table, $param);
    
                    if ($insert > 0) 
                    {
                        $response['status'] = TRUE;
                        $response['notif']  = 'Success add calendar';
                        $response['id']     = $insert;
                    }
                    else
                    {
                        $response['status'] = FALSE;
                        $response['notif']  = 'Server wrong, please save again';
                    }
                }
                else
                { 
                $param['create_at']     = date('d-m-Y H:i');
                     $title = $this->input->post('title');
            $description = $this->input->post('description');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            /*$color = $this->input->post('color');
            $status = $this->input->post('status');*/
    
             
    
    
            $param = array(
                'title' => $title,
                'description' => $description,
                'start_date' => $start_date.' '.$start_time,
                'end_date' => $start_date.' '.$end_time,
                'start_time' => $start_time,
                'end_time' => $end_time,
                /*'color' => $color,
                'status' => $status,*/
                
    
            );  
                    $where      = [ 'id'  => $calendar_id];
                    $param['modified_at']       = date('Y-m-d H:i:s');
                    $update = $this->schedule_list_model->update($this->table, $param, $where);
    
                    if ($update > 0) 
                    {
                        $response['status'] = TRUE;
                        $response['notif']  = 'Success add calendar';
                        $response['id']     = $calendar_id;
                    }
                    else
                    {
                        $response['status'] = FALSE;
                        $response['notif']  = 'Server wrong, please save again';
                    }
    
                }
            }
            else
            {
                $response['status'] = FALSE;
                $response['notif']  = validation_errors();
            }
    
            echo json_encode($response);
        }
    
     function delete()
        {
            $response       = array();
            $calendar_id    = $this->input->post('id');
            if(!empty($calendar_id))
            {
                $where = ['id' => $calendar_id];
                $delete = $this->schedule_list_model->delete($this->table, $where);
    
                if ($delete > 0) 
                {
                    $response['status'] = TRUE;
                    $response['notif']  = 'Success delete calendar';
                }
                else
                {
                    $response['status'] = FALSE;
                    $response['notif']  = 'Server wrong, please save again';
                }
            }
            else
            {
                $response['status'] = FALSE;
                $response['notif']  = 'Data not found';
            }
    
            echo json_encode($response);
        }



}





