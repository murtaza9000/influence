<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/24/16
 * Time: 3:01 AM
 */
class User
{
    protected $CI;
    public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }
    public function add_user_data($data)
    {
        if ($this->CI->session->has_userdata('id')){
            $id = $this->CI->session->userdata('id');
            $row = $this->CI->db->get('influencer')->where('id', $id)->row();
            $data['full_name'] = $row->name;

        }else{
            $data['full_name'] = 'dog';
        }
        return $data;
    }
}