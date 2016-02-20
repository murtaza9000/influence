
<?php
/*
echo "<pre>";
print_r($domlen);
echo "</pre>";

  for($i=0 ; $i<sizeof($domlen['url']);$i++)
       {
            echo $domlen['url'][$i];
       echo "<br>";
       
        $this->rssparser->set_feed_url($domlen['url'][$i]);  // get feed
        $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
        $rss = $this->rssparser->getFeed(10); 
         foreach($rss as $rs)
            {
             echo $rs['link'];
             $this->Rss_model->add($rs['link'],$domlen['domain_id'][$i]);
             echo "<br>";
            }
       
       
       
       }
/*
 for($i=0 ; $i<sizeof($domlen['publisher_id']);$i++)
       {
            echo $domlen['publisher_id'][$i];
       echo "<br>";
       }
       
       $this->rssparser->set_feed_url('http://feeds.bbci.co.uk/news/rss.xml?edition=uk');  // get feed
$this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
$rss = $this->rssparser->getFeed(10);     
            
            foreach($rss as $rs)
            {
             echo $rs['link'];
             echo "<br>";
            }
echo "<pre>";
print_r($rss);
echo "</pre>";
*/

echo "<h1>done</h1>";
echo "<p> total link added are: ".$num."</p>";
 ?>
