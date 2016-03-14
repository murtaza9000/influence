<?php
class Influencer_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_influencer($id =null)
  {
       if (isset($id))
       $query = $this->db->get_where('influencer',array('id'=>$id));
       else
       {
         
       $query = $this->db->get('influencer');
       }
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
      public function payment_clear($id)
      {
          $this->db->set('payment', '0');
          $this->db->where('id', $id);
          $this->db->update('influencer');
      }
   public function del_inf($id)
   {
                       //  $this->Rss_model->del_rss($id);            
                return $this->db->delete('influencer', array('id' => $id));
                
   }  
   
    public function search($search)
    {
        
         
         $this->db->like('id', $search);
        $this->db->or_like('name', $search); 
       
          $query =$this->db->get('influencer');
        return $query->result_array();
    }
}