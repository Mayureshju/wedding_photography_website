<?php

class Mymdl extends CI_Model {
    
    public function all_residential_interior() {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("MC_page_name",'residential');
        $this->db->order_by("MP_Id","desc");
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result();
    }
    public function all_residential_details($id) {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("purl",$id);
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result_array();
    }


    public function all_restaurant_interior() {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("MC_page_name",'restaurant');
        $this->db->order_by("MP_Id","desc");
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result();
    }
    public function portfolio_details_restaurant($id) {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("purl",$id);
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result_array();
    }

    // commercial

    public function all_commercial_interior() {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("MC_page_name",'commercial');
        $this->db->order_by("MP_Id","desc");
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result();
    }
    public function portfolio_details_commercial($id) {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("purl",$id);
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result_array();
    }
    
    // architecture

    public function all_architecture_interior() {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("MC_page_name",'architecture');
        $this->db->order_by("MP_Id","desc");
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result();
    }
    public function portfolio_details_architecture($id) {
        // print_r($dd);
         $this->db->select('*');
        $this->db->where("purl",$id);
        $this->db->from('mov_portfolio');
        $data=$this->db->get();
        return $data->result_array();
    }
    
    public function select_data($table,$field,$where)
    {
            $this->db->select($field); 
            $this->db->from($table);
            if($where != '')
            {
                $this->db->where($where);
            }
            $query = $this->db->get();
            return $query->result();
    }
    
}

?>