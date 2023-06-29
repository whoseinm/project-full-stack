<?php

class StudyAbroad_model extends CI_Model{

    public function insert($data){
        $this->db->insert('studyAbroad', $data);
    }

    public function get_all_study_abroad(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('abroad_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = studyAbroad.abroad_creator_id)', 'left')
        ->get('studyAbroad')->result_array();
    }

    public function update_abroad($id,$data){
        $this->db->where("abroad_id", $id)->update("studyAbroad", $data);
    }

    public function get_single_abroad($id){
        return $this->db
        ->where('abroad_id',$id)
        ->join('admin','admin.a_id = studyAbroad.abroad_creator_id','left')
        ->get('studyAbroad')->row_array();
    }

    public function delete_abroad($id){
        $this->db->where('abroad_id', $id);
        $this->db->delete('studyAbroad');
        $this->session->set_flashdata("success", "Təhsil uğurla silindi");
        redirect(base_url("studyAbroad_admin"));
    }

}