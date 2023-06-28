<?php

class Partners_model extends CI_Model{
    public function insert($data){
        $this->db->insert('partners', $data);
    }

    public function delete_partner($id){
        $this->db->where('partner_id', $id);
        $this->db->delete('partners');
        $this->session->set_flashdata("success", "Partner uğurla silindi");
        redirect(base_url("partners_admin"));
    }

    public function update_partner($id,$data){
        $this->db->where("partner_id", $id)->update("partners", $data);
    }

    public function get_all_partners(){
        return $this->db
            // ->where('post_creator_id',$_SESSION['admin_login_id'])
            ->order_by('partner_id', 'DESC')
            // ->join('admin', 'admin.a_id = posts.post_creator_id','left')
            ->join('admin', 'admin.a_id = partners.partner_updater_id','left')
            ->get('partners')->result_array();
    }

    public function get_single_partner($id){
        return $this->db
        ->where('partner_id',$id)
        ->join('admin','admin.a_id = partners.partner_creator_id','left')
        ->get('partners')->row_array();
    }
}