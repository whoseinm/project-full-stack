<?php

class Special_courses_model extends CI_Model{

    public function insert($data){
        $this->db->insert('special_courses', $data);
    }

    public function get_all_special_courses(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('s_course_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = special_courses.s_course_creator_id)', 'left')
        ->get('special_courses')->result_array();
    }

    public function delete_special_course($id){
        $this->db->where('s_course_id', $id);
        $this->db->delete('special_courses');
        $this->session->set_flashdata("success", "Kurs uğurla silindi");
        redirect(base_url("special_courses_admin"));
    }

    public function update_special_course($id,$data){
        $this->db->where("s_course_id", $id)->update("special_courses", $data);
    }

    public function get_single_special_course($id){
        return $this->db
        ->where('s_course_id',$id)
        ->join('admin','admin.a_id = special_courses.s_course_creator_id','left')
        ->get('special_courses')->row_array();
    }

}