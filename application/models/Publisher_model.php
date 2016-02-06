<?php
class Publisher_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_publisher()
  {
       $query = $this->db->get('publisher');
       return $query->result_array();
  }
}