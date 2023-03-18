<?php

class Hero_model extends CI_Model{

    public function insert($data){
        $this->db->insert('slider',$data);
    }

    public function update_slider($id,$data){
        $this->db->where("slider_id", $id)->update("slider", $data);
    }

    public function hero_caption_delete($id){
        $this->db->where('slider_id', $id);
        $this->db->delete('slider');
        $this->session->set_flashdata("success", "Slide uğurla silindi");
        redirect(base_url("hero_caption"));
    }

    public function hero_single($id){
        return $this->db
        ->where('slider_id',$id)
        ->get("slider")->row_array();
    }
    
    public function slides(){
        return $this->db
        ->where('slider_status', "Active")
        ->order_by('slider_id', 'DESC')
        ->get('slider')->row_array();
    }

    public function slides_admin(){
        return $this->db
        ->order_by('slider_id', 'DESC')
        ->get('slider')->result_array();
    }
}