<?php

class Testimonials_model extends CI_Model{
    
    public function insert($data){
        $this->db->insert('testimonials', $data);
    }

    public function delete_testimonial($id){
        $this->db->where('testimonial_id', $id);
        $this->db->delete('testimonials');
        $this->session->set_flashdata("success", "Rəy uğurla silindi");
        redirect(base_url("testimonials_admin"));
    }

    public function get_all_testimonials(){
        return $this->db
            // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
            ->order_by('testimonial_id', 'DESC')
            // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
            ->join('admin', '(admin.a_id = testimonials.testimonial_updater_id)', 'left')
            ->get('testimonials')->result_array();
    }

    public function get_single_testimonial($id){
        return $this->db
        ->where('testimonial_id',$id)
        ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->get('testimonials')->row_array();
    }


    public function update_testimonial($id,$data){
        $this->db->where("testimonial_id", $id)->update("testimonials", $data);
    }
}