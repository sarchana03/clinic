<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Newuser_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // function below insert into newuser table //
    //      function createNewuser(){

    //     $page_data = array(
    //         'clinic_id'     => $this->session->userdata('clinic_id'),
    //         'name'          => html_escape($this->input->post('name')),
    //         'gender'           => html_escape($this->input->post('gender')),
    //         'blood_group'           => html_escape($this->input->post('blood_group')),
    //         'phone'         => html_escape($this->input->post('phone')),
    //         'email'         => html_escape($this->input->post('email')),
    //         'password'        => sha1($this->input->post('password')),
    //         'address'       => html_escape($this->input->post('address'))
    //     );

    //           $this->db->insert('newuser', $page_data);
    // $user_id = $this->db->insert_id();
    // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/newuser_image/' . $user_id . '.jpg');			// image with user ID

    // }



    function save($capsule)
    {
        $insert = $this->db->insert('newuser', $capsule);
        if($insert){
            return $msg = "Data inserted successfully ";
        }
    }



    // The function below insert into patient house //
    // function createpatientHouse(){

    //     $page_data = array(
    //         'name'          => html_escape($this->input->post('name')),
    //         'description'      => html_escape($this->input->post('description')),
           
	//     );

    //     $this->db->insert('house', $page_data);
    // }

// The function below update patient house //
    // function updatepatientHouse($param2){
    //     $page_data = array(
    //         'name'         => html_escape($this->input->post('name')),
    //         'description'  => html_escape($this->input->post('description'))
	//     );

    //     $this->db->where('house_id', $param2);
    //     $this->db->update('house', $page_data);
    // }

    // The function below delete from patient house table //
    // function deletepatientHouse($param2){
    //     $this->db->where('house_id', $param2);
    //     $this->db->delete('house');
    // }



    // The function below insert into patient category //
    // function createpatientCategory(){

    //     $page_data = array(
    //         'name'        => html_escape($this->input->post('name')),
    //         'description' => html_escape($this->input->post('description'))
	//     );
    //     $this->db->insert('patient_category', $page_data);
    // }

