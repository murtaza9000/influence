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
    }

    public function show($a, $b, $c){
        echo "show" . $a . " " . $b. " " .$c;
    }
    public function index( $content = null,$id=null)
    {
        //echo "hello";
        $this->load->helper('url');
        $data['admin'] = $this->Influencer_model->get_influencer();
        if ($content == 'inf')
        {
        $data['content'] = $this->admin_influencer();
       // $this->load->view('admin/index',$data);
        }
        else if ($content == 'pub')
        {
        $data['content'] = $this->admin_publisher();
        //$this->load->view('admin/index',$data);
        }
         else if ($content == 'dom')
        {
        $data['content'] = $this->admin_domain($id);
        //$this->load->view('admin/index',$data);
        }
        else
         $data['content'] = "random";
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
}