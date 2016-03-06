<?php
class Admin_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_admin($id =null)
  {
       if (isset($id))
       $query = $this->db->get_where('admin',array('id'=>$id));
       else
       $query = $this->db->get('admin');
       return $query->result_array();
  }
  
    public function del_admin($id)
   {
                       //  $this->Rss_model->del_rss($id);            
                return $this->db->delete('admin', array('id' => $id));
                
   }  
}