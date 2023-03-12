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

    public function contact_single($id){
        return $this->db
        ->where('contact_id',$id)
        ->join('admin', 'admin.a_id = contact.contact_viewer_id', 'left')
        ->get("contact")->row_array();
    }

    public function viewed($id,$data){
        $this->db->where('contact_id',$id)->update('contact',$data);
    }

    public function view_delete($id,$data){
        $this->db->where('contact_id',$id)
        ->join('admin','admin.a_id = contact.contact_viewer_id','left')
        ->update('contact',$data);
    }

    public function contact_delete($id){
        $this->db->where('contact_id', $id);
        $this->db->delete('contact');
        $this->session->set_flashdata("success", "Mesaj uğurla silindi");
        redirect(base_url("admin_contact"));
    }
    
}