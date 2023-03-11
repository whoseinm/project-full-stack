<?php

class Contact_model extends CI_Model{
    public function insert($data){
        $this->db->insert('contact', $data);
    }

    public function get_all_messages(){
    return $this->db
        ->order_by('contact_id',"DESC")
        ->get('contact')->result_array();
        
    }
}