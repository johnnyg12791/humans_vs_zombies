<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Init
 * Location:        "/core/init.php"
 * 
 * Description:     The initialisation file for the app. This contains session info,
 *					includes the db config and other files, and includes facebook sdk 
 *					and respective functions. 
 *					
 *					TO USE THIS FILE, TYPE require_once('core/init.php'); AT THE TOP
 *					OF YOUR PHP SCRIPT. ALL FUNCTIONALITY IN THIS FILE WILL NOW 
 *					BE AVAILABLE IN YOUR SCRIPT
 * 
 * Author:          author
 * Date:            date
 * Version:         1.1
 * *****************************************************************************
 * *****************************************************************************
 */



// start php sessions
session_start();



// include db config
require_once('db/dbConfig.php');



// grab the facebook sdk
require_once('fb_sdk/facebook.php');

/*

// configure the fb app array
$config = array(
				'appId' => '170592053078647',
				'secret' => '2db5b8a6bb450555ece006bab737ad63',
				);

*/



// connect to app
$config = array();
$config['appId'] = '170592053078647';
$config['secret'] = '2db5b8a6bb450555ece006bab737ad63';
$config['fileUpload'] = false; // optional


// instantiate new oject
$facebook = new Facebook($config);
$user_id = $facebook->getUser();

$page_id = "170592053078647";

$pagefeed = $facebook->api("/" . $page_id . "/feed");

?>









<!-- START OF FACEBOOK CODE -->
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
	// Additional JS functions here
  	window.fbAsyncInit = function() {
    FB.init({
   		appId      : '170592053078647', // App ID
      	channelUrl : 'http://stanford.edu/~johngold/cgi-bin/humans_vs_zombies/channel.html', // Channel File
      	status     : true, // check login status
      	cookie     : true, // enable cookies to allow the server to access the session
      	xfbml      : true  // parse XFBML
    });
    
/*
    // Additional init code here
    FB.getLoginStatus(function(response) {
  		if (response.status === 'connected') {
    	// connected
    	
  		} else if (response.status === 'not_authorized') {
    	// not_authorized
    	//login();
  		} else {
    	// not_logged_in
    	//login();
  		}
 	});
  };
  
  
  //login info
  function login() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
            FB.api('/me', function(response) {
	        	alert('Good to see you, ' + response.name + '.');
   	 		});
        } else {
            // cancelled
        }
    	});
	}
*/

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   }
</script>