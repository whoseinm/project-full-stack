<?php

class Posts_model extends CI_Model{
    public function insert($data){
        $this->db->insert('posts', $data);
    }

    public function delete_post($id){
        $this->db->where('post_id', $id);
        $this->db->delete('posts');
        $this->session->set_flashdata("success", "Post uğurla silindi");
        redirect(base_url("posts"));
    }

    public function posts(){
        return $this->db->order_by("post_id", "DESC")
            ->join("admin", "admin.a_id = posts.post_creator_id", "left")
            ->get('posts')->result_array();
    }
}