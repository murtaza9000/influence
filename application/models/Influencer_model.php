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
  
   public function ban_influencer($id,$unban = null)
  {
      if(isset($unban))
      {
          $this->db->set('ban', '0');
          $this->db->where('id', $id);
          $this->db->update('influencer');
      }
      else
      {            
          $this->db->set('ban', '1');
          $this->db->where('id', $id);
          $this->db->update('influencer');
      }
  }
}