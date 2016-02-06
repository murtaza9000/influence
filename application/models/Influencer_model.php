<?php
class Influencer_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_influencer()
  {
       $query = $this->db->get('influencer');
       return $query->result_array();
  }
}