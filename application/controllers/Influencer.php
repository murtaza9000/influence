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
        $this->load->library('breadcrumbs');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->library('scrape');
        $this->load->library('form_validation');
                  
    }

    public function index(){
        if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        
         $this->utmvalid();
          if ($this->form_validation->run() == FALSE)
            {          
                $data = array();
                $data = $this->user->add_user_data('influencer');
                if(!(is_null($this->input->post('search'))))
                    $data['content'] =$this->search();
                $data['header']='Earnings Details';
                $data['active'] ='';
                $data['notification_links']=$this->notification();
                               
               //              var_dump(  $data['notfication_links']);
              //  die();
            
                $data['utm'] = $this->isutm();
                $this->load->view('influencer/index',$data);
             }
         else{    
                $this->db->where('id',$this->session->userdata('user_id'));
                $this->db->update('influencer',array('utm'=>$this->input->post('utm')));
                $data = array();
                $data = $this->user->add_user_data('influencer');
                if(!(is_null($this->input->post('search'))))
                    $data['content'] =$this->search();
                $data['header']='Earnings Details';
                $data['active'] ='';
                $data['notification_links']=$this->notification();
                $data['utm'] = $this->isutm();
                
                $this->load->view('influencer/index',$data);
         }
    }
        
        public function isutm(){
             $userid = $this->session->userdata('user_id');
             $this->db->where('id',$userid);
            
           $query= $this->db->get('influencer');
           $row= $query->row();
           
            $row->utm;
            
            if($row->utm==null)
                return false;
             else
                return true;
        }
        
        
    public function payment_history($start_date = null, $end_date = null){
        if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
        $data = $this->user->add_user_data('influencer');
        if(!(is_null($this->input->post('search'))))
            $data['content'] =$this->search();

        $data['content'] = $this->load_payment_history($start_date,$end_date);
        $data['notification_links']=$this->notification();
        $data['header']='Earnings';
        $data['active'] ='payment_history';


        $this->load->view('influencer/index',$data);
    }

    private function clean($value){
        $value = round($value,2);
        $value = ($value > 0) ? $value : '0';
        return $value;
    }

    private function getTotal($prop, $start_date, $end_date){
        if ($start_date != null && $end_date != null){
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        $this->db->select_sum($prop);
        $userid = $this->session->userdata('user_id');
        $value = $this->db->get_where('revenue_history',array('influencer_id' => $userid))->row_array()[$prop];
        return $this->clean($value);
    }

    private function getTotalPayment($start_date, $end_date){
        if ($start_date != null && $end_date != null){
            $this->db->where('timestamp_checkout >=', $start_date);
            $this->db->where('timestamp_checkout <=', $end_date);
        }
        $this->db->select_sum('payment_checkout');
        $userid = $this->session->userdata('user_id');
        $payment_given = $this->db->get_where('checkout',array('inf_id' => $userid))->row()->payment_checkout;
        return $payment_given;

    }
    private function load_payment_history($start_date,$end_date){
        $userid = $this->session->userdata('user_id');
        $this->db->order_by('date', 'DESC');
        if ($start_date != null && $end_date != null){
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        $result = $this->db->get_where('revenue_history',array('influencer_id' => $userid));

        $data['rows'] = $result->result();

        //Get total premium
        $total_premium = $this->getTotal('premium_visit', $start_date, $end_date);
        //Get total normal
        $total_normal = $this->getTotal('normal_visit', $start_date, $end_date);
        //Get total revenue
        $total_revenue = $this->getTotal('revenue_generated', $start_date, $end_date);
        //Payment left
        $payment_left = $this->db->get_where('influencer',array('id' => $userid))->row()->payment;

        $payment_given = $this->getTotalPayment($start_date, $end_date);

        $data['payment_left'] = $this->clean($payment_left);
        $data['payment_given'] = $this->clean($payment_given);
        $data['total_premium'] = $total_premium;
        $data['total_normal'] = $total_normal;
        $data['total_revenue'] = $total_revenue;
        return $this->load->view('influencer/template/payment_history', $data, TRUE);
    }

    public function rss_done(){
        // $this->Rss_model->del_rss();
        $data=$this->Domain_model->get_rss();
        //$data=$this->Rss_model->get_influencer();
        $num =0;

        foreach($data as $values) {
            echo $values['url'];
            echo "<br>";

            //urlencode(trim($values['url']))
            $rss = [];
            if (urldecode(trim($values['url'])) == 'buzztache.com') {
               
                $rss = $this->scrape->execute();

            } else {
                $this->rssparser->set_feed_url(urldecode(trim($values['url'])));  // get feed

                //$this->rssparser->set_feed_url('http://buzztache.com/feed/');

                $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
                $rss = $this->rssparser->getFeed(25);
            }
            echo "<pre>";
          //  print_r($rss);
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
         $data['notification_links']=$this->notification();
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
                     return "copied";
                }else
              return "nocopy";
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
         $data['notification_links']=$this->notification();
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
        
     public function profile($error=null){
         
          if (!$this->user->is_logged_in()){
            redirect('/landing');
        }
        $data = array();
         $data = $this->user->add_user_data('influencer');
         $data['content'] = $this->inf_profile($error);
         $data['active'] ='inf';
          $data['header']='Profile';
          $data['notification_links']=$this->notification();
         $this->load->view('influencer/index',$data);
         
     }
        private function inf_profile($error=null)
        {       
                $data['error']=$error;
                $id = $this->session->userdata('user_id');
                $data['profile'] = $this->Influencer_model->get_influencer($id);
                $string = $this->load->view('influencer/profile', $data, TRUE);
                return $string;
        
        
        }
        
      public function submitprofile()
      {  
                  $this->load->helper('url');
                      $id = $this->session->userdata('user_id');
                      
                     if(!is_null($this->input->post('password'))){ 
                      
                    $this->form_validation->set_rules('password', 'Password', 'trim');
                    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|min_length[8]|max_length[12]|matches[password]');
                      
                      
                      
                    $this->utmvalid();
                    
                  if ($this->form_validation->run() == FALSE) //if one
                      {
                       if(isset($error))  
                            $this->profile($error);
                        else
                            $this->profile();
                      }else{ 
         
                    $data = array(
                        
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'utm' => $this->input->post('utm'),
                        'country' => $this->input->post('country'),
                        'city' => $this->input->post('city'),
                        'contact' => $this->input->post('phone'),
                        'experience' => $this->input->post('experience'),
                        'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
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
                }//end if one
                    else{ //else one
                        
                         $this->utmvalid();
                    
                  if ($this->form_validation->run() == FALSE)
                      {
                       if(isset($error))  
                            $this->profile($error);
                        else
                            $this->profile();
                      }else{ 
         
                    $data = array(
                        
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'utm' => $this->input->post('utm'),
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
                    }//end else one
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
        public function docopy($page=null){
          if($page=='viral'){   
             $data = array(
                'link' => $this->input->post('id'),
                
               'inf_id' => $this->session->userdata('user_id'),
               'flag' => $this->input->post('flag')

                 );
    
    $query=$this->db->get_where('viralcopy',$data);
                 
              if($query->num_rows() > 0)
              {
                        echo "done";
              }else{
                         $this->db->insert('viralcopy',$data);
                         echo "done";
              }
    
  //  redirect('influencer/viral');
          }else{
               $data = array(
                'link' => $this->input->post('link'),
                'rss_id' => $this->input->post('id'),
               'inf_id' => $this->session->userdata('user_id'),
               'flag' => $this->input->post('flag')

                 );
                 $query=$this->db->get_where('linkcopy',$data);
                 
              if($query->num_rows() > 0)
              {
                        echo "done";
              }else{
                         $this->db->insert('linkcopy',$data);
                         echo "done";
              }
   
   
    //redirect('influencer/inf');
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
          $data['notification_links']=$this->notification();
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
                  
                   $id = $this->session->userdata('user_id');
                       
                   $data['full_name'] = $this->user->add_user_data('influencer');     
                         $this->load->library('email');
                        $config['mailtype'] = 'html';
                        
                //  $config['smtp_host'] = 'ssl://smtp.acquire.social';
                    //$config['smtp_port'] = 465;
                    //$config['smtp_user'] = 'emailaddress';
                    //$config['smtp_pass'] = 'xxx';
                      
                        $this->email->initialize($config);
                       
                        $this->email->from('no-reply@acquire.social','Acquire');
                        
                        $this->email->to('farrukh.zaf@gmail.com');
                
                        $this->email->subject("Query from".$data['full_name']." : ".$this->input->post('subject'));
                        
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
      
         public function checkout($start_date = null, $end_date = null){
        if (!$this->user->is_logged_in()){
            redirect('/register');
        }
        $data = array();
        $data = $this->user->add_user_data('influencer');
        
        $data['content'] = $this->load_checkout($start_date,$end_date);
        $data['notification_links']=$this->notification();
        $data['header']='Checkout';
        $data['active'] ='checkout';


        $this->load->view('influencer/index',$data);
    }

    private function load_checkout($start_date,$end_date){
         $userid = $this->session->userdata('user_id');
        $this->db->order_by('checkout.timestamp_checkout', 'DESC');
        if ($start_date != null && $end_date != null){
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $this->db->where('checkout.timestamp_checkout >=', $start_date);
            $this->db->where('checkout.timestamp_checkout <=', $end_date);
        }
        $this->db->join('influencer', 'influencer.id = checkout.inf_id');
         
        $result = $this->db->get_where('checkout',array('checkout.inf_id' => $userid));
        
        $data['rows'] = $result->result();
       
        return $this->load->view('influencer/template/payment_historyuser', $data, TRUE);
    }



    public function utmvalid(){
        
        
                     $this->load->library('form_validation');
                     
                     
                       $userid = $this->session->userdata('user_id');
                      $this->db->where('id',$userid);
            
                      $query= $this->db->get('influencer');
                         $row= $query->row();
                         if($row->utm == $this->input->post('utm'))
                         {
                              $this->form_validation->set_rules('utm', 'Username/UTM', 'trim|required|alpha_numeric');
                   
                         }else{
                        
                      $this->form_validation->set_rules('utm', 'Username/UTM', 'trim|required|alpha_numeric|is_unique[influencer.utm]',
                     array(
                'is_unique'     => 'This %s already exists.'
                     ));
                         }
          }

          public function notification(){
              
             return   $this->Rss_model->checktoday();           
              
          }
}








