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
        $this->load->library('facebook');

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
                  $this->session->set_userdata('logged_in',true);
                 
            
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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[influencer.email]',
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
            $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
            $this->load->view('admin/register',$data);
        }
        //The data is A-OK, lets log in.
        else
        {
            $this->generate_confirmation_token_and_save();
        }
    }

    public function generate_confirmation_token_and_save(){
        //Save Influencer
        $confirmationToken = random_string('alnum', 16);
        if ($this->set_influencer($confirmationToken)){
            $this->send_confirmation_email($confirmationToken);
            $this->load->view('admin/confirmfirst');
        }else{
            $data = array('error' => 'Some error occurred while creating User.');
            
            $data['facebook'] = $this->facebook->get_facebook_url('/register/logincallback');
        
            $this->load->view('admin/register',$data);
        }
    }

    public function twittercallback(){
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
            die("Some Thing went wrong");
        }
        $connection = new Abraham\TwitterOAuth\TwitterOAuth('5Gd9l295ZAkm6TP9HbTApXYb6',
            'y7rXUAv2aqszUsn1O4t3SCmDlcJnWUuXqpj3kmgs3c10W9QIKV', $request_token['oauth_token'], $request_token['oauth_token_secret']);


        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
        $_SESSION['access_token'] = $access_token;
        $connection = new Abraham\TwitterOAuth\TwitterOAuth('5Gd9l295ZAkm6TP9HbTApXYb6',
            'y7rXUAv2aqszUsn1O4t3SCmDlcJnWUuXqpj3kmgs3c10W9QIKV', $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");

        //login callback
        $loginData = array();
        $loginData['name'] = $user->screen_name;
        $loginData['login_provider'] = 'twitter';

        $this->save_and_login($loginData);

    }

    public function loginbytwitter(){

        $connection = new Abraham\TwitterOAuth\TwitterOAuth('5Gd9l295ZAkm6TP9HbTApXYb6',
                'y7rXUAv2aqszUsn1O4t3SCmDlcJnWUuXqpj3kmgs3c10W9QIKV',
                '908751325-nW0w5sfktt4yzXlJ6ZoZTU9INTCKqsA78WWw8lON',
                'jc9VcvyFDpYl9lxFpw4s44wv2dMpWEntIMNhsHS7UpYhQ');

        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => 'http://acquire.social/register/twittercallback'));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        redirect($url);

    }
    public function loginbyreddit(){

        require_once dirname(__DIR__) . '/vendor/reddit/config.php';
        require_once dirname(__DIR__) . '/vendor/reddit/reddit.php';
        $reddit = new reddit();
        if ($reddit){
            $userData = $reddit->getUser();
            $userName = $userData->name;

            $loginData = array();

            $loginData['name'] = $userName;
            $loginData['login_provider'] = 'reddit';
            $this->save_and_login($loginData);
        }
    }

    public function redditcallback(){
        require_once dirname(__DIR__) . '/vendor/reddit/config.php';
        require_once dirname(__DIR__) . '/vendor/reddit/reddit.php';
        $reddit = new reddit();
        $userData = $reddit->getUser();
        $userName = $userData->name;

        $loginData = array();

        $loginData['name'] = $userName;
        $loginData['login_provider'] = 'reddit';
        $this->save_and_login($loginData);
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
                $request = $fb->request('GET', '/me?fields=name,email');
                $response = $fb->getClient()->sendRequest($request);
                $graphNode = $response->getGraphNode();

                $name = $graphNode['name'];
                $id = $graphNode['id'];
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
                $loginData['id'] = $id;
                $loginData['facebook_token'] = $longLivedAccessToken;
                $loginData['login_provider'] = 'facebook';

                $this->save_and_login($loginData);
                //$this->index($loginData);

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

    public function save_and_login($loginData){

        $data = array(
            'name' => $loginData['name'],
            //'display_name' => $this->input->post('displayname'),
            'email' => $loginData['email'],
            'fb_page_links' => $loginData['pages'],
            'facebooktoken' => $loginData['facebook_token'],
            'facebook_id' => $loginData['id'],
            'login_provider' => $loginData['login_provider']
        );

        //Check if its a login call
        if ($loginData['login_provider'] == 'facebook'){
            $result = $this->db->get_where('influencer', array('email' => $loginData['email']));
            if ($result->row()){
                $this->session->set_flashdata('message', 'You have successfully logged in from ' . $loginData['login_provider']);
                $this->session->set_userdata('user_id',$result->row()->id);
                $this->session->set_userdata('logged_in',true);
                redirect('/influencer/');
                return;
            }
        }else if($loginData['login_provider'] == 'reddit' || $loginData['login_provider'] == 'twitter'){
            $result = $this->db->get_where('influencer', array('name' => $loginData['name']));
            if ($result->row()){
                $this->session->set_flashdata('message', 'You have successfully logged in from ' . $loginData['login_provider']);
                $this->session->set_userdata('user_id',$result->row()->id);
                $this->session->set_userdata('logged_in',true);
                redirect('/influencer/');
                return;
            }
        }

        //
        if ($this->db->insert('influencer', $data)){
            $this->session->set_flashdata('message', 'You have successfully logged in from ' . $loginData['login_provider']);
            $this->session->set_userdata('logged_in',true);
            $this->session->set_userdata('user_id',$this->db->insert_id());
            redirect('/influencer/');
        }else{
            $data = array('error' => 'Some error occurred while creating User.');
            $this->load->view('admin/register',$data);
        };

    }

    public function send_confirmation_email($confirmationToken){

        $this->load->library('email');
        $config['mailtype'] = 'html';
        
  //  $config['smtp_host'] = 'ssl://smtp.acquire.social';
    //$config['smtp_port'] = 465;
    //$config['smtp_user'] = 'emailaddress';
    //$config['smtp_pass'] = 'xxx';
   
        $this->email->initialize($config);
        $this->email->from('dontreply@acquire.social', 'Acquire Social');
        $email = trim($this->input->post('email'));
        $this->email->to($email);


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
            'facebooktoken' => $this->input->post('facebook_token'),
            'login_provider'=> "local portal"
        );
             $query=   $this->db->insert('influencer', $data);
          $this->session->set_userdata('user_id',$this->db->insert_id());
        return $query;
    }

    private function set_login_data($data)
    {
        $data['fullname'] = (isset($loginData['name'])) ? $loginData['name'] : null;
        $data['email'] = (isset($loginData['email'])) ? $loginData['email'] : null;
        $data['pagelinks'] = (isset($loginData['pages'])) ? $loginData['pages'] : null;

        $data['facebook_token'] = (isset($loginData['facebook_token'])) ? $loginData['facebook_token'] : null;
        return $data;
    }
    public function logout()
    {
         $this->session->unset_userdata('user_id');
        $this->session->set_userdata('logged_in',false);
        redirect(base_url('register'));
    }
    public function publisher(){
        
        $this->load_validation_rules_pub();

        //This is the first time we're viewing this page, or we're coming here after the validations fail
        if ($this->form_validation->run() == FALSE)
        {
            //If validations are correct load facebook login url and show it on the page
            $data = array();
         
            $this->load->view('admin/publogin',$data);
        }
        //The data is A-OK, lets log in.
        else
        {
            $this->insert_data();
        }
    }    
    
    public function insert_data()
    { 
        $this->load->helper('url');
      
        $data = array(
            
            'name' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'country' => $this->input->post('country'),
            'city' => $this->input->post('city'),
            'contact' => $this->input->post('phone')
        );
             $query=   $this->db->insert('publisher', $data);
             if($query)
             {
                  $this->session->set_flashdata('message', 'You have been successfully signup');
                
                   redirect('/register/publisher');
             }
             else 
             {
             $this->session->set_flashdata('message', 'Error try again');
           
              redirect('/register/publisher');
             }
    }
    
     public function load_validation_rules_pub(){
        $this->load->library('form_validation');
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[publisher.email]',
           array(
                'is_unique'     => 'This %s already exists.'
            ));
           $this->form_validation->set_rules('fullname', 'Name', 'trim|required');
             $this->form_validation->set_rules('country', 'country', 'trim|required');
               $this->form_validation->set_rules('city', 'city', 'trim|required');
          
    }
}