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
            $this->load->model('Viral_model');
             $this->load->library('opengraph');
    }

    public function index(){
        $data = array();
        $data = $this->user->add_user_data($data);

        $data['content'] = "Hello";
        $data['active'] = "Hello";
        $this->load->view('influencer/index',$data);
    }
    
    public function rss_done(){
             $this->Rss_model->del_rss();
           $data=$this->Domain_model->get_rss();
             
            $num =0; 
    
         foreach($data as $values)
      
       {  
           
           echo $values['url'];
       echo "<br>";
      
     //  urlencode(trim($values['url']))
        $this->rssparser->set_feed_url(urldecode(trim($values['url'])));  // get feed
        $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
        $rss = $this->rssparser->getFeed(25);
       
         foreach($rss as $rs)
            { 
         echo $rs['link'];
            $this->Rss_model->add_rss($rs,$values['id']);
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
    
     
      
      public function viral($id=null)
    {
        $data['content'] = $this->influencer_viral($id);
        $data['active'] ='viral';
        $this->load->view('influencer/index',$data);
    }
    
    private function influencer_viral($id =null)
    {
        $data['viral'] = $this->Viral_model->get_viral($id);
        $string = $this->load->view('influencer/template/viral', $data, TRUE);
        return $string;
        
    }
}