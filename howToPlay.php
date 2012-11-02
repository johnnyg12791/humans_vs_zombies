<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           How To Play
 * Location:        "/howToPlay.php"
 * 
 * Description:     How to play
 * 
 * Author:          author
 * Date:            date
 * Version:         1.1
 * *****************************************************************************
 * *****************************************************************************
 */
 


// initialise the app
// init.php contains all facebook sdk info, session control, and the works
require_once('core/init.php');


?>

<html>

<?php

// generate page title and include the header
// $header_title is passed in the header.php file
$header_title = "Welcome";
include('inc/header.php');


// copy up to here and paste in all your new files. This will make starting a new file 
// a hundred times easier

?>

<body>


<div data-role="page">

	<div data-role="header">
		<a href="welcome.php" data-icon="arrow-l">Back</a>
		<h1>Help</h1>
	</div><!-- /header -->

	<div data-role="content">
		<!-- TODO: link to settings here -->
		<div data-role="collapsible">
		   <h3>Game Play</h3>
		   <p>This is an Alternate Reality Game. It is played in the real world, but also occurs virtually.<br>
		The objective of the game is to be the last human standing.<br>
		Each game starts with 1 zombie, randomly choosen, and that person can attack humans when close enough.<br>
		When attacked, a human then becomes a zombie, and has the power to attack humans after that. <br></p>
			<div data-role="collapsible">
			<h4>Being a Human</h4>
			<ul>
			<li>Your objective is to survive as long as possible.</li>
			<li>Your game map shows other humans as blue dots, and zombies as red triangles. If you see a zombie approaching you run away!</li>
			<li>Above the map you can see the number of hours you have survived, an option to resign from the game, and an option to view more information on the players in the game.</li>
			<li>In the bottom right corner of the map you can find the current number of zombies and number of humans in the game.</li>
			<li>That's all you need to know, be the last human standing!</li>
			</ul>
			</div>
			<div data-role="collapsible">
			<h4>Being a Zombie</h4>
			<ul>
			<li>Your objective is to convert as many humans into zombies as possible.</li>
			<li>Your game map shows humans as blue dots, and other zombies as red triangles. If you see a human nearby, run towards them until you are close enough to attack!</li>
			<li>When you are close enough to attack a human the attack button above your map will light up.</li>
			<li>Also above the map you can see the number of humans you have converted, an option to resign from the game, and an option to view more information on the players in the game.</li>
			<li>In the bottom right corner of the map you can find the current number of zombies and number of humans in the game.</li>
			<li>That's all you need to know, go attack the humans!</li>
			</ul>
			</div>
		</div>	
		<div data-role="collapsible">
		   <h3>Creating a New Game</h3>
		   <ol>
		   <li>You can create a new game from the homescreen, or through the navigation bar at the bottom of the screen.</li>
		   <li>Choose a name for your game and select a date and time for when you would like your game to start.</li>
		   <li>Set your game to public (anyone can join), or private (only invited friends can join).</li>
		   <li>Press Go! and your selected friends will be invited to join your new game!</li>
			</ol>
		</div>
		<div data-role="collapsible">
		   <h3>Searching For Games</h3>
		   <ol>
		   <li>You can search for existing games from the homescreen, or through the navigation bar at the bottom of the screen.</li>
		   <li>You can search for existing games by the game name, by a friend's name, or by location.</li>
		   <li>A list of games that matched your search criteria will appear. Only games that have not yet started will appear.</li>
		   <li>Press Join! to get in on the game.</li>
			</ol>
		</div>
		<br><br><br>
		
		<!-- START OF FACEBOOK CODE -->
		<div id="fb-root"></div>
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

		    
		  // Load the SDK Asynchronously
		  (function(d){
		     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement('script'); js.id = id; js.async = true;
		     js.src = "//connect.facebook.net/en_US/all.js";
		     ref.parentNode.insertBefore(js, ref);
		   }(document));
		   
		   
		</script>   
		<a href="#" onclick="getUserFriends();">Get friends</a><br>
		<div id="user-friends"></div>
		<script>
		  function getUserFriends() {
		    FB.api('/me/friends&fields=name,picture', function(response) {
		      console.log('Got friends: ', response);
		      
		      if (!response.error) {
		        var markup = '';
		        
		        var friends = response.data;
		        
		        for (var i=0; i < friends.length && i < 25; i++) {
		          var friend = friends[i];
		          
		          markup += '<img src="' + friend.picture + '"> ' + friend.name + '<br>';
		        }
		        
		        document.getElementById('user-friends').innerHTML = markup;
		      }
		    });
		  }
	  </script>

	
	
	
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div>

</div><!-- /page -->



</body>
</html>