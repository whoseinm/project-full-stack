<?php

class Prices_model extends CI_Model{

    public function insert($data){
        $this->db->insert('prices', $data);
    }

    public function get_all_prices(){
        return $this->db
        // ->where('testimonial_creator_id',$_SESSION['admin_login_id'])
        ->order_by('price_id', 'DESC')
        // ->join('admin','admin.a_id = testimonials.testimonial_creator_id','left')
        ->join('admin', '(admin.a_id = prices.price_creator_id)', 'left')
        ->get('prices')->result_array();
    }

    public function delete_prices($id){
        $this->db->where('price_id', $id);
        $this->db->delete('prices');
        $this->session->set_flashdata("success", "Qiymət uğurla silindi");
        redirect(base_url("prices_admin"));
    }

    public function update_prices($id,$data){
        $this->db->where("price_id", $id)->update("prices", $data);
    }

    public function get_single_prices($id){
        return $this->db
        ->where('price_id',$id)
        ->join('admin','admin.a_id = prices.price_creator_id','left')
        ->get('prices')->row_array();
    }

}