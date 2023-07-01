<?php

class Training_plan_model extends CI_Model{
    public function insert($data){
        $this->db->insert('training_plan', $data);
    }

    public function update_plan($id,$data){
        $this->db->where("plan_id", $id)->update("training_plan", $data);
    }

    public function get_all_plans(){
    return $this->db
        ->order_by('plan_id', 'DESC')
        ->get('training_plan')
        ->result_array();
    }

    public function delete_plan($id){
        $this->db->where('plan_id', $id);
        $this->db->delete('training_plan');
        $this->session->set_flashdata("success", "Plan uğurla silindi");
        redirect(base_url("plans_admin"));
    }

    public function get_single_plan($id){
        return $this->db
        ->where('plan_id',$id)
        ->join('admin','admin.a_id = training_plan.plan_creator_id','left')
        ->get('training_plan')->row_array();
    }
}