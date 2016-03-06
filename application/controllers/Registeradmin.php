<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/13/16
 * Time: 2:29 PM
 */

class Registeradmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url','string']);
        $this->load->model('Admin_model');
       

    }
    
    
    
    public function login_validation_rules(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    }

    public function load_validation_rules(){
        $this->load->library('form_validation');
        /*$this->form_validation->set_rules(
            'displayname', 'Display Name',
            'trim|required|min_length[5]|max_length[12]|is_unique[influencer.display_name]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );*/
        //$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]',
            array(
                'is_unique'     => 'This %s already exists.'
            ));
    }

    //Main index function
    public function index(){
         //load validation rules
        $this->load_validation_rules();

        //This is the first time we're viewing this page, or we're coming here after the validations fail
        if ($this->form_validation->run() == FALSE)
        {
            //If validations are correct load facebook login url and show it on the page
            $data = array();
          
          
            $this->load->view('admin/registeradmin',$data);
        }
        //The data is A-OK, lets log in.
        else
        {
            $this->loadadminpage();
        }
    }

    public function loadadminpage(){
        //Save Influencer
        
        if ($this->set_admin()){
            $this->session->set_flashdata('message', 'You have been successfully verified your account');
                  $this->session->set_userdata('logged_in',true);
                 
            
              
             redirect('/admin/');
        }else{
            $data = array('error' => 'Some error occurred while creating User.');
            
           
        
            $this->load->view('admin/registeradmin',$data);
        }
    }
   
   

   

    public function set_admin()
    {
        $this->load->helper('url');

        $data = array(
            
            'name' => $this->input->post('fullname'),
            
            'email' => $this->input->post('email'),
             'superadmin' => '0',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            
        );
          $query=   $this->db->insert('admin', $data);
          $this->session->set_userdata('user_id_ad',$this->db->insert_id());
          if($query)
            return true;
          else
            return false;
        
    }

 
    public function logout()
    {
        $this->session->unset_userdata('user_id_ad');
        $this->session->set_userdata('logge_in',false);
        redirect(base_url('registeradmin'));
    }
}