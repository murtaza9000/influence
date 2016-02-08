<?php
class Domain_model extends CI_Model
 {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
  public function get_domain($id = null)
  {
      if (isset($id))
       $query = $this->db->get_where('domain',array('id'=>$id));
       else
       $query = $this->db->get('domain');
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
                'id' => $this->input->post('id'),
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'publisher_id'=>$this->input->post('publisher_id')
                 );
     $this->db->replace('domain',$data);
      
  }
  
   public function add_domain()
  {     
      $data = array(
                'url' => $this->input->post('url'),
                'click_rate'=>$this->input->post('click_rate'),
                'publisher_id'=>$this->input->post('publisher_id')
                 );
     $this->db->insert('domain',$data);
      
  }
  
   public function del_domain($id)
   {
                                     
                return $this->db->delete('domain', array('id' => $id));
   }  
}