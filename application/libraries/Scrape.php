<?php
/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 2/25/16
 * Time: 1:14 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Scrape
{
//require 'vendor/autoload.php';
    protected $CI;

    public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();

    }

    public function execute(){
        //$rss = ['lol'];
        
        $client = new Goutte\Client();
        //$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);
        for ($i = 1; $i < 8; $i++){
            if ($i == 1){
                $crawler = $client->request('GET', 'http://buzztache.com/category/no/');
            }else{
                $crawler = $client->request('GET', 'http://buzztache.com/category/no/page/' . $i. '/');
            }

 $client->getResponse();

            //$link = $crawler->selectLink('Security Advisories')->link();
            //$crawler = $client->click($link);

            // Get the latest post in this category and display the titles
            $crawler->filter('article')->each(function ($node) use (&$rss) {
                if ($node == null) {
                    return;
                }
                $img = $node->filterXPath('//img')->attr('src');
                $heading = $node->filterXPath('//h2')->text();
                $link = $node->filterXPath('//a')->attr('href');

                $arr = [];
                $arr['title'] = $heading;
                $arr['description'] = "<img src='{$img}' />";
                $arr['link'] = $link;

                $rss[] = $arr;
                //print_r($rss);
                //print $heading."\n";
            });
        }

        return $rss;

    }
}

