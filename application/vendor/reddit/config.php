<?php
class redditConfig{
    //standard, oauth token fetch, and api request endpoints
    static $ENDPOINT_STANDARD = 'http://www.reddit.com';
    static $ENDPOINT_OAUTH = 'https://oauth.reddit.com';
    static $ENDPOINT_OAUTH_AUTHORIZE = 'https://www.reddit.com/api/v1/authorize';
    static $ENDPOINT_OAUTH_TOKEN = 'https://www.reddit.com/api/v1/access_token';
    static $ENDPOINT_OAUTH_REDIRECT = 'http://acquire.social/register/redditcallback';
    
    //access token configuration from https://ssl.reddit.com/prefs/apps

    //acquire.local
     static $CLIENT_ID = 'FpksbSh7k3cE5w';

    //Locahost
   // static $CLIENT_ID = 'issCsfAaEDAC7A';

    //acquire
     static $CLIENT_SECRET = 'R8dbvBay_khvbgrW7BhuWnCHjqw';

    //localhost
    //static $CLIENT_SECRET = 'gZ7SQQgDIbbXJvNhiqD5rIwtDaQ';
    
    //access token request scopes
    //full list at http://www.reddit.com/dev/api/oauth
    //static $SCOPES = 'save,modposts,identity,edit,flair,history,modconfig,modflair,modlog,modposts,modwiki,mysubreddits,privatemessages,read,report,submit,subscribe,vote,wikiedit,wikiread';
    static $SCOPES = 'identity';
}
?>
