<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_calendar_model extends CI_Model 
{
    function get_list()
    
    {
        $doctor_id = $this->session->userdata('doctor_id');
        
        
       $sql = "calendar WHERE `doctor_id`= '$doctor_id' ";
        
        
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