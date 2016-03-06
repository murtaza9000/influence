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
    public function add_user_data($controller)
    { 

        if ($this->CI->session->has_userdata('user_id')){
            $id = $this->CI->session->userdata('user_id');
            $row = $this->CI->db->get_where($controller, array('id' => $id))->row();
          
            $data['full_name'] = $row->name;

        }else{
            $data['full_name'] = 'dog';
        }
        return $data;
    }
    
    public function add_user_data_ad($controller)
    { 

        if ($this->CI->session->has_userdata('user_id_ad')){
            $id = $this->CI->session->userdata('user_id_ad');
            $row = $this->CI->db->get_where($controller, array('id' => $id))->row();
          
            $data['full_name'] = $row->name;

        }else{
            $data['full_name'] = 'dog';
        }
        return $data;
    }

    public function is_logged_in(){
        if ($this->CI->session->has_userdata('user_id')){
            return true;
        }else{
            return false;
        }
    }
     public function is_loggedad_in(){
        if ($this->CI->session->has_userdata('user_id_ad')){
            return true;
        }else{
            return false;
        }
    }
}