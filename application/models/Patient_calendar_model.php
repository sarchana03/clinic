<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_calendar_model extends CI_Model 
{
    function get_list()
    
    {
        $patient_id = $this->session->userdata('patient_id');
        
        
       $sql = "calendar WHERE `patient_id`= '$patient_id' ";
        
        
        return $this->db->get($sql)->result();
    }    

    function insert($table, $param)
    {
        $this->db->insert($table, $param);

        return $this->db->insert_id();
    }
  
    function update($table, $set, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $set);
        return $this->db->affected_rows();
    }

 function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }


}