<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/25/16
 * Time: 1:14 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Facebook
{
    protected $CI;

    public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();

    }
    public function get_facebook_url($callback_url){
        $fb = new Facebook\Facebook([
            'app_id' => '1509104876060790',
            'app_secret' => '977e891176e8e1e9e6b626323f01d8bb',
            'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes','pages_show_list']; // optional
        $loginUrl = $helper->getLoginUrl(base_url() . $callback_url, $permissions);
        return $loginUrl;
    }
}