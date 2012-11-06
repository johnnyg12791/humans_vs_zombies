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
$header_title = "Help";
include('inc/header.php');

?>


<body>


<div data-role="page">

	<div data-role="header">
	<a onclick="history.back(-1)" data-icon="arrow-l">Back</a>
		
		<h1>Help</h1>
	</div><!-- /header -->

	<div data-role="content">
		<!-- TODO: link to settings here -->
	
		<div data-role="collapsible">
		   <h3>Game Play</h3>
		   <ul>
		   <li>This is a virtual reality Humans vs. Zombies game, so as you and your friends run around in real life, you will see them represented as humans and zombies moving around on your game map.</li>
		   <li>This red icon represents the zombies.</li>
		   <img src="http://android-emotions.com/wp-content/flagallery/zombie-run/zombie-run-cover.png">
		   <li>This blue icon represents the humans.</li>
		   <img src="http://icongal.com/gallery/image/45157/running_man_animation.png">
		   <li>Each game starts with 1 zombie, randomly choosen.</li>
		   <li>When a zombie is within 30 feet of a human he can attack, and that human then becomes a zombie.</li>
		   <li>The game ends when there is only one human standing.</li>
		   </ul>
			<div data-role="collapsible">
			<h4>Being a Human</h4>
			<ul>
			<li>Your objective is to survive as long as possible.</li>
			
			<li>If you see a zombie approaching you, run away!</li>
			<li>Above the map you can see the number of hours you have survived, an option to resign from the game, and an option to view more information on the players in the game.</li>
			<li>In the bottom right corner of the map you can find the current number of zombies and number of humans in the game.</li>
			<li>That's all you need to know, be the last human standing!</li>
			</ul>
			</div>
			<div data-role="collapsible">
			<h4>Being a Zombie</h4>
			<ul>
			<li>Your objective is to convert as many humans into zombies as possible.</li>
			<li>Your game map shows humans in blue, and other zombies in red. If you see a human nearby, run towards them until you are close enough to attack!</li>
			<li>When you are within 30 feet of a human you will be able to select their icon and attack!</li>
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