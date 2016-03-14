<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/13/16
 * Time: 9:40 PM
 */
class Influencer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('rssparser');
        $this->load->library('user');
        $this->load->model('Rss_model');
        $this->load->model('Domain_model');
        $this->load->model('Influencer_model');
        $this->load->model('Viral_model');
        $this->load->library('opengraph');
             $this->load->helper('url');
             $this->load->library('breadcrumbs');
                  
    }

    public function index(){
        if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
        $data = $this->user->add_user_data('influencer');
         if(!(is_null($this->input->post('search'))))
             $data['content'] =$this->search();
       $data['header']=' ';
        $data['active'] ='';
        $this->load->view('influencer/index',$data);
    }
    
    public function rss_done(){
            // $this->Rss_model->del_rss();
          $data=$this->Domain_model->get_rss();
       //  $data=$this->Rss_model->get_influencer();
            $num =0; 
    
         foreach($data as $values)
      
       {  
           
           echo $values['url'];
       echo "<br>";
       
     //  urlencode(trim($values['url']))
        $this->rssparser->set_feed_url(urldecode(trim($values['url'])));  // get feed
      
      //  $this->rssparser->set_feed_url('http://buzztache.com/feed/');
        $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
        $rss = $this->rssparser->getFeed(25);
         echo "<pre>";
    //   print_r($rss);
        echo "</pre>";
         foreach($rss as $rs)
            { 
              if($this->rss_duplicate_check($rs)=="dup")
              echo "duplicate entry not added: ".$rs['link'];
              else{
        echo $rs['link'];
          $this->Rss_model->add_rss($rs,$values['id']);
           $num++;
              }
           echo "<br>";
         
            }
    
       }
       
       
       $data['num']=$num;
       $this->load->view('influencer/template/rss_service',$data);
    }
     public function rssstart()
            {  ?>
         
                    <script>

                    var _confirm = confirm("Proceed?")
                    if (_confirm){
                    window.location = "<?php echo base_url('influencer/rss_done') ;?>"                
                    }
                    </script>
 <?php           }
 
  public function inf($offset=0)
  
    {     
          if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
         $data = $this->user->add_user_data('influencer');
         $data['content'] = $this->inf_influencer($offset);
         $data['active'] ='inf';
         $data['header']='Latest Link';
         $this->load->view('influencer/latest',$data);
    }
    
      private function inf_influencer()
    {       
      if(!(is_null($this->input->post('search')))){
          
            $data['rss'] =$this->search();
             for($i=0;$i<sizeof($data['rss']);$i++)
               {
                    $data['rss'][$i]['copied'] = $this->isLinkCopied( $data['rss'][$i]['links'], $this->session->userdata('user_id'));
               }
          
            
      }
       else
       
               $data['rss'] = $this->Rss_model->get_influencer_lim(10,0);
              for($i=0;$i<sizeof($data['rss']);$i++)
               {
                    $data['rss'][$i]['copied'] = $this->isLinkCopied( $data['rss'][$i]['links'], $this->session->userdata('user_id'));
               }
               
            
              $string = $this->load->view('influencer/template/inf', $data, TRUE);
              return $string;
                   
        
    }
    public function isLinkCopied($link,$inf_id,$page=null){
        if($page=='viral'){ 
               $query=   $this->db->get_where('viralcopy', 
                  array('inf_id' => $this->session->userdata('user_id'), 'link' => $link));
        }else{
            $query=   $this->db->get_where('linkcopy', 
                  array('inf_id' => $this->session->userdata('user_id'), 'link' => $link));
        }
              if ($query->num_rows() > 0)
                {
                     $row =$query->row_array();
                     return $row['link'];
                }
              return "copied";
             }
    
    public function inf_ajax($offset){
         if((is_null($this->input->post('search'))))
       if( $this->Rss_model->get_influencer_lim(10,$offset))
       {
         
        $data['rss'] = $this->Rss_model->get_influencer_lim(10,$offset);
         for($i=0;$i<sizeof($data['rss']);$i++)
               {
                    $data['rss'][$i]['copied'] = $this->isLinkCopied( $data['rss'][$i]['links'], $this->session->userdata('user_id'));
               }
        
         $this->load->view('influencer/template/inf', $data);
       }
          
       else 
       {
           echo "end";
        }
    }
      
      public function viral($id=null)
    {   
          if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
          $data = array();
         $data = $this->user->add_user_data('influencer');
        $data['content'] = $this->influencer_viral($id);
        $data['active'] ='viral';
         $data['header']='Viral Link';
        $this->load->view('influencer/index',$data);
    }
  
    private function influencer_viral($id =null)
    {
        if(!(is_null($this->input->post('search')))){
         $infid = $this->session->userdata('user_id');  
        $data['influencer'] = $this->Influencer_model->get_influencer($infid); 
       $data['viral'] =$this->search();
       for($i=0;$i<sizeof($data['viral']);$i++)
               {
                    $data['viral'][$i]['copied'] = $this->isLinkCopied( $data['viral'][$i]['id'], $this->session->userdata('user_id'),$page);
               }
        }
   else{
       $infid = $this->session->userdata('user_id');
        $data['viral'] = $this->Viral_model->get_viral($id);
         $data['influencer'] = $this->Influencer_model->get_influencer($infid); 
          for($i=0;$i<sizeof($data['viral']);$i++)
               {
                    $data['viral'][$i]['copied'] = $this->isLinkCopied( $data['viral'][$i]['id'], $this->session->userdata('user_id'),'viral');
               }
   }
        $string = $this->load->view('influencer/template/viral', $data, TRUE);
        return $string;
        
    }
    
    public function search()
        {
            $search=  $this->input->post('search');
            
            if($this->input->post('page') == 'inf')
              return  $query = $this->Rss_model->search($search);
            else if ($this->input->post('page') == 'viral') 
              return  $query = $this->Viral_model->search($search);
            
            else if ($this->input->post('page') == 'inf') 
              return  $query = $this->Rss_model->search($search);
              else
              return  "Invalid Entry";
		 
		     
        }
        
     public function profile(){
         
          if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
         $data = $this->user->add_user_data('influencer');
         $data['content'] = $this->inf_profile();
         $data['active'] ='inf';
          $data['header']='Profile';
         $this->load->view('influencer/index',$data);
         
     }
        private function inf_profile()
        {
                $id = $this->session->userdata('user_id');
                $data['profile'] = $this->Influencer_model->get_influencer($id);
                $string = $this->load->view('influencer/profile', $data, TRUE);
                return $string;
        
        
        }
        
      public function submitprofile()
      {  
                  $this->load->helper('url');
                      $id = $this->session->userdata('user_id');
                    $data = array(
                        
                        'name' => $this->input->post('name'),
                        'country' => $this->input->post('country'),
                        'city' => $this->input->post('city'),
                        'contact' => $this->input->post('phone'),
                        'experience' => $this->input->post('experience'),
                        'account_no' => $this->input->post('account_no')
                    );  
                        $this->db->where('id',$id);
                        $query=  $this->db->update('influencer',$data);
                        if($query)
                        {
                            $this->session->set_flashdata('message', 'You have been successfully update your profile');
                            
                            redirect('/influencer/profile');
                        }
                        else 
                        {
                        $this->session->set_flashdata('message', 'Error try again');
                    
                        redirect('/influencer/profile');
                        }
      
      
      }
      
      
      
      public function rss_duplicate_check($rss){
      
         $data=$this->Rss_model->get_influencer();
            
        $db=array();
         for($i=0;$i<sizeof($data) ;$i++)
      
       {  
           
           $db[$i]= $data[$i]['links'];
           
       }
  
    for($i=0;$i<sizeof($db) ;$i++)
                   {
                    if($db[$i]==$rss['link'])
                                {
                                    return "dup";
                                    
                                }
                     }  
          }

     public function    copy(){
    
    
    
    
}
        public function docopy($page){
          if($page=='viral'){   
             $data = array(
                'link' => $this->input->post('id'),
               'inf_id' => $this->session->userdata('user_id'),
               'flag' => $this->input->post('flag')

                 );
    
    $this->db->insert('viralcopy',$data);
    
    redirect('influencer/viral');
          }else{
               $data = array(
                'link' => $this->input->post('link'),
               'inf_id' => $this->session->userdata('user_id'),
               'flag' => $this->input->post('flag')

                 );
    
    $this->db->insert('linkcopy',$data);
    redirect('influencer/inf');
        }
        }
         public function contact(){
         
          if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
         $data = $this->user->add_user_data('influencer');
         $data['content'] = $this->inf_contact();
         $data['active'] ='contact';
          $data['header']='Contact us';
         $this->load->view('influencer/index',$data);
         
     }
        private function inf_contact()
        {
                $id = $this->session->userdata('user_id');
                $data['contact'] = $this->Influencer_model->get_influencer($id);
                $data['title']='Contact us form';
                $string = $this->load->view('influencer/contact', $data, TRUE);
                return $string;
        
        
        }
        
      public function sendcontact()
      {  
                  
                  
                       
                        
                         $this->load->library('email');
                        $config['mailtype'] = 'html';
                        
                //  $config['smtp_host'] = 'ssl://smtp.acquire.social';
                    //$config['smtp_port'] = 465;
                    //$config['smtp_user'] = 'emailaddress';
                    //$config['smtp_pass'] = 'xxx';
                
                        $this->email->initialize($config);
                       
                        $this->email->from('no-reply@acquire.social','Acquire');
                        
                        $this->email->to('no-reply@acquire.social');
                
                        $this->email->subject($this->input->post('subject'));
                        
                        $email_body = $this->input->post('message');
                        $this->email->message($email_body);

                     
                     if ( $this->email->send()){
            $this->session->set_flashdata('message', 'Your message is send ');
            redirect('influencer/contact');
                     }else{
                          $this->session->set_flashdata('message', 'Your message is not send ');
            redirect('influencer/contact');
                     }
                     
      
      }




}








