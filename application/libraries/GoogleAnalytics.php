<?php

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 3/11/16
 * Time: 4:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Googleanalytics
{
    protected $CI;

    protected $urlToAccountMap;
    public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('date');

        $this->urlToAccountMap['Premium Buzztache'] = 'buzztache.com';
    }

    private function getService()
    {
        // Creates and returns the Analytics service object.

        // Load the Google API PHP Client Library.
        ///Users/mustafahanif/WebstormProjects/influence/application/vendor/google-api-php-client/src/Google/autoload.php
        $path  = dirname(__DIR__) . '/vendor/google-api-php-client/src/Google/autoload.php';
        require_once $path;

        // Use the developers console and replace the values with your
        // service account email, and relative location of your key file.
        $service_account_email = 'testaccount@operating-rush-124305.iam.gserviceaccount.com';
        $key_file_location = dirname(__DIR__) . '/vendor/client_key.p12';

        // Create and configure a new client object.
        $client = new Google_Client();
        $client->setApplicationName("HelloAnalytics");
        $analytics = new Google_Service_Analytics($client);

        // Read the generated client_secrets.p12 key.
        $key = file_get_contents($key_file_location);
        //echo $key;
        $cred = new Google_Auth_AssertionCredentials(
            $service_account_email,
            array(Google_Service_Analytics::ANALYTICS_READONLY),
            $key
        );
        //echo $cred;
        $client->setAssertionCredentials($cred);
        if($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }

        return $analytics;
    }

    private function getFirstprofileId(&$analytics)
    {
        $validProfiles = [];
        // Get the user's first view (profile) ID.

        // Get the list of accounts for the authorized user.
        $accounts = $analytics->management_accounts->listManagementAccounts();

        for ($i = 0; $i < count($accounts->getItems()); $i++) {
            $items = $accounts->getItems();

            $firstAccountId = $items[$i]->getId();

            // Get the list of properties for the authorized user.
            $properties = $analytics->management_webproperties
                ->listManagementWebproperties($firstAccountId);

            for ($j = 0; $j < count($properties->getItems()); $j++) {

                $items = $properties->getItems();
                $firstPropertyId = $items[$j]->getId();

                // Get the list of views (profiles) for the authorized user.
                $profiles = $analytics->management_profiles
                    ->listManagementProfiles($firstAccountId, $firstPropertyId);

                for ($k = 0; $k < count($profiles->getItems()); $k++) {
                    //echo $profiles[$k]->getName();

                    foreach($this->urlToAccountMap as $key => $value){
                        if ($profiles[$k]->getName() == $key){
                            $res = array();
                            $res['id'] = $profiles[$k]->getId();
                            $res['url'] = $value;
                            $validProfiles[] = $res;
                        }
                    }
                }
            }
        }
        return $validProfiles;
    }

    private function getPremiumResults(&$analytics, $profileId, $facebook=null) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        $optParams = [];
        if ($facebook == 'facebook'){
            $optParams = array(
                'dimensions' => 'ga:campaign,ga:searchDestinationPage',
                'filters' => 'ga:source==FB;ga:medium==AK;ga:country==United States,ga:country==Canada,ga:country==Australia,ga:country==United Kingdom',
                'max-results' => 10000
            );
        }else{
            $optParams = array(
                'dimensions' => 'ga:campaign,ga:searchDestinationPage',
                //ga:medium==Social;
                //ga:source==FB;ga:medium==AK;
                'filters' => 'ga:medium==AS,ga:country==United States,ga:country==Canada,ga:country==Australia,ga:country==United Kingdom',
                'max-results' => 10000
            );
        }

        return $analytics->data_ga->get(
            'ga:' . $profileId,
            'yesterday',
            'today',
            'ga:sessions'
            ,$optParams)->getRows();
    }

    private function getNormalResults(&$analytics, $profileId, $facebook=null) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        $optParams = [];
        if ($facebook == 'facebook'){
            $optParams = array(
                'dimensions' => 'ga:campaign,ga:searchDestinationPage',
                //ga:medium==Social;
                'filters' => 'ga:source==FB;ga:medium==AK;ga:country!=United States,ga:country!=Canada,ga:country!=Australia,ga:country!=United Kingdom',
                'max-results' => 10000
            );
        }else{
            $optParams = array(
                'dimensions' => 'ga:campaign,ga:searchDestinationPage',
                //ga:medium==Social;
                //ga:source==FB;ga:medium==AK;
                'filters' => 'ga:medium==AS,ga:country!=United States,ga:country!=Canada,ga:country!=Australia,ga:country!=United Kingdom',
                'max-results' => 10000

            );
        }

        return $analytics->data_ga->get(
            'ga:' . $profileId,
            'yesterday',
            'today',
            'ga:sessions'
            ,$optParams)->getRows();
    }

    private function printResults(&$results) {
        // Parses the response from the Core Reporting API and prints
        // the profile name and total sessions.
        if (count($results->getRows()) > 0) {

            // Get the profile name.
            $profileName = $results->getProfileInfo()->getProfileName();

            // Get the entry for the first entry in the first row.
            $rows = $results->getRows();
            //$sessions = $rows[0][0];

            // Print the results.
            print "First view (profile) found: $profileName\n";
            print "Total sessions: " . print_r($rows) . "\n";
        } else {
            print "No results found.\n";
        }
    }

    public function execute_per_profile(&$analytics, $profile, $facebook=null){
        $premiumResults = $this->getPremiumResults($analytics, $profile['id'], $facebook);
        //print_r($premiumResults);
        echo '[-] Got premium results: ' . count($premiumResults) . PHP_EOL;

        $normalResults = $this->getNormalResults($analytics, $profile['id'], $facebook);
        echo '[-] Got normal results: ' . count($normalResults) . PHP_EOL;

        //Get Premium rate for buzztache
        $premiumRates = $this->get_premium_rates($profile['url']);
        echo 'Premium Rates: ' . $premiumRates;
        //Get Normal rate for buzztache
        $normalRates = $this->get_normal_rates($profile['url']);

        //echo count($premiumResults);
        $totalPremiumSessions = 0;
        $totalAmount = 0;
        if (count($premiumResults) > 0){
            foreach ($premiumResults as $result){
                //echo 'Premium Result: ' . print_r($result) . PHP_EOL;
                $name = $this->get_influencer_id($result[0]);
                if ($name == ''){
                    continue;
                }
                $link = $result[1];
                $sessions = $result[2];
                //echo 'Premium Sessions: ' . $sessions;
                $totalPremiumSessions += $sessions;
                $amount = $this->calculate_amount($sessions, $premiumRates);
                $totalAmount += $amount;
                $this->update_amount($name, $profile['url'], $amount,$link,$sessions);

                //echo $result[0] . ", ";
            }
        }
        echo 'Premium Sessions: ' . $totalPremiumSessions;
        echo '<br />Premium Total Amount: ' . $totalAmount;
        //return;
        if (count($normalResults) > 0){
            foreach ($normalResults as $result){
                //echo 'Normal Result: ' . print_r($result) . PHP_EOL;
                $name = $this->get_influencer_id($result[0]);
                if ($name == ''){
                    continue;
                }
                $link = $result[1];
                $sessions = $result[2];

                $amount = $this->calculate_amount($sessions, $normalRates);

                $this->update_amount($name,$profile['url'],$amount,$link,$sessions, 'update');
                //echo $result[0] . ", ";
            }
        }
        echo '</pre>';
    }
    public function execute(){
        echo '<pre>';


        echo '[-] Start' . PHP_EOL;
        $analytics = $this->getService();
        echo '[-] getService ' . $analytics . PHP_EOL;


        $profiles = $this->getFirstProfileId($analytics);
        echo '[-] getFirstProfileId' . print_r($profiles) . PHP_EOL;

        echo '<pre>';
        foreach($profiles as $profile){
            //$this->execute_per_profile($analytics, $profile);

            //Load old facebook ones too
            $this->execute_per_profile($analytics, $profile, 'facebook');
        }
        echo '</pre>';

    }

    private function calculate_amount($sessions, $rates){
        $amount = ($sessions / 1000) * $rates;
        return $amount;
    }

    private function get_normal_rates($url){
        $row = $this->CI->db->get_where('domain',array('url' => $url));

        $row = $row->row_array();
        return $row['click_rate'];
    }
    private function get_premium_rates($url){
        $row = $this->CI->db->get_where('domain',array('url' => $url));

        $row = $row->row_array();
        return $row['click_ratepre'];
    }


    private function get_influencer_id($name)
    {
        //Debug:
        //$name = 'Pakistan_17';

        /*$name = explode("_",$name);
        if (is_array($name) && count($name) > 1) {
            //The ID
            $name = $name[1];
            return $name;
        }else{
            return '';
        }*/
        return $name;


    }

    private function update_influencer_amount($currentPayment, $amount, $now_time, $inf){
        $currentPayment = $currentPayment + $amount;
        $this->CI->db->where('id', $inf->id);
        $data = array(
            'payment' => $currentPayment,
            'payment_last_updated' => $now_time
        );
        $this->CI->db->update('influencer', $data);
    }
    private function update_amount($name, $url, $amount, $link, $sessions, $update = '')
    {
        $link = $url . $link;
        $inf = $this->CI->db->get_where('influencer', array('utm' => $name))->row();


        if (!$inf){
            //die('found nothing');
            return;
        }else{
            //print_r($inf);
            //echo $inf->id;

        }
        echo '[-] Processing UTM: ' . $name . PHP_EOL;
        echo "Sessions: " . $sessions . PHP_EOL;
        echo "Amount: " . $amount . PHP_EOL;
        $currentPayment = $inf->payment;
        echo '[-] current payment: ' . $currentPayment . PHP_EOL;
        $lastUpdated = $inf->payment_last_updated;

        /*$lastUpdated = date_create($lastUpdated);
        $now = date_create(date("Y-m-d H:i:s"));
        $interval = date_diff($lastUpdated, $now);
        /*if ($interval < 1){
            return;
        }*/

        $now = date('Y-m-d');
        $now_time = date('Y-m-d H');


        //Add Data
        if ($update == 'update') {
            echo "[-] Now in second foreach loop, Update: " . $update . PHP_EOL;
            $result = $this->CI->db->get_where('revenue_history', array('influencer_id' => $inf->id, 'time' => $now_time, 'link' => $link))->row();
            print_r($result);
            if ($result) {
                echo "[x] Found an entry already for today, normal updating it" . PHP_EOL;
                $prevAmount = $result->revenue_generated;
                $this->CI->db->where('date', $now);
                $this->CI->db->where('link', $link);
                $this->CI->db->where('influencer_id', $inf->id);
                $data = array(
                    'normal_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                $this->CI->db->update('revenue_history', $data);
                $this->update_influencer_amount($currentPayment, $amount - $prevAmount, $now_time, $inf);
            }else{
                echo "[x] Inserting new entry for today" . PHP_EOL;
                $data = array(
                    'date' => $now,
                    'time' => $now_time,
                    'link' => $link,
                    'influencer_id' => $inf->id,
                    'normal_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                $this->CI->db->insert('revenue_history', $data);
                $this->update_influencer_amount($currentPayment, $amount, $now_time, $inf);
            }

        }else{
            $result = $this->CI->db->get_where('revenue_history', array('influencer_id' => $inf->id, 'time' => $now_time, 'link' => $link))->row();
            if ($result) {
                //die($result->amount);
                echo "[x] Found an entry already for today, premium updating it" . PHP_EOL;
                $prevAmount = $result->revenue_generated;
                $this->CI->db->where('date', $now);
                $this->CI->db->where('link', $link);
                $this->CI->db->where('influencer_id', $inf->id);
                $data = array(
                    'premium_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                $this->CI->db->update('revenue_history', $data);
                $this->update_influencer_amount($currentPayment, $amount - $prevAmount, $now_time, $inf);
            }else{
                echo "[x] Inserting new premium entry for today" . PHP_EOL;
                $data = array(
                    'date' => $now,
                    'time' => $now_time,
                    'link' => $link,
                    'influencer_id' => $inf->id,
                    'premium_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                //print_r($data);
                //die();
                $this->CI->db->insert('revenue_history', $data);
                $this->update_influencer_amount($currentPayment, $amount, $now_time, $inf);
            }
        }


    }
}