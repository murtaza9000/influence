<?php

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/25/16
 * Time: 12:25 AM
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'string']);
        $this->load->model('Influencer_model');
        $this->load->library('facebook');
          $this->load->library('user');
         $this->load->library('form_validation'); 
         $this->load->library('email');
    }

    public function index(){
 if ($this->user->is_logged_in())
            redirect('/influencer');
        //load validation rules
        $this->login_validation_rules();

        //This is the first time we're viewing this page, or we're coming here after the validations fail
        if ($this->form_validation->run() == FALSE){
            

            $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
            $this->load->view('admin/login',$data);
        }else{
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $row = $this->db->get_where('influencer',array('email' => $email))->row();
            if ($row == null){
              

               $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
               
                $data = array('error' => 'User does not exist');
                $this->load->view('admin/login',$data);
            }else if($row->confirmed == 0){
               

               $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
                 
                $data = array('error' => 'You have not confirmed your account from your email');
                $this->load->view('admin/login',$data);
          
              }else if($row->ban == 1){
                 

               $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
             
                $data = array('error' => 'You are ban contact administrator');
                $this->load->view('admin/login',$data);
            }
            else if (!password_verify($password,$row->password)){
                
               $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
               
                $data = array('error' => 'Incorrect password');
                $this->load->view('admin/login',$data);
            }else{
               // echo "Correct Password";
                $row = $this->db->get_where('influencer',array('email'=>$email))->row();
                $this->session->set_userdata('user_id',$row->id);
                $this->session->set_userdata('logged_in',true);
                redirect('/influencer/');
            }

        }
    }

    public function login_validation_rules(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    }
    
   public function resetpassword(){
        
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
          if ($this->form_validation->run() == FALSE){
            $data = [];
           
            $this->load->view('influencer/userforget',$data);
        }else{
           
            $email = $this->input->post('email');
            $row = $this->db->get_where('influencer',array('email' => $email))->row();
            if ($row == null){
                $data = array('error' => 'User does not exist');
               $this->load->view('influencer/userforget',$data);
               
            }else if($row->confirmed == 0){
               

             
                 
                $data = array('error' => 'You have not confirmed your account from your email');
                $this->load->view('admin/login',$data);
          
            }else{
        
        
        
        
        
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
                   $this->db->update('influencer',$data);
             $this->session->set_flashdata('message', 'Email is send to entered email address check your inbox or spam');
         
         
        $this->userforget();
        
            }
        }
        
    }

    private function rand_passwd()
            { 
        $length = 8;
         $chars = 'abcdefghijklmnopqrstuvwxyz0123456789'  ;
    return substr( str_shuffle( $chars ), 0, $length );
    
                }     
                
                
      public function userforget(){      
          $this->load->view('influencer/userforget');
      }    
}



