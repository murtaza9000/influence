<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/13/16
 * Time: 2:29 PM
 */
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url','string']);
        $this->load->model('Influencer_model');

    }
    public function confirmpassword($token){
        $result = $this->db->get_where('influencer', array('confirmation_token' => $token), 1);
        $result = $result->row();
        if (isset($result))
        {
            $this->db->set('confirmed', 1);
            $this->db->where('id', $result->id);
            if ($this->db->update('influencer')){
                $this->session->set_flashdata('message', 'You have been successfully verified your account');
                redirect('/influencer/');
            }
        }else{
            echo "not found";
        }
        //return $this->db->get('influencer', $data);
    }
    public function confirmemail(){
        $data = array('token' => 'P6KzcCwRVTUOiGru');
        $this->load->view('admin/confirmemail',$data);
    }
    public function index(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'displayname', 'Display Name',
            'trim|required|min_length[5]|max_length[12]|is_unique[influencer.display_name]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[influencer.email]',
            array(
                'is_unique'     => 'This %s already exists.'
            ));

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/register');
        }
        else
        {
            //Save Influencer
            $confirmationToken = random_string('alnum', 16);
            if ($this->set_influencer($confirmationToken)){
                $this->send_confirmation_email($confirmationToken);
                $this->load->view('admin/confirmfirst');
            }else{
                $data = array('error' => 'Some error occurred while creating User.');
                $this->load->view('admin/register',$data);
            }


        }

    }
    public function send_confirmation_email($confirmationToken){
        $this->load->library('email');
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('icemelt7@gmail.com');


        $this->email->subject('Verify Mail');
        $data = array('token' => $confirmationToken);
        $email_body = $this->load->view('admin/confirmemail', $data , TRUE);
        $this->email->message($email_body);

        return $this->email->send();
    }

    public function set_influencer($confirmationToken)
    {

        $this->load->helper('url');



        $data = array(
            'name' => $this->input->post('fullname'),
            'display_name' => $this->input->post('displayname'),
            'email' => $this->input->post('email'),
            'account_no' => $this->input->post('bankacc'),
            'country' => $this->input->post('country'),
            'confirmation_token' => $confirmationToken,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );

        return $this->db->insert('influencer', $data);
    }
}