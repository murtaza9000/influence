<?php

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/25/16
 * Time: 12:25 AM
 */
class Adminlogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'string']);
        $this->load->model('Admin_model');
        $this->load->library('facebook');
          $this->load->library('email');
          $this->load->library('form_validation');
    }

    public function index(){

        //load validation rules
        $this->login_validation_rules();

        //This is the first time we're viewing this page, or we're coming here after the validations fail
        if ($this->form_validation->run() == FALSE){
            $data = [];
           
            $this->load->view('admin/adminlogin');
        }else{
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $row = $this->db->get_where('admin',array('email' => $email))->row();
            if ($row == null){
                $data = array('error' => 'User does not exist');
                $this->load->view('admin/adminlogin',$data);
           
            }
            else if (!password_verify($password,$row->password)){
                $data = array('error' => 'Incorrect password');
                $this->load->view('admin/adminlogin',$data);
            }else{
               // echo "Correct Password";
                $row = $this->db->get_where('admin',array('email'=>$email))->row();
                $this->session->set_userdata('user_id_ad',$row->id);
                $this->session->set_userdata('logged_in',true);
                redirect('/admin/');
            }

        }
    }

    public function login_validation_rules(){
        
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    }
    
     public function resetpassword(){
        
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
          if ($this->form_validation->run() == FALSE){
            $data = [];
           
            $this->load->view('admin/adminforget',$data);
        }else{
           
            $email = $this->input->post('email');
            $row = $this->db->get_where('admin',array('email' => $email))->row();
            if ($row == null){
                $data = array('error' => 'User does not exist');
                $this->load->view('admin/adminforget',$data);
            }
            else{
        
        
        
        
        
       $randompass=$this->rand_passwd();
       $config['mailtype'] = 'html';
        $forgotpassword=password_hash($randompass, PASSWORD_DEFAULT);
        
        $this->email->initialize($config);
        $this->email->from('no-reply@acquire.social', 'Acquire Social');
        $email = trim($this->input->post('email'));
        $this->email->to($email);
  
        $this->email->subject('Password Reset');
       // $data = array('token' => $confirmationToken);
       $data['forgetpass']=$randompass;
      
        $email_body = $this->load->view('admin/confirmemail', $data , TRUE);
        $this->email->message($email_body);
        $this->email->send();
        $this->load->helper('url');

        $data = array(
                 'password' => $forgotpassword
            
        );
                  
                   $this->db->where('email', $email);
                   $this->db->update('admin',$data);
             $this->session->set_flashdata('message', 'Email is send to entered email address check your inbox or spam');
         
         
        $this->adminforget();
        
            }
        }
        
    }

    private function rand_passwd()
            { 
        $length = 8;
         $chars = 'abcdefghijklmnopqrstuvwxyz0123456789'  ;
    return substr( str_shuffle( $chars ), 0, $length );
    
                }     
                
                
      public function adminforget(){      
          $this->load->view('admin/adminforget');
      }
      
     
}