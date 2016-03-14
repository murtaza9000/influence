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
    }

    public function index(){
 if ($this->user->is_logged_in())
            redirect('/influencer');
        //load validation rules
        $this->login_validation_rules();

        //This is the first time we're viewing this page, or we're coming here after the validations fail
        if ($this->form_validation->run() == FALSE){
            $data = [];

            $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
            $this->load->view('admin/login',$data);
        }else{
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $row = $this->db->get_where('influencer',array('email' => $email))->row();
            if ($row == null){
                $data = array('error' => 'User does not exist');
                $this->load->view('admin/login',$data);
            }else if($row->confirmed == 0){
                $data = array('error' => 'You have not confirmed your account from your email');
                $this->load->view('admin/login',$data);
          
              }else if($row->ban == 1){
                $data = array('error' => 'You are ban contact administrator');
                $this->load->view('admin/login',$data);
            }
            else if (!password_verify($password,$row->password)){
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
}