<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 3/11/16
 * Time: 7:14 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/6/16
 * Time: 4:00 AM
 */
class Analyticsservice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googleanalytics');

    }

    public function index(){
        $this->load->library('googleanalytics');

        $this->googleanalytics->execute();
    }
}