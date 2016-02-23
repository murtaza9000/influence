<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/13/16
 * Time: 9:40 PM
 */
class Influencer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('rssparser');
        $this->load->library('user');
         $this->load->model('Rss_model');
         $this->load->model('Domain_model');
    }

    public function index(){
        $data = array();
        $data = $this->user->add_user_data($data);
        $this->load->view('influencer/index',$data);
    }
    
    public function rss_done(){
      

    // Get 6 items from arstechnica
  // $this->rssparser->set_feed_url('http://feeds.bbci.co.uk/news/rss.xml?edition=uk');  // get feed
//$this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
//$rss = $this->rssparser->getFeed(10);     
            // $data['rss']=$rss;
            
           $data['domlen']=$this->Domain_model->get_rss();
           print_r($data);
            $num =0; 
       //  $this->load->view('influencer/template/rss_service',$data);
         for($i=1 ; $i<=sizeof($data['domlen']['url']);$i++)
      
       { echo $i;
       
           echo $data['domlen']['url'][$i];
       echo "<br>";
       
        $this->rssparser->set_feed_url($data['domlen']['url'][$i]);  // get feed
        $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
        $rss = $this->rssparser->getFeed(10);
       
         foreach($rss as $rs)
            { 
           echo $rs['link'];
            $this->Rss_model->add_rss($rs['link'],$data['domlen']['domain_id'][$i]);
           echo "<br>";
          $num++;
            }
       
       
       
       }
       $data['num']=$num;
       $this->load->view('influencer/template/rss_service',$data);
    }
     public function rssstart()
            {  ?>
         
                    <script>

                    var _confirm = confirm("Proceed?")
                    if (_confirm){
                    window.location = 'http://localhost/influence/influencer/rss_done'                   }
                    </script>
 <?php           }
 
  public function inf()
    {
         $data['content'] = $this->inf_influencer();
         $data['active'] ='inf';
         $this->load->view('influencer/index',$data);
    }
    
      private function inf_influencer()
    {
        $data['rss'] = $this->Rss_model->get_influencer();
        $string = $this->load->view('influencer/template/inf', $data, TRUE);
        return $string;
        
    }
}