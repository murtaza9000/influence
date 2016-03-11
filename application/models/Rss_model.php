<?php
class Rss_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_rss($id =null)
  {
       if (isset($id))
       $query = $this->db->get_where('rss_links',array('id'=>$id));
       else
       $query = $this->db->get('rss_links');
       return $query->num_rows();
  }
   public function add_rss($rss,$domain_id)
  {     
      
      $data = array(
                'links' => $rss['link'],
                'description' => $rss['description'],
                'domain_id'=>$domain_id
                
                 );
              
     $this->db->insert('rss_links',$data);
    
      
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
  
      public function del_rss()
   {
                                   
                return $this->db->empty_table('rss_links');
                
   } 
   
    public function get_influencer($id =null)
  {
       if (isset($id))
       $query = $this->db->get_where('rss_links_view',array('id'=>$id));
       else
       $query = $this->db->get('rss_links_view');
       return $query->result_array();
  }
  
   public function search($search)
    {
        
         
         $this->db->like('links', $search);
        $this->db->or_like('description', $search); 
      
          $query =$this->db->get('rss_links_view');
      return  $query->result_array();
    }
}