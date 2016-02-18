<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['opauth_config'] = array(
    'path' => 'register/auth/', //example: /ci_opauth/auth/login/
    'callback_url' => 'register/authcb/', //example: /ci_opauth/auth/authenticate/
    'callback_transport' => 'post', //Codeigniter don't use native session
    'security_salt' => 'your_salt',
    'debug' => true,
    'Strategy' => array( //comment those you don't use
        'Twitter' => array(
            'key' => 'twitter_key',
            'secret' => 'twitter_secret'
        ),
        'Facebook' => array(
            'app_id' => '1509104876060790',
            'app_secret' => '977e891176e8e1e9e6b626323f01d8bb'
        ),
        'Google' => array(
            'client_id' => 'client_id',
            'client_secret' => 'client_secret'
        ),
        'OpenID' => array(
            'openid_url' => 'openid_url'
        )
    )
);

/* End of file ci_opauth.php */
/* Location: ./application/config/ci_opauth.php */
