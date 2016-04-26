<?php

           
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/6/16
 * Time: 4:00 AM
 */
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Influencer_model');
        $this->load->model('Publisher_model');
        $this->load->model('Domain_model');
        $this->load->model('Admin_model');
        $this->load->model('Viral_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');                     
        $this->load->library('CI_input');
         $this->load->library('opengraph');
         $this->load->library('breadcrumbs');
          $this->load->library('user');
          $this->load->helper('date');
       
           
    }

    public function show($a, $b, $c){
        echo "show" . $a . " " . $b. " " .$c;
    }
    
    
    public function viral($id=null)
    {
        if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
             $data = array();
      
    
        
        $data = $this->user->add_user_data_ad('admin');
        $data['content'] = $this->admin_viral($id);
        $data['active'] ='viral';
         $data['notification_links']=$this->notification();
        $data['header']='Viral List';
   
    
        $this->load->view('admin/index',$data);
    }
    
    public function dom($allcheck,$id=null)
    {   
        $data = array();
        $data = $this->user->add_user_data_ad('admin');
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
            
            
         $data['notification_links']=$this->notification();    
        $data['content'] = $this->admin_domain($allcheck,$id);
        $data['active'] ='dom';
        $data['header']='Domains List';
        
        $this->load->view('admin/index',$data);
    }
    public function pub()
    {
         $data = array();
        $data = $this->user->add_user_data_ad('admin');
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
          $data['content'] = $this->admin_publisher();
          $data['active'] ='pub';
           $data['notification_links']=$this->notification();
          $data['header']='Publishers List';
          $this->load->view('admin/index',$data);
    }
    
    public function inf()
    {
             $data = array();
        $data = $this->user->add_user_data_ad('admin');
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $data['content'] = $this->admin_influencer();
         $data['active'] ='inf';
          $data['notification_links']=$this->notification();
         $data['header']='Influencer List';
         $this->load->view('admin/index',$data);
    }
    
    public function inf_detail($id)
    {    $data = array();
        $data = $this->user->add_user_data_ad('admin');
          if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $data['content'] = $this->admin_influencer_detail($id);
         $data['active'] ='inf';
          $data['notification_links']=$this->notification();
         $data['header']='Influencer\'s details';
         $this->load->view('admin/index',$data);
    }
    
    
    public function index( $content = null,$id=null)
    {
         $data = array();
        $data = $this->user->add_user_data_ad('admin');
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
        //echo "hello";
        $this->load->helper('url');
        $data['notification_links']=$this->notification();
        $data['active'] ='';
        $this->load->view('admin/index',$data);
    }
    
    private function admin_influencer()
    {   
         if(!(is_null($this->input->post('search'))))
       $data['influencer'] =$this->search();
       else
        $data['influencer'] = $this->Influencer_model->get_influencer();
        $string = $this->load->view('admin/template/inf', $data, TRUE);
        return $string;
        
    }
    private function admin_publisher()
    {   
         if(!(is_null($this->input->post('search'))))
       $data['publisher'] =$this->search();
       else
        $data['publisher'] = $this->Publisher_model->get_publisher();
        $string = $this->load->view('admin/template/pub', $data, TRUE);
        return $string;
        
    }
    
      private function admin_domain($allcheck,$id_pub)
    {   
        if (!isset($id_pub))
        {
        $data['domain'] = $this->Domain_model->get_domain();
        $data['publisher'] = $this->Publisher_model->get_publisher();
        }
        else
        {
        $data['domain'] = $this->Domain_model->get_domain_id($id_pub);
        $data['publisher'] = $this->Publisher_model->get_publisher($id_pub);
        $data['publishers'] = $this->Publisher_model->get_publisher();
        }
        $data['all'] =$allcheck;
        $string = $this->load->view('admin/template/dom', $data, TRUE);
        return $string;
        
    }
    
    public function ban($id,$unban = null)
    {
         $this->Influencer_model->ban_influencer($id,$unban);
        //  $data['content'] = $this->admin_influencer();
          $this->inf();
    }
    
         private function admin_viral($id =null)
    {
        $data['viral'] = $this->Viral_model->get_viral($id);
        $string = $this->load->view('admin/template/viral', $data, TRUE);
        return $string;
        
    }
    
        public function editviral()
        {
            
            $this->Viral_model->edit_viral();
            $this->viral();
        }
        
     public function addviral()
    {
/////////////////////////////adding meta in database/////////////////////
$trimmed=trim($this->input->post('url'));
$graph = $this->opengraph->fetch(trim($this->input->post('url')));

 foreach ($graph as $key => $value ) {
   $meta[$key] =$value;
 }
///////////////////////////////////////////////////////////////   
    
            $this->Viral_model->add_viral($meta);
        //  $data['content'] = $this->admin_influencer();
          $this->viral();
    }  
         
        
        
     public function delviral($id)
    {   
        if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $data = array();
        $data = $this->user->add_user_data_ad('admin');
         $this->Viral_model->del_viral($id);
        //  $data['content'] = $this->admin_influencer();
          $this->viral();
    }  
    public function admin_viral_edit($id){
        
        $data['viral'] = $this->Viral_model->get_viral();
        $data['editviral'] = $this->Viral_model->get_viral($id);
        $data["editmode"] = true;
        $data['active'] ='viral';
        $string = $this->load->view('admin/template/viral', $data, TRUE);
        return $string;
    }
    public function viraledit($id=null)
    {   
         $data = array();
        $data = $this->user->add_user_data_ad('admin');
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
        $data['content'] = $this->admin_viral_edit($id);
        $data['active'] ='viral';
        $data['notification_links']=$this->notification();
        $data['header']='Viral Edit';
        $this->load->view('admin/index',$data);
    }
    
    public function admin_domain_edit($all=null,$id,$id_pub=null,$e=null){
       if (!isset($id_pub))
        {
        $data['domain'] = $this->Domain_model->get_domain();
        $data['publisher'] = $this->Publisher_model->get_publisher();
        }
        else if(isset($e))
        {
        $data['domain'] = $this->Domain_model->get_domain();
        $data['publisher'] = $this->Publisher_model->get_publisher($id_pub);
        }
        else
        {
        $data['domain'] = $this->Domain_model->get_domain_id($id_pub);
        $data['publisher'] = $this->Publisher_model->get_publisher($id_pub);
        }
        $data['editdomain'] = $this->Domain_model->get_domain($id);
        $data["editmode"] = true;
        $data['active'] ='dom';
        $data['all'] =$all;
        $string = $this->load->view('admin/template/dom', $data, TRUE);
        return $string;
    }
    public function domainedit($all=null,$id=null,$id_pub=null,$e=null)
    {   
        
       if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $data = array();
        $data = $this->user->add_user_data_ad('admin');
        $data['content'] = $this->admin_domain_edit($all,$id,$id_pub,$e);
        $data['active'] ='dom';
        $data['notification_links']=$this->notification();
        $data['header']='Domains List';
       // $data['all'] =$all;
        $this->load->view('admin/index',$data);
    }
    
        public function editdomain($all=null)
        {
            
           // $this->domainformsubit("edit");
            //$this->dom($this->input->post('all'),$this->input->post('publisher_id'));
            if($this->input->post('all') == 'all')
          $this->dom($this->input->post('all'));
          else
              $this->dom($this->input->post('all'),$this->input->post('publisher_id'));
        }
        
     public function adddomain()
    {   
        
     //  $this->domainformsubit("add");
        if($this->input->post('all') == 'all')
          $this->dom($this->input->post('all'));
          else
              $this->dom($this->input->post('all'),$this->input->post('publisher_id'));
    }  
         
        
        
     public function deldomain($all=null,$id,$pub_id=null)
    {   
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $this->Domain_model->del_domain($id);
        //  $data['content'] = $this->admin_influencer();
          $this->dom($all,$pub_id);
    }  
    
      public function del_inf($id)
    {   
         if (!$this->user->is_loggedad_in())
            redirect('/registeradmin');
         $this->Influencer_model->del_inf($id);
        //  $data['content'] = $this->admin_influencer();
          $this->inf();
    }  
    
      private function admin_influencer_detail($id)
    {
        $data['influencer'] = $this->Influencer_model->get_influencer($id);
        $string = $this->load->view('admin/template/inf_detail', $data, TRUE);
        return $string;
        
    }
    
      public function payment_clear($id)
      {
          $this->Influencer_model->payment_clear($id);
          $this->inf_detail($id);
      }
      
      public function domainformsubit($type)
      {      if($type === "add")
           $this->form_validation->set_rules('priority', 'Priority', 'required|is_unique[domain.priority]');
           else
            $this->form_validation->set_rules('priority', 'Priority', 'required');
          if ($this->form_validation->run() === FALSE)
                {
                     
                     if($this->input->post('all') == 'all') 
                        {  
                           
                                $this->dom($this->input->post('all'));
                           
                        }
                     else
                        {
                                 $this->dom($this->input->post('all'),$this->input->post('publisher_id'));
                        
                        }
                          
                      
                }
          else 
          {
            if($type === "add")
                {
                 $this->Domain_model->add_domain();
                 $this->adddomain();
                }
            else
                {
                    $this->Domain_model->edit_domain();
                    $this->editdomain();
                }
                 
          }
           
            
      }
      
      public function test()
      {
          $graph = $this->opengraph->fetch('http://techcrunch.com/2016/02/20/japan-launches-observatory-to-study-black-holes-and-dying-stars/');
        
            //var_dump($graph->keys());
            //  var_dump($graph);

           //    echo "<pre>";print_r($graph);echo "</pre>";
               foreach ($graph as $key => $value ) {
    //  echo "$key => $value";
 // $meta=  get_object_vars($key);
 $meta[$key] =$value;
 
     //print_r($value);
        }
      
        echo "<pre>";print_r($meta);echo "</pre>";
       // echo $graph=>_values["site_name"];
      }
      
       public function profile($error=null){
         
          if (!$this->user->is_loggedad_in()){
            redirect('/adminlogin');
        }
        $data = array();
         $data = $this->user->add_user_data_ad('admin');
         $data['content'] = $this->inf_profile($error);
         $data['active'] ='';
         $data['header']='Profile';
         $data['notification_links']=$this->notification();
         $this->load->view('admin/index',$data);
         
     }
        private function inf_profile($error=null)
        {
                $id = $this->session->userdata('user_id_ad');
                $data['error']=$error;
                $data['profile'] = $this->Admin_model->get_admin($id);
                $string = $this->load->view('admin/profile', $data, TRUE);
                return $string;
        
        
        }
        
      public function submitprofile()
      {  
                  $this->load->helper('url');
                      $id = $this->session->userdata('user_id_ad');
                      
                      if(!is_null($this->input->post('password'))){
                           $this->form_validation->set_rules('password', 'Password', 'trim');
                            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|min_length[8]|max_length[12]|matches[password]');
                            
                          if($this->form_validation->run() == FALSE)
                          {
                             
                            $this->profile($error);
                            
                          }else{
                          
                          $data = array(
                        
                        'name' => $this->input->post('name'),
                        'country' => $this->input->post('country'),
                         'email' => $this->input->post('email'),
                         'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'city' => $this->input->post('city')
                      
                        
                    );  
                        $this->db->where('id',$id);
                        $query=  $this->db->update('admin',$data);
                        if($query)
                        {
                            $this->session->set_flashdata('message', 'You have been successfully update your profile');
                            
                            redirect('/admin/profile');
                        }
                        else 
                        {
                        $this->session->set_flashdata('message', 'Error try again');
                    
                        redirect('/admin/profile');
                        }
                          
                      }
                      }else{
                    $data = array(
                        
                        'name' => $this->input->post('name'),
                        'country' => $this->input->post('country'),
                         'email' => $this->input->post('email'),
                        'city' => $this->input->post('city')
                      
                        
                    );  
                        $this->db->where('id',$id);
                        $query=  $this->db->update('admin',$data);
                        if($query)
                        {
                            $this->session->set_flashdata('message', 'You have been successfully update your profile');
                            
                            redirect('/admin/profile');
                        }
                        else 
                        {
                        $this->session->set_flashdata('message', 'Error try again');
                    
                        redirect('/admin/profile');
                        }
                      }
      
      }
      
      
        public function search()
        {
            $search=  $this->input->post('search');
            
            if($this->input->post('page') == 'inf')
              return  $query = $this->Influencer_model->search($search);
             else if ($this->input->post('page') == 'pub') 
              return  $query = $this->Publisher_model->search($search);  
            else
              return  "Invalid Entry/Search not available";
		 
		     
        }
        
        public function checkout($start_date = null, $end_date = null){
        if (!$this->user->is_loggedad_in()){
            redirect('/registeradmin');
        }
        $data = array();
        $data = $this->user->add_user_data_ad('admin');
        
        $data['content'] = $this->load_checkout($start_date,$end_date);
        $data['notification_links']=$this->notification();
        $data['header']='Payment Log';
        $data['active'] ='checkout';


        $this->load->view('admin/index',$data);
    }

    private function load_checkout($start_date,$end_date){
       
        $this->db->order_by('checkout.timestamp_checkout', 'DESC');
        if ($start_date != null && $end_date != null){
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $this->db->where('checkout.timestamp_checkout >=', $start_date);
            $this->db->where('checkout.timestamp_checkout <=', $end_date);
        }
        $this->db->join('influencer', 'influencer.id = checkout.inf_id');
        $result = $this->db->get_where('checkout');
        $data['rows'] = $result->result();
       
        return $this->load->view('admin/template/payment_history', $data, TRUE);
    }
     public function notification(){
              
             return   $this->Influencer_model->checktoday();           
              
          }
          
          
 ///////////////////////////// ALL EARNING HISTOry OF INFLUENCER/////////////////////////////////////         
           
          
       
          public function earning_history($start_date = null, $end_date = null){
        if (!$this->user->is_loggedad_in()){
              redirect('/registeradmin');
        }
        $data = array();
       $data = $this->user->add_user_data_ad('admin');
        if(!(is_null($this->input->post('search'))))
            $data['content'] =$this->search();

        $data['content'] = $this->load_earning_history($start_date,$end_date);
        $data['notification_links']=$this->notification();
        $data['header']='Earnings of all Influencers';
        $data['active'] ='earning_history';


        $this->load->view('admin/index',$data);
    }

    private function clean($value){
        $value = round($value,2);
        $value = ($value > 0) ? $value : '0';
        return $value;
    }

   /* private function getTotal($prop, $start_date, $end_date){
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
    }*/

    private function getTotalPayment($start_date, $end_date){
        if ($start_date != null && $end_date != null){
            $this->db->where('timestamp_checkout >=', $start_date);
            $this->db->where('timestamp_checkout <=', $end_date);
        }
        $this->db->select_sum('payment_checkout');
      //  $userid = $this->session->userdata('user_id');
        $userid = 51;
        $payment_given = $this->db->get_where('checkout',array('inf_id' => $userid))->row()->payment_checkout;
        return $payment_given;

    }
    private function load_earning_history($start_date,$end_date){
       //  $userid = $this->session->userdata('user_id');
        $userid = 51;
       // $this->db->order_by('date', 'DESC');
        if ($start_date != null && $end_date != null){
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
         
          $query=  $this->db->query('SELECT `inf`.`name`,`inf`.`utm`,`rh`.`influencer_id` ,sum(`rh`.`revenue_generated`) revenue_generated,`chk`.`payment_checkout` FROM `revenue_history` rh

left join `influencer` as inf 

on `rh`.`influencer_id` = `inf`.`id`
left join `checkout` as chk
on `chk`.`inf_id` = `rh`.`influencer_id`

            where `rh`.`date` >= \''.$start_date.'\' and  `rh`.`date` <= \''.$end_date.'\' 
group by `rh`.`influencer_id`');
        
        }
       
       else{
      

  
      $query=  $this->db->query('SELECT `inf`.`name`,`inf`.`utm`,`rh`.`influencer_id` ,sum(`rh`.`revenue_generated`) as revenue_generated,`chk`.`payment_checkout` FROM `revenue_history` rh

left join `influencer` as inf 

on `rh`.`influencer_id` = `inf`.`id`
left join `checkout` as chk
on `chk`.`inf_id` = `rh`.`influencer_id`


            
group by `rh`.`influencer_id`,`inf`.`name`,`inf`.`utm`');
       }
       
       
       
         
        
     
         $data['rows'] = $query->result();
         for($i=0;$i<sizeof($data['rows']);$i++)
               {
           
       $total_earning = $query->row($i)->revenue_generated;
        $payment_checkedout=$query->row($i)->payment_checkout;
       
       
          $payment_left= $total_earning-$payment_checkedout;           
        $data['rows'][$i]->payment_left=$this->clean($payment_left);
                 }
      
     //   var_dump( $data['rows']);
      //  die();
        //Get total premium
      //  $total_premium = $this->getTotal('premium_visit', $start_date, $end_date);
        //Get total normal
      //  $total_normal = $this->getTotal('normal_visit', $start_date, $end_date);
        //Get total revenue
       // $total_revenue = $this->getTotal('revenue_generated', $start_date, $end_date);
        //Payment left
      //  $payment_checkedout = $this->db->get_where('checkout',array('inf_id' => $userid))->row()->payment_checkout;
        
       //    $payment_left= $total_earning-$payment_checkedout;
            


     //   $payment_given = $this->getTotalPayment($start_date, $end_date);
$payment_given = $this->getTotalPayment($start_date, $end_date);
        $data['payment_left'] = $this->clean($payment_left);
        $data['payment_given'] = $this->clean($payment_given);
        //$data['total_premium'] = $total_premium;
       // $data['total_normal'] = $total_normal;
      //  $data['total_revenue'] = $total_revenue;
        return $this->load->view('admin/template/earning_history', $data, TRUE);
    }
       
          
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////        
          
          
          
          
}