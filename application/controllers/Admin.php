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
        $this->load->model('Viral_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');                     
        $this->load->library('CI_input');
    }

    public function show($a, $b, $c){
        echo "show" . $a . " " . $b. " " .$c;
    }
    
    
    public function viral($id=null)
    {
        $data['content'] = $this->admin_viral($id);
        $data['active'] ='viral';
        $this->load->view('admin/index',$data);
    }
    
    public function dom($allcheck,$id=null)
    {
        $data['content'] = $this->admin_domain($allcheck,$id);
        $data['active'] ='dom';
        $this->load->view('admin/index',$data);
    }
    public function pub()
    {
          $data['content'] = $this->admin_publisher();
          $data['active'] ='pub';
          $this->load->view('admin/index',$data);
    }
    
    public function inf()
    {
         $data['content'] = $this->admin_influencer();
         $data['active'] ='inf';
         $this->load->view('admin/index',$data);
    }
    
    public function inf_detail($id)
    {
         $data['content'] = $this->admin_influencer_detail($id);
         $data['active'] ='inf';
         $this->load->view('admin/index',$data);
    }
    
    
    public function index( $content = null,$id=null)
    {
        //echo "hello";
        $this->load->helper('url');
        $data['content'] = "Test";
        $data['active'] ='';
        $this->load->view('admin/index',$data);
    }
    
    private function admin_influencer()
    {
        $data['influencer'] = $this->Influencer_model->get_influencer();
        $string = $this->load->view('admin/template/inf', $data, TRUE);
        return $string;
        
    }
    private function admin_publisher()
    {
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
         $this->Viral_model->add_viral();
        //  $data['content'] = $this->admin_influencer();
          $this->viral();
    }  
         
        
        
     public function delviral($id)
    {
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
        $data['content'] = $this->admin_viral_edit($id);
        $data['active'] ='viral';
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
        $data['content'] = $this->admin_domain_edit($all,$id,$id_pub,$e);
        $data['active'] ='dom';
       // $data['all'] =$all;
        $this->load->view('admin/index',$data);
    }
    
        public function editdomain($all=null)
        {
            
            $this->Domain_model->edit_domain();
            $this->dom($this->input->post('all'),$this->input->post('publisher_id'));
        }
        
     public function adddomain()
    {
         $this->Domain_model->add_domain();
        //  $data['content'] = $this->admin_influencer();
        if($this->input->post('all') == 'all')
          $this->dom($this->input->post('all'));
          else
              $this->dom($this->input->post('all'),$this->input->post('publisher_id'));
    }  
         
        
        
     public function deldomain($all=null,$id,$pub_id=null)
    {
         $this->Domain_model->del_domain($id);
        //  $data['content'] = $this->admin_influencer();
          $this->dom($all,$pub_id);
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
}