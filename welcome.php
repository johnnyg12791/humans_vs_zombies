<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Welcome
 * Location:        "/welcome.php"
 * 
 * Description:     The welcome page for the application
 					Users see this after they log in, or continue without 
 					logging in
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

    <?php
    if($user_id) {
		
      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "Name: " . $user_profile['name'];
        
        echo "<br>";
        
        $uid = $facebook->getUser();
        echo "ID: " . $uid;
        
		echo "<br>";
        
		$_SESSION['user_fb_id']= $uid;
		$_SESSION['user_fb_name']= $user_profile['name'];

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a><br>';
        echo 'Error';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo 'Please <a href="' . $login_url . '">login.</a><br>';
    }
  ?>

    <div data-role="page">
	<div data-role="header">
		<h5>Humans vs Zombies</h5>
	</div><!-- /header -->

	<div data-role="content">
	
		<ul data-role="listview" data-inset="true">	
		<div data-role="collapsible-set">
			<div data-role="collapsible" data-inset="true">
				<h3>Current Games</h3>
				<ul data-role="listview" data-inset="true">
					<?php
					$query = "SELECT * FROM Game_Player_Info, Games where player_id = '$uid' and Games.game_id = Game_Player_Info.game_id";
					$result = mysql_query($query);
					while ($row = mysql_fetch_assoc($result)) {
						echo "Game Name: " . $row['game_name'];
						echo "<li><form method='post' action='game.php'>";
						echo "<input name='game_id' value=" . $row['game_id'] . " type='hidden'>";
						echo "<input name='submit' type='submit'value='Play'>"; 
						echo "</form></li>";
					}  
					?>
					<li><a href="game1.php">Game 1</a></li>
					<li><a href="game2.php">Game 2</a></li>
				</ul>
			</div>
			<div data-role="collapsible" data-inset="true">
				<h3>Game Invites</h3>
				<ul data-role="listview" data-inset="true">
				<?php
					//select the games where the current user is the one being invited
					$query = "SELECT * FROM Games, Game_Player_Info, Game_Invites where invitee_id = '$uid' and Games.game_id = Game_Player_Info.game_id and Game_Invites.inviter_id = Game_Player_Info.player_id;";
					$result = mysql_query($query);
					while ($row = mysql_fetch_assoc($result)) {
						echo "You were invited by ". $row['player_name'];
						echo " to the game: " . $row['game_name'];
						echo "<br>";
						echo "<li><form method='post' action='inviteAccepted.php'>";
						echo "<input name='game_id' value=" . $row['game_id'] . " type='hidden'>";
						echo "<input name='invitee_id' value=" . $row['invitee_id'] . " type='hidden'>";
						echo "<input name='latitude' value='1' type='hidden'>";
						echo "<input name='longitude' value='1' type='hidden'>";
						echo "<input name='accept' type='submit' value='Accept Invite'>";
						echo "</form></li>";
					}  
					?>
					<li>See game 3</li>
					<li>See game 4</li>
				</ul>
			</div>
		</div><!--end of collapsible set -->
		
		<li><a href="createGame.php">Create A New Game</a></li>
	    <li><a href="searchForGames.php">Search For Games</a></li>
	    <li><a href="howToPlay.php">Help</a></li>
	    <li><a href="settings.php">Settings</a></li>
		</ul>
		
		  
   <a href="#" onclick="getUserFriends();">Get friends</a><br>
 <div id="user-friends"></div>
 <script>
 function getUserFriends() {
   FB.api('/me/friends&fields=name,picture', function(response) {
     console.log('Got friends: ', response);

     if (!response.error) {
       var markup = '';

       var friends = response.data;

       for (var i=0; i < friends.length && i < 250; i++) {
         var friend = friends[i];


       }

       document.getElementById('user-friends').innerHTML = markup;
     }
     
     else {

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
	
	</div><!-- /page -->
	
    </body>

</html>