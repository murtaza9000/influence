<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
require_once dirname(__FILE__) . '/rssparser/Rssparser.php';
  
class  rss extends RSS
{
 function __construct()
 {
 parent::__construct();
 }
}
  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */