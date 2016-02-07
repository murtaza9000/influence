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
        $this->load->view('admin/index',$data);
    }
    
    public function dom($id=null)
    {
        $data['content'] = $this->admin_domain($id);
        $this->load->view('admin/index',$data);
    }
    public function pub()
    {
          $data['content'] = $this->admin_publisher();
          $this->load->view('admin/index',$data);
    }
    
    public function inf()
    {
         $data['content'] = $this->admin_influencer();
         $this->load->view('admin/index',$data);
    }
    
    
    public function index( $content = null,$id=null)
    {
        //echo "hello";
        $this->load->helper('url');
        $data['content'] = "Test";
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
    
      private function admin_domain($id)
    {
        $data['domain'] = $this->Domain_model->get_domain($id);
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
        $string = $this->load->view('admin/template/viral', $data, TRUE);
        return $string;
    }
    public function viraledit($id=null)
    {
        $data['content'] = $this->admin_viral_edit($id);
        
        $this->load->view('admin/index',$data);
    }
}