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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    }
}