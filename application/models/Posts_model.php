<?php

class Posts_model extends CI_Model{
    public function insert($data){
        $this->db->insert('posts', $data);
    }

    public function update_post($id,$data){
        $this->db->where("post_id", $id)->update("posts", $data);
    }

    public function delete_post($id){
        $this->db->where('post_id', $id);
        $this->db->delete('posts');
        $this->session->set_flashdata("success", "Post uğurla silindi");
        redirect(base_url("posts"));
    }

    public function posts(){
        return $this->db
            // ->where('post_creator_id',$_SESSION['admin_login_id'])
            ->order_by('post_id', 'DESC')
            // ->join('admin', 'admin.a_id = posts.post_creator_id','left')
            ->join('admin', 'admin.a_id = posts.post_updater_id','left')
            ->get('posts')->result_array();
    }

    public function post_single($id){
        return $this->db
        ->where('post_id',$id)
        ->join("admin", "admin.a_id = posts.post_creator_id", "left")
        ->get("posts")->row_array();
    }
}