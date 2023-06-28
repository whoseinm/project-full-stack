<?php
class Vacancy_model extends CI_Model{

    public function insert($data){
        $this->db->insert('vacancy', $data);
    }

    public function delete_vacancy($id){
        $this->db->where('vacancy_id', $id);
        $this->db->delete('vacancy');
        $this->session->set_flashdata("success", "Vakansiya uğurla silindi");
        redirect(base_url("vacancies_admin"));
    }

    public function get_all_vacancies(){
        return $this->db
            // ->where('post_creator_id',$_SESSION['admin_login_id'])
            ->order_by('vacancy_creator_id', 'DESC')
            // ->join('admin', 'admin.a_id = posts.post_creator_id','left')
            ->join('admin', 'admin.a_id = vacancy.vacancy_updater_id','left')
            ->get('vacancy')->result_array();
    }

    public function get_single_vacancy($id){
        return $this->db
        ->where('vacancy_id',$id)
        ->join('admin','admin.a_id = vacancy.vacancy_creator_id','left')
        ->get('vacancy')->row_array();
    }

    public function update_vacancy($id,$data){
        $this->db->where("vacancy_id", $id)->update("vacancy", $data);
    }
}