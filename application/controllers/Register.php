<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/13/16
 * Time: 2:29 PM
 */
use Facebook\FacebookRequest;
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

    public function index($loginData = null){
        $fb = new Facebook\Facebook([
            'app_id' => '1509104876060790',
            'app_secret' => '977e891176e8e1e9e6b626323f01d8bb',
            'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes','pages_show_list']; // optional
        $loginUrl = $helper->getLoginUrl('http://influence.local/register/logincallback', $permissions);

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
            $data = array();
            $data['facebook'] = $loginUrl;

            //Check logindata
            if ($loginData){
                $data['fullname'] = (isset($loginData['name'])) ? $loginData['name'] : null;
                $data['email'] = (isset($loginData['email'])) ? $loginData['email'] : null;
                $data['pagelinks'] = (isset($loginData['pages'])) ? $loginData['pages'] : null;

                $data['facebook_token'] = (isset($loginData['facebook_token'])) ? $loginData['facebook_token'] : null;
            }
            $this->load->view('admin/register',$data);
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

    public function loginbyreddit(){

    }

    public function redditcallback(){

    }

    public function logincallback(){
        $fb = new Facebook\Facebook([
            'app_id' => '1509104876060790',
            'app_secret' => '977e891176e8e1e9e6b626323f01d8bb',
            'default_graph_version' => 'v2.5',
        ]);
        //$fbApp = new Facebook\FacebookApp('1509104876060790','977e891176e8e1e9e6b626323f01d8bb');

        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error1 : ' . $e->getMessage();
            exit;
        }

        if (isset($accessToken)) {

            // Logged in!
            $_SESSION['facebook_access_token'] = (string) $accessToken;
            // Sets the default fallback access token so we don't have to pass it to each request
            $fb->setDefaultAccessToken($accessToken);
            // Now you can redirect to another page and use the
            // access token from $_SESSION['facebook_access_token']
            try {
                //Get pages
                $request = $fb->request('GET', '/me/accounts');
                $response = $fb->getClient()->sendRequest($request);
                $graphEdge = $response->getGraphEdge();
                // Iterate over all the GraphNode's returned from the edge
                $json = "" ;
                foreach ($graphEdge as $key => $value) {
                    $json .= $value['id'] . ":" . $value['name'] . ",";
                }

                //Get name and email
                $request = $fb->request('GET', '/me');
                $response = $fb->getClient()->sendRequest($request);
                $graphNode = $response->getGraphNode();

                $name = $graphNode['name'];
                $email = isset($graphNode['email']) ? $graphNode['email'] : '';

                //Get long token
                // OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();

                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

                $loginData = array();
                $loginData['pages'] = $json;
                $loginData['name'] = $name;
                $loginData['email'] = $email;
                $loginData['facebook_token'] = $longLivedAccessToken;

                $this->index($loginData);

            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error1 : ' . $e->getMessage();
                exit;
            }

            //echo 'Logged in as ' . $userNode->getName();
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
            'fb_page_links' => $this->input->post('pagelinks'),
            'facebooktoken' => $this->input->post('facebook_token')
        );

        return $this->db->insert('influencer', $data);
    }
}