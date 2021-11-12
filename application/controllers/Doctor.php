<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Doctor extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->table        = 'calendar';                                //Load Databse Class

                $this->load->library('session');					    //Load library for session
               // $this->load->model('vacancy_model');
               $this->load->model('live_class_model');

    }

     /*doctor dashboard code to redirect to doctor page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('doctor_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('doctor Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / doctor dashboard code to redirect to doctor page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('doctor_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('doctor_id', $this->session->userdata('doctor_id'));
            $this->db->update('doctor', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/doctor_image/' . $this->session->userdata('doctor_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'doctor/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('doctor_id', $this->session->userdata('doctor_id'));
               $this->db->update('doctor', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'doctor/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('doctor_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }



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
        //         redirect(base_url() . 'doctor/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
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
        //     redirect(base_url(). 'doctor/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
        // }
    
    
        // function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
            
        //     $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            
        //     if ($_POST) {
        //     redirect(base_url() . 'doctor/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
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
        //     $page_data['section_id'] 	= $section_id;					// get all section_id
        //     $page_data['month'] 		= $month;						// get all month
        //     $page_data['year'] 			= $year;						// get all class year
            
        //     $this->load->view('backend/doctor/loadAttendanceReport' , $page_data);
        // }
        /******************** Load attendance with ajax code ends from here **********************/
        
    
        /******************** print attendance report **********************/
        // function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
        // {
        //     $page_data['class_id'] 		= $class_id;					// get all class_id
        //     $page_data['section_id'] 	= $section_id;					// get all section_id
        //     $page_data['month'] 		= $month;						// get all month
        //     $page_data['year'] 			= $year;						// get all class year
            
        //     $page_data['page_name'] = 'printAttendanceReport';
        //     $page_data['page_title'] = "Attendance Report";
        //     $this->load->view('backend/index', $page_data);
        // }
        /******************** /Ends here **********************/
     /***********  The function below manages school marks ***********************/
    //  function marks ($exam_id = null, $class_id = null, $student_id = null){

    //     if($this->input->post('operation') == 'selection'){

    //         $page_data['exam_id']       =  $this->input->post('exam_id'); 
    //         $page_data['class_id']      =  $this->input->post('class_id');
    //         $page_data['student_id']    =  $this->input->post('student_id');

    //         if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

    //             redirect(base_url(). 'doctor/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
    //         }
    //         else{
    //             $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
    //             redirect(base_url(). 'doctor/marks', 'refresh');
    //         }
    //     }

    //     if($this->input->post('operation') == 'update_student_subject_score'){

    //         $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
    //             foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

    //                 $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
    //                 $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
    //                 $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
    //                 $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
    //                 $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

    //                 $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
    //                 $this->db->update('mark', $page_data);  
    //             }

    //             $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
    //             redirect(base_url(). 'doctor/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
    //     }

    //     $page_data['exam_id']       =   $exam_id;
    //     $page_data['class_id']      =   $class_id;
    //     $page_data['student_id']    =   $student_id;
    //     // $page_data['subject_id']   =    $subject_id;
    //     $page_data['page_name']     =   'marks';
    //     $page_data['page_title']    = get_phrase('Student Marks');
    //     $this->load->view('backend/index', $page_data);
    // }
    /***********  The function that manages school marks ends here ***********************/



    /***********  The function below manages school marks ***********************/
    // function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

    // if($this->input->post('operation') == 'selection'){

    //     $page_data['exam_id']       =  $this->input->post('exam_id'); 
    //     $page_data['class_id']      =  $this->input->post('class_id');
    //     $page_data['subject_id']    =  $this->input->post('subject_id');

    //     if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

    //         redirect(base_url(). 'doctor/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
    //     }
    //     else{
    //         $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
    //         redirect(base_url(). 'doctor/student_marksheet_subject', 'refresh');
    //     }
    // }

    // if($this->input->post('operation') == 'update_student_subject_score'){

    //     $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
    //         foreach ($select_student_first as $key => $dispay_student_from_student_table){

    //             $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
    //             $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
    //             $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
    //             $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
    //             $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

    //             $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
    //             $this->db->update('mark', $page_data);  
    //         }

    //         $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
    //         redirect(base_url(). 'doctor/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
    // }

    // $page_data['exam_id']       =   $exam_id;
    // $page_data['class_id']      =   $class_id;
    // // $page_data['student_id']    =   $student_id;
    // $page_data['subject_id']   =    $subject_id;
    // $page_data['page_name']     =   'student_marksheet_subject';
    // $page_data['page_title']    = get_phrase('Student Marks');
    // $this->load->view('backend/index', $page_data);
    // }

    /***********  The function that manages school marks ends here ***********************/    


