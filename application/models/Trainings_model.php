<?php

class Trainings_model  extends CI_Model{

    public function insert($data){
        $this->db->insert('trainings', $data);
    }

    public function get_all_trainings(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('training_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = trainings.training_creator_id)', 'left')
        ->get('trainings')->result_array();
    }

    public function get_single_trainings($id){
        return $this->db
        ->where('training_id',$id)
        ->join('admin','admin.a_id = trainings.training_creator_id','left')
        ->get('trainings')->row_array();
    }

    public function update_trainings($id,$data){
        $this->db->where("training_id", $id)->update("trainings", $data);
    }

    public function delete_trainings($id){
        $this->db->where('training_id', $id);
        $this->db->delete('trainings');
        $this->session->set_flashdata("success", "Təlim uğurla silindi");
        redirect(base_url("trainings_admin"));
    }

}