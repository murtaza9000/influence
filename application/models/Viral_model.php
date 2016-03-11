<?php
class Viral_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_viral($id = null)
  {
      if (is_null($id))
       $query = $this->db->get('viral_links');
       else
        $query = $this->db->get_where('viral_links',array('id'=>$id));
       return $query->result_array();
  }
  
   public function add_viral($meta)
  {     
      $data = array(
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'click_ratepre'=>$this->input->post('click_ratepre'),           
                'site_name'=>( isset($meta['site_name']) ? $meta['site_name'] : null),
                'title'=>( isset($meta['title']) ? $meta['title'] : null),
                'description'=>( isset($meta['description']) ? $meta['description'] : null),
                'image'=>$meta['image']
                 );
     $this->db->insert('viral_links',$data);
      
  }
  
   public function del_viral($id)
   {
                                     
                return $this->db->delete('viral_links', array('id' => $id));
   }  
   
    public function edit_viral()
  {     
      $data = array(
                'id' => $this->input->post('id'),
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'click_ratepre'=>$this->input->post('click_ratepre')
                 );
     $this->db->replace('viral_links',$data);
      
  }
  
    public function search($search)
    {
        
         
         $this->db->like('url', $search);
        $this->db->or_like('site_name', $search); 
       $this->db->or_like('title', $search);
          $query =$this->db->get('viral_links');
       return $query->result_array();
    }
}
