<?php
class About_model extends CI_Model{

    public function insert($data){
        $this->db->insert('about', $data);
    }

    public function update_about($id,$data){
        $this->db->where("about_id", $id)->update("about", $data);
    }

    public function about(){
        return $this->db
        ->order_by('about_id', 'DESC')
        ->get('about')
        ->result_array();
    }

    public function about_delete($id){
        $this->db->where('about_id', $id);
        $this->db->delete('about');
        $this->session->set_flashdata("success", "About uğurla silindi");
        redirect(base_url("admin_about"));
    }

    public function about_single($id){
        return $this->db
        ->where('about_id',$id)
        ->get("about")->row_array();
    }
}