<?php

/**
 * Created by PhpStorm.
 * User: mustafahanif
 * Date: 3/11/16
 * Time: 4:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class GoogleAnalytics
{
    protected $CI;

    public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('date');
        echo "hello";

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
                    echo $profiles[$k]->getName();
                    if ($profiles[$k]->getName() == 'Premium Buzztache'){
                        return $profiles[$k]->getId();
                    }
                }
            }

        }
    }

    private function getPremiumResults(&$analytics, $profileId) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        $optParams = array(
            'dimensions' => 'ga:campaign,ga:searchDestinationPage',
            //ga:medium==Social;
            'filters' => 'ga:medium==AS;ga:country==United States,ga:country==Canada,ga:country==Australia,ga:country==United Kingdom');
        return $analytics->data_ga->get(
            'ga:' . $profileId,
            'yesterday',
            'today',
            'ga:sessions'
            ,$optParams)->getRows();
    }

    private function getNormalResults(&$analytics, $profileId) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        $optParams = array(
            'dimensions' => 'ga:campaign,ga:searchDestinationPage',
            //ga:medium==Social;
            'filters' => 'ga:medium==AS;ga:country!=United States,ga:country!=Canada,ga:country!=Australia,ga:country!=United Kingdom');
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

    public function execute(){
        echo 'execute 1';

        $analytics = $this->getService();
        echo 'execute 2';
        $profile = $this->getFirstProfileId($analytics);
        echo 'execute 3';
        $premiumResults = $this->getPremiumResults($analytics, $profile);
        echo 'execute 4';
        print_r($premiumResults);
        $normalResults = $this->getNormalResults($analytics, $profile);
        print_r($normalResults);
        echo 'execute 5';
        //Get Premium rate for buzztache
        $premiumRates = $this->get_premium_rates();
        //Get Normal rate for buzztache
        $normalRates = $this->get_normal_rates();

        //echo count($premiumResults);
        foreach ($premiumResults as $result){
            echo 'Result: ' . $result;
            $name = $this->get_influencer_id($result[0]);

            $link = $result[1];
            $sessions = $result[2];

            echo "Sessions: " . $sessions . PHP_EOL;
            $amount = $this->calculate_amount($sessions, $premiumRates);
            echo "Amount: " . $amount . PHP_EOL;
            $this->update_amount($name,$amount,$link,$sessions);

            //echo $result[0] . ", ";
        }

        //return;
        foreach ($normalResults as $result){
            $name = $this->get_influencer_id($result[0]);
            $link = $result[1];
            $sessions = $result[2];

            $amount = $this->calculate_amount($sessions, $normalRates);

            $this->update_amount($name,$amount,$link,$sessions, 'update');
            //echo $result[0] . ", ";
        }
    }

    private function calculate_amount($sessions, $rates){
        $amount = ($sessions / 1000) * $rates;
        return $amount;
    }

    private function get_normal_rates(){
        $row = $this->CI->db->get_where('domain',array('url' => 'buzztache.com'));

        $row = $row->row();
        return $row->click_rate;
    }
    private function get_premium_rates(){
        $row = $this->CI->db->get_where('domain',array('url' => 'buzztache.com'));

        $row = $row->row();
        return $row->click_ratepre;
    }


    private function get_influencer_id($name)
    {
        //Debug:
        //$name = 'Pakistan_17';

        $name = explode("_",$name);

        //The ID
        $name = $name[1];
        return $name;
    }

    private function update_amount($name, $amount, $link, $sessions, $update = '')
    {
        echo $name;
        $result = $this->CI->db->get_where('influencer', array('id' => $name))->row();
        $currentPayment = $result->payment;
        echo 'current payment: ' . $currentPayment;
        $lastUpdated = $result->payment_last_updated;

        /*$lastUpdated = date_create($lastUpdated);
        $now = date_create(date("Y-m-d H:i:s"));
        $interval = date_diff($lastUpdated, $now);
        /*if ($interval < 1){
            return;
        }*/

        $now = date('Y-m-d H:i:s');
        $currentPayment = $currentPayment + $amount;
        $this->CI->db->where('id', $name);
        $data = array(
            'payment' => $currentPayment,
            'payment_last_updated' => $now
        );
        $this->CI->db->update('influencer', $data);

        //Add Data
        if ($update == 'update') {
            echo "Update: " . $update;
            $result = $this->CI->db->get_where('revenue_history', array('influencer_id' => $name))->row();
            print_r($result);
            if ($result) {
                $this->CI->db->where('date', $now);
                $this->CI->db->where('link', $link);
                $this->CI->db->where('influencer_id', $result->id);
                $data = array(
                    'normal_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                $this->CI->db->update('revenue_history', $data);
            }else{
                echo "insert revenue history";
                $data = array(
                    'date' => $now,
                    'link' => $link,
                    'influencer_id' => $name,
                    'normal_visit' => $sessions,
                    'revenue_generated' => $amount
                );
                $this->CI->db->insert('revenue_history', $data);
            }

        }else{
            echo "insert premium data";
            $data = array(
                'date' => $now,
                'link' => $link,
                'influencer_id' => $result->id,
                'premium_visit' => $sessions,
                'revenue_generated' => $amount
            );
            $this->CI->db->insert('revenue_history', $data);
        }


    }
}