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
  
    public function search($search)
    {
        
         
         $this->db->like('id', $search);
        $this->db->or_like('name', $search); 
       
          $query =$this->db->get('publisher');
        return $query->result_array();
    }
} 