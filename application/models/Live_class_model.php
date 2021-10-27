<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Live_class_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }

    /*>>>>>>>>> Function to save Jitsi to Table >>>>>>>>> */
    function createNewJitsiClassFunction(){

        $arrayLive = array(
            'clinic_id' => $this->session->userdata('clinic_id'),
            'title'             => html_escape($this->input->post('title')),
            // 'class_id'          => html_escape($this->input->post('class_id')),
            // 'section_id'        => html_escape($this->input->post('section_id')),
            'patient_id'        => html_escape($this->input->post('patient_id')),
            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),
            'room'              => md5(date('d-m-Y H:i:s')).substr(md5(rand(1000000, 2000000)), 0, 10),
            'publish_date'      => strtotime(date('Y-m-d')),
            'user_id'           => $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')

        );

		$sql = "select * from jitsi order by jitsi_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->jitsi_id + 1;
		$arrayLive['jitsi_id'] = $return_query;
        $this->db->insert('jitsi', $arrayLive);
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $patients = $this->db->get_where('patient', array('group_id' => $this->input->post('group_id')))->row();
            $patient_parent_id = $patients->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $patient_parent_id))->result_array();
            $patient_array = $this->db->get_where('patient', array('group_id' => $patients->group_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($patient_array as $key => $patient){
                $recieverPhoneNumber = $patient['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }




    /*>>>>>>>>> Function to upadte Jitsi to Table >>>>>>>>> */
    function updateJitsiClassFunction($param2){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            // 'class_id'          => html_escape($this->input->post('class_id')),
            // 'section_id'        => html_escape($this->input->post('section_id')),
            'patient_id'        => html_escape($this->input->post('patient_id')),

            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),

        );

		
        $this->db->where('jitsi_id', $param2);
        $this->db->update('jitsi', $arrayLive);
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $patients = $this->db->get_where('patient', array('group_id' => $this->input->post('group_id')))->row();
            $patient_parent_id = $patients->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $patient_parent_id))->result_array();
            $patient_array = $this->db->get_where('patient', array('group_id' => $patients->group_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($patient_array as $key => $patient){
                $recieverPhoneNumber = $patient['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }

    /*>>>>>>>>> Function to delete Jitsi from Table >>>>>>>>> */
    function deleteJitsiClassFunction($param2){
        $this->db->where('jitsi_id', $param2);
        $this->db->delete('jitsi');
    }


    /*>>>>>>>>> Function to select from Jitsi Table >>>>>>>>> */

    function selectJitsiStaffInsert(){
        $staff = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from jitsi where user_id='".$staff."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectJitsipatientbypatientId(){
        $patientgroup = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row()->group_id;
        $patientsubgroup = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row()->subgroup_id;

        $sql = "select * from jitsi where group_id='".$patientgroup."' and subgroup_id='".$patientsubgroup."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    } 


    function selectJitsiStudentByClassSection(){
        $studentClass = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->class_id;
        $studentSection = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->section_id;

        $sql = "select * from jitsi where class_id='".$studentClass."' and section_id='".$studentSection."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    } 

    function toSelectFromJitsiWithId($jitsi_id){
        $sql = "select * from jitsi where jitsi_id ='".$jitsi_id."'";
        return $this->db->query($sql)->result_array();
    }
	
	



}