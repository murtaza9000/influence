<?php
class Domain_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_domain($id)
  {
       $query = $this->db->get_where('domain',array('id'=>$id));
       return $query->result_array();
  }
}