<?php

class Courses_model extends CI_Model{

    public function insert($data){
        $this->db->insert('courses', $data);
    }
    public function get_all_courses(){
        return $this->db
        ->order_by('course_id', 'DESC')
        ->join('admin', 'admin.a_id = courses.course_creator_id','left')
        ->join('category','category.category_id = courses.course_category_id', 'left')
        ->join('trainers', 'trainers.trainer_name = courses.course_trainer','left')
        ->get('courses')->result_array();
    }
    
    public function get_all_trainers(){
        return $this->db
        ->order_by('trainer_id', 'DESC')
        ->get('trainers')->result_array();
    }

    public function get_all_categories(){
        return $this->db
        ->order_by('category_id', 'DESC')
        ->get('category')->result_array();
    }

    public function get_limit_10_category(){
        return $this->db
        ->limit(8)
        ->order_by('category_id')
        ->select('category_id,category_title')
        ->order_by('category_id','DESC')
        ->get('category')->result_array();
    }

    public function get_category_courses($id){
        return $this->db
        ->where('course_category_id',$id)
        ->join('trainers','trainers.trainer_name = courses.course_trainer', 'left')
        ->get('courses')
        ->result_array();
    }

    public function delete_trainer($id){
        return $this->db->where('trainer_id', $id)->delete('trainers');
    }


    public function update_course($id,$data){
        $this->db->where("course_id", $id)->update("courses", $data);
    }


    public function delete_course($id){
        $this->db->where('course_id', $id);
        $this->db->delete('courses');
        $this->session->set_flashdata("success", "Course uğurla silindi");
        redirect(base_url("courses_admin"));
    }

    

    public function get_single_course($id){
        return $this->db
        ->where('course_id',$id)
        ->join('admin','admin.a_id = courses.course_creator_id','left')
        ->join('category','category.category_id = courses.course_category_id','left')
        ->join('trainers','trainers.trainer_name = courses.course_trainer','left')
        ->get('courses')->row_array();
    }

    public function get_single_data($id){
        return $this->db->where('course_id', $id)
        ->join('category','category.category_id = courses.course_category_id','left')
        ->join('trainers','trainers.trainer_name = courses.course_trainer','left')
        ->get('courses')->row_array();
    }

}