<?php
class Publisher_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_publisher($id =null)
  {     
      if (isset($id))
       $query = $this->db->get_where('publisher',array('id'=>$id));
       else
       $query = $this->db->get('publisher');
       return $query->result_array();
  }
} 