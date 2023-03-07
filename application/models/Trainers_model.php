<?php

class Trainers_model extends CI_Model{
    public function insert($data){
        $this->db->insert('trainers', $data);
    }

    public function update_trainer($id,$data){
        $this->db->where("trainer_id", $id)->update("trainers", $data);
    }

    public function trainers(){
    return $this->db
        ->where('trainer_creator_id',$_SESSION['admin_login_id'])
        ->order_by('trainer_id', 'DESC')
        ->get('trainers')
        ->result_array();
    }

    public function delete_trainer($id){
        $this->db->where('trainer_id', $id);
        $this->db->delete('trainers');
        $this->session->set_flashdata("success", "Trainer uğurla silindi");
        redirect(base_url("trainers"));
    }

    public function trainer_single($id){
        return $this->db
        ->where('trainer_id',$id)
        ->get("trainers")->row_array();
    }
}