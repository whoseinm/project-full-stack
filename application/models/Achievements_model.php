<?php

class Testimonials_model extends CI_Model{
    public function get_all_achievements(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('achievement_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = achievements.achievement_updater_id)', 'left')
        ->get('achievements')->result_array();
    }
}