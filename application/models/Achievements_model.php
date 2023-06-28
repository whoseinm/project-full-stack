<?php

class Achievements_model extends CI_Model{

    public function insert($data){
        $this->db->insert('achievements', $data);
    }

    public function delete_achievements($id){
        $this->db->where('achievement_id', $id);
        $this->db->delete('achievements');
        $this->session->set_flashdata("success", "Uğur uğurla silindi");
        redirect(base_url("achievements_admin"));
    }

    public function get_all_achievements(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('achievement_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = achievements.achievement_updater_id)', 'left')
        ->get('achievements')->result_array();
    }

    public function get_single_achievement($id){
        return $this->db
        ->where('achievement_id',$id)
        ->join('admin','admin.a_id = achievements.achievement_creator_id','left')
        ->get('achievements')->row_array();
    }

    public function update_achievements($id,$data){
        $this->db->where("achievement_id", $id)->update("achievements", $data);
    }

}