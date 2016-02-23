<?php
class Domain_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
                $this->load->model('Rss_model');
        }
        
        
        
  public function get_domain($id = null)
  {
      if (isset($id))
      {
      $this->db->distinct();
       $query = $this->db->get_where('domain',array('id'=>$id));
      }
       else{
           
           $this->db->distinct();
       $query = $this->db->get('domain'); 
       
       }
      
       return $query->result_array();
  }
  
   public function get_domain_id($id = null)
  {
      if (isset($id))
       $query = $this->db->get_where('domain',array('publisher_id'=>$id));
       else
       $query = $this->db->get('domain');
       return $query->result_array();
  }
  
      public function edit_domain()
  {     
      $data = array(
                
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'click_ratepre'=>$this->input->post('click_ratepre'),
                'priority'=>$this->input->post('priority'),
                'publisher_id'=>$this->input->post('publisher_id')
                 );
     $this->db->where('id',$this->input->post('id'));
     $this->db->update('domain',$data);
      
  }
  
   public function add_domain()
  {     
      $data = array(
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'click_ratepre'=>$this->input->post('click_ratepre'),
                'publisher_id'=>$this->input->post('publisher_id'),
                'priority'=>$this->input->post('priority')
                 );
              
     $this->db->insert('domain',$data);
      
  }
  
   public function del_domain($id)
   {
                       //  $this->Rss_model->del_rss($id);            
                return $this->db->delete('domain', array('id' => $id));
                
   }  
   
   public function get_rss($id =null)
  {
       if (isset($id))
       $query = $this->db->get_where('domain',array('id'=>$id));
       else
       $query = $this->db->get('domain');
        return  $query->result_array();
       
      /* for($i=1 ; $i<=$total;$i++)
       {
           $row=$query->row($i);
           $link['url'][$i] =$row->url;
           $link['domain_id'][$i] =$row->id;
       }
       return $link;*/
  }
}