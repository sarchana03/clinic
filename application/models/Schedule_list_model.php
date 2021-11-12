<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_list_model extends CI_Model 
{
    function get_list($table, $where = FALSE )
    {
        if ($where) {
            $this->db->where($where);
        }
        
        return $this->db->get($table)->result();
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