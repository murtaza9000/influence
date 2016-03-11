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

    }

    private function getService()
    {
        // Creates and returns the Analytics service object.

        // Load the Google API PHP Client Library.
        require_once __DIR__.'../vendor/google-api-php-client/src/Google/autoload.php';

        // Use the developers console and replace the values with your
        // service account email, and relative location of your key file.
        $service_account_email = 'testaccount@operating-rush-124305.iam.gserviceaccount.com';
        $key_file_location = './client_key.p12';

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
                    if ($profiles[$k]->getName() == 'www.automark.pk') {
                        return $profiles[$k]->getId();
                    }
                }
            }

        }
    }

    private function getResults(&$analytics, $profileId) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        $optParams = array(
            'dimensions' => 'ga:source',

            'filters' => 'ga:medium==Social;ga:country==United States,ga:country==Canada,ga:country==Australia,ga:country==United Kingdom');
        return $analytics->data_ga->get(
            'ga:' . $profileId,
            '7daysAgo',
            'today',
            'ga:sessions');
        //,$optParams);
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
}