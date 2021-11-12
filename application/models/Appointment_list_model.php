<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Appointment_list_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insertappointment_listFunction(){
        
        $page_data = array(
          'patient_id' => $this->session->userdata('patient_id'),
            
            'title' => $this->input->post('name'),
            'doctor_id' => $this->input->post('doctor_id'),
            //'email' => $this->input->post('email'),
            //'contact' => $this->input->post('contact'),
            //'gender' => $this->input->post('gender'),
            //'date_o_b' => $this->input->post('date_o_b'),
            //'address' => $this->input->post('address'),
            'description' => $this->input->post('description'),
            'purpose' => $this->input->post('purpose'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'status' => $this->input->post('status'),

            
            );


            $this->db->insert('calendar', $page_data);
    }
    function updateappointmentFunction($param2){
        $page_data = array(
            'title'      => html_escape($this->input->post('title')),
            
    );

        $this->db->where('id', $param2);
        $this->db->update('calendar', $page_data);
    }

    // The function below delete from award table //
    function deleteappointmentFunction($param2){
        $this->db->where('id', $param2);
        $this->db->delete('calendar');
    }




	
	
}
  