function jitsi($param1 = null, $param2 = null, $param3 = null){


            if($param1 == 'add'){
                $this->live_class_model->createNewJitsiClassFunction();
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
                redirect(base_url() . 'doctor/jitsi/', 'refresh');
            }
    
            if($param1 == 'edit'){
                $this->live_class_model->updateJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
                redirect(base_url() . 'doctor/jitsi/', 'refresh');
            }
    
            if($param1 == 'delete'){
                $this->live_class_model->deleteJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
                redirect(base_url() . 'doctor/jitsi/', 'refresh');
            }
    
            $page_data['page_name'] = 'jitsi';
            $page_data['page_title'] = get_phrase('Online Consultancy');
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
            $this->load->view('backend/host/jitsi-doctor', $page_data);
    
        }



        function my_calendar(){
    
            $data_calendar = $this->doctor_calendar_model->get_list($this->table);
                   $calendar = array();
                   foreach ($data_calendar as $key => $val) 
                   {
                       $calendar[] = array(
                                       'id'    => intval($val->id), 
                                       'title' => $val->title,
           
                                         'description' => trim($val->description),
                                         
                                       'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
                                       'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),
                                       'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i:s"),
                                       'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i:s"),
           
                                       'color' => $val->color,
                                       );
                   }
           
               $page_data = array();
               $page_data['page_name']     = 'my_calendar';
               $page_data['page_title']    = get_phrase('manage_my_calendar');
               $page_data['get_data']      = json_encode($calendar);
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
                   
           
           
                   $param = array(
                       'title' => $title,
                       'description' => $description,
                       'start_date' => $start_date.' '.$start_time,
                       'end_date' => $start_date.' '.$end_time,
                       'start_time' => $start_time,
                       'end_time' => $end_time,
                       
           
                   );
                           $param['create_at']     = date('Y-m-d H:i:s');
                           $insert = $this->doctor_calendar_model->insert($this->table, $param);
           
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
                           $color = $this->input->post('color');
                           $status = $this->input->post('status');
           
                   
           
           
                   $param = array(
                       'title' => $title,
                       'description' => $description,
                       'start_date' => $start_date.' '.$start_time,
                       'end_date' => $start_date.' '.$end_time,
                       'start_time' => $start_time,
                       'end_time' => $end_time,
                       'color' => $color,
                       'status' => $status,
                       
           
                   );
                           $where      = [ 'id'  => $calendar_id];
                           $param['modified_at']       = date('Y-m-d H:i:s');
                           $update = $this->doctor_calendar_model->update($this->table, $param, $where);
           
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
                       $delete = $this->doctor_calendar_model->delete($this->table, $where);
           
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
                   function appointment(){
                       $page_data['page_name']     = 'appointment';
                       $page_data['page_title']    = get_phrase('manage_student_details');
                       $this->load->view('backend/index', $page_data);
           
           }
           function appointment_form($param1 = null, $param2 = null, $param3 = null){
               if($param1 == 'insert'){
                   $this->appointment_list_model->insertappointment_listFunction();
                   $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                   redirect(base_url(). 'doctor/appointment', 'refresh');
               }
           
               if($param1 == 'update'){
                   $this->appointment_list_model->updateappointmentFunction($param2);
                   $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                   redirect(base_url(). 'doctor/appointment', 'refresh');
               }
           
           
               if($param1 == 'delete'){
                   $this->appointment_list_model->deleteappointmentFunction($param2);
                   $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                   redirect(base_url(). 'doctor/appointment', 'refresh');
               }
                       $page_data['page_name']     = 'appointment_form';
                       $page_data['page_title']    = get_phrase('manage_appointment_form');
                       $page_data['select_appointment_form']  = $this->db->get_where('calendar',array('id'=>$id))->result_array();
                       $this->load->view('backend/index', $page_data);
           
           }
        


}