// The function below update patient category //
    // function updatepatientCategory($param2){
    //     $page_data = array(
    //         'name'        => html_escape($this->input->post('name')),
    //         'description' => html_escape($this->input->post('description'))
	//     );

    //     $this->db->where('patient_category_id', $param2);
    //     $this->db->update('patient_category', $page_data);
    // }

    // The function below delete from patient category table //
    // function deletepatientCategory($param2){
    //     $this->db->where('patient_category_id', $param2);
    //     $this->db->delete('patient_category');
    // }




    //  the function below insert into patient table
    // function createNewuser(){

    //     $page_data = array(
    //         'clinic_id'     => $this->session->userdata('clinic_id'),
    //         'name'          => html_escape($this->input->post('name')),
    //         'gender'           => html_escape($this->input->post('gender')),
    //         'blood_group'           => html_escape($this->input->post('blood_group')),
    //         'phone'         => html_escape($this->input->post('phone')),
    //         'email'         => html_escape($this->input->post('email')),
    //         'password'        => sha1($this->input->post('password')),
    //         'address'       => html_escape($this->input->post('address'))





    //         'group_id'          => html_escape($this->input->post('group_id')),
    //         'sub_group_id'          => html_escape($this->input->post('sub_group_id')),
    //         'birthday'      => html_escape($this->input->post('birthday')),
    //         'age'           => html_escape($this->input->post('age')),
    //         'place_birth'   => html_escape($this->input->post('place_birth')),
    //         'sex'           => html_escape($this->input->post('sex')),
    //         'm_tongue'      => html_escape($this->input->post('m_tongue')),
    //         'religion'      => html_escape($this->input->post('religion')),
    //         'blood_group'   => html_escape($this->input->post('blood_group')),
    //         'address'       => html_escape($this->input->post('address')),
    //         'city'          => html_escape($this->input->post('city')),
    //         'state'         => html_escape($this->input->post('state')),
    //         'nationality'   => html_escape($this->input->post('nationality')),
    //         'phone'         => html_escape($this->input->post('phone')),
    //         'email'         => html_escape($this->input->post('email')),
    //         'ps_attended'   => html_escape($this->input->post('ps_attended')),
    //         'ps_address'    => html_escape($this->input->post('ps_address')),
    //         'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
    //         'class_study'   => html_escape($this->input->post('class_study')),
    //         'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
    //         'am_date'         => html_escape($this->input->post('am_date')),
    //         'tran_cert'       => html_escape($this->input->post('tran_cert')),
    //         'dob_cert'        => html_escape($this->input->post('dob_cert')),
    //         'mark_join'        => html_escape($this->input->post('mark_join')),
    //         'physical_h'      => html_escape($this->input->post('physical_h')),
    //         'password'        => sha1($this->input->post('password')),
    //         'class_id'        => html_escape($this->input->post('class_id')),
    //         'section_id'      => html_escape($this->input->post('section_id')),
    //         'parent_id'       => html_escape($this->input->post('parent_id')),
    //         'roll'            => html_escape($this->input->post('roll')),
    //         'transport_id'    => html_escape($this->input->post('transport_id')),
    //         'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
    //         'house_id'        => html_escape($this->input->post('house_id')),
    //         'patient_category_id' => html_escape($this->input->post('patient_category_id')),
    //         'club_id'             => html_escape($this->input->post('club_id')),
    //         'session'             => html_escape($this->input->post('session'))
    //     );
        
  
    // $this->db->insert('newuser', $page_data);
    // $user_id = $this->db->insert_id();
    // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/patient_image/' . $patient_id . '.jpg');			// image with user ID

    // }


    //the function below update patient
    // function updateNewuser($param2){
    //     $page_data = array(
    //         'name'          => html_escape($this->input->post('name')),
    //         'gender'           => html_escape($this->input->post('gender')),
    //         'blood_group'           => html_escape($this->input->post('blood_group')),
    //         'phone'         => html_escape($this->input->post('phone')),
    //         'email'         => html_escape($this->input->post('email')),
    //         'password'        => sha1($this->input->post('password')),
    //         'address'       => html_escape($this->input->post('address'))


    //         'group_id'          => html_escape($this->input->post('group_id')),
    //         'sub_group_id'          => html_escape($this->input->post('sub_group_id')),
    //         'birthday'      => html_escape($this->input->post('birthday')),
    //         'age'           => html_escape($this->input->post('age')),
    //         'place_birth'   => html_escape($this->input->post('place_birth')),
    //         'sex'           => html_escape($this->input->post('sex')),
    //         'm_tongue'      => html_escape($this->input->post('m_tongue')),
    //         'religion'      => html_escape($this->input->post('religion')),
    //         'blood_group'   => html_escape($this->input->post('blood_group')),
    //         'address'       => html_escape($this->input->post('address')),
    //         'city'          => html_escape($this->input->post('city')),
    //         'state'         => html_escape($this->input->post('state')),
    //         'nationality'   => html_escape($this->input->post('nationality')),
    //         'phone'         => html_escape($this->input->post('phone')),
    //         'email'         => html_escape($this->input->post('email')),
    //         'ps_attended'   => html_escape($this->input->post('ps_attended')),
    //         'ps_address'    => html_escape($this->input->post('ps_address')),
    //         'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
    //         'class_study'   => html_escape($this->input->post('class_study')),
    //         'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
    //         'am_date'         => html_escape($this->input->post('am_date')),
    //         'tran_cert'       => html_escape($this->input->post('tran_cert')),
    //         'dob_cert'        => html_escape($this->input->post('dob_cert')),
    //         'mark_join'        => html_escape($this->input->post('mark_join')),
    //         'physical_h'      => html_escape($this->input->post('physical_h')),
    //         'class_id'        => html_escape($this->input->post('class_id')),
    //         'section_id'      => html_escape($this->input->post('section_id')),
    //         'parent_id'       => html_escape($this->input->post('parent_id')),
    //         'transport_id'    => html_escape($this->input->post('transport_id')),
    //         'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
    //         'house_id'        => html_escape($this->input->post('house_id')),
    //         'patient_category_id' => html_escape($this->input->post('patient_category_id')),
    //         'club_id'             => html_escape($this->input->post('club_id'))
	//     );
    //     $this->db->where('user_id', $param2);
    //     $this->db->update('user', $page_data);
    //     move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $param2 . '.jpg');

    // }

    // the function below deletes from patient table
    // function deleteNewuser($param2){
    //     $this->db->where('user_id', $param2);
    //     $this->db->delete('user');
    // }

	


	
	
}

