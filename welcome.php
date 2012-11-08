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
 * Author:          John
 * Date:            11/7/12
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


?>

<body>
    <div data-role="page">
	<div data-role="header">
		<h5>Humans vs Zombies</h5>
	</div><!-- /header -->

	<div data-role="content">
	
		<ul data-role="listview" data-inset="true">	
			<div data-role="collapsible-set">
				<div data-role="collapsible" data-inset="true">
					<h3>My Games</h3>
					<ul data-role="listview" data-inset="true">
						<?php
						$uid = $user_id;
						$query = "SELECT * FROM Game_Player_Info, Games where player_id = '$uid' and Games.game_id = Game_Player_Info.game_id;";
						$result = mysql_query($query);
						while ($row = mysql_fetch_assoc($result)) {
							echo "<li><a href='game.php?game_id=" . $row['game_id'] . "' data-ajax='false'>" . $row['game_name'] . "</a></li>";
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
						$uid = $user_id;
						//I think this query is correct now
						$query = "SELECT * FROM Games, Game_Invites, Fb_Id_Name where invitee_id = '$uid' and Games.game_id = Game_Invites.game_id and fb_id = inviter_id and accepted=0;";
						$result = mysql_query($query);
						$rowNum = 0;
						while ($row = mysql_fetch_assoc($result)) {
							echo $rowNum;
							echo "You were invited by ". $row['fb_name'];
							echo " to the game: " . $row['game_name'] . " and id=" . $row['game_id'];
							?>
							<div id="acceptInvite_<?=$rowNum?>">
								<input name='game_id' id="game_id_<?=$rowNum?>" value=" <?=$row['game_id']?>" type='hidden'>
								<input name='inviter_id' id="inviter_id_<?=$rowNum?>" value=" <?=$row['inviter_id']?>" type='hidden'>
								<input name='invitee_id' id="invitee_id_<?=$rowNum?>" value=" <?=$uid?>" type='hidden'>
								<input name='latitude' id='latitude' type='hidden'>
								<input name='longitude' id='longitude' type='hidden'>
								<input name='submit' id="submit_<?=$rowNum?>" type="submit" value='Accept Invite'>
							</div>
							<div id="invitedText_<?=$rowNum?>"></div>
							
							<script type="text/javascript">
							$("#submit_<?=$rowNum?>").click(function(event) {
								//FOR SOME REASON THIS CODE IS EXECUTING TWICE???
								$.post("inviteAccepted.php", {
									game_id: $("#game_id_<?=$rowNum?>").val(), 
									inviter_id: $("#inviter_id_<?=$rowNum?>").val(),
									invitee_id: $("#invitee_id_<?=$rowNum?>").val(),
									latitude : $("#latitude").val(),
									longitude : $("#longitude").val() 
								}, function(data){
									alert("Game Joined");
									//take you to the game.php?id=game_id page
									$("#acceptInvite_<?=$rowNum?>").hide();
									$("#invitedText_<?=$rowNum?>").html("Joined!");
								});
							});
							</script>
							
						<?php
						$rowNum++;	
						}  
						?>
					</ul>
				</div>
			</div><!--end of collapsible set -->
		
			<li><a href="createGame.php">Create A New Game</a></li>
	    	<li><a href="searchForGames.php">Search For Games</a></li>
	    	<li><a href="howToPlay.php">Help</a></li>
	    	<li><a href="settings.php">Settings</a></li>
		</ul>
		
		<?php
		if($user_id) {
			try {
				$fql = 'SELECT name, pic_square FROM user WHERE uid = me()';
				$ret_obj = $facebook->api(array(
           	     	                   'method' => 'fql.query',
                    	               'query' => $fql,
                        	         ));
                ?>
                <img src="<?php echo $ret_obj[0]['pic_square']; ?>"><br>
                <?php
               	echo $ret_obj[0]['name'] . '<br>';
			}
			catch(FacebookApiException $e) {
				$login_url = $facebook->getLoginUrl(); 
  		 	    echo 'Please <a href="' . $login_url . '">login.</a>';
   			    error_log($e->getType());
   		     	error_log($e->getMessage());
			}
		}
		?>
				
 		<div data-role="collapsible" data-inset="true">
 			<h3>See who's playing!</h3>
 			<ul data-role="listview" data-inset="true">
 				<?php
 				
 				$fql = 'SELECT uid, name, pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1 ORDER BY name';
        				$ret_obj = $facebook->api(array(
                	                   	'method' => 'fql.query',
                     	               	'query' => $fql,
                      		           	));
        
        				$count = count($ret_obj);
        				for ($i = 0; $i < $count; $i++) {
        					?>
        					<img src="<?=$ret_obj[$i]['pic_square']?>">
       						<?php
       						echo $ret_obj[$i]['name'] . '<br>';
        				}	
				?>
			</ul>
		</div>
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
		<?php
		include('inc/navBar.php');
		?>
	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->
	
	<script>
       	var latitude = 0;
		var longitude = 0;
		if (navigator.geolocation) {
			var timeoutVal = 10 * 1000 * 1000;
			navigator.geolocation.getCurrentPosition(
				setLatAndLong, 
				displayError,
				{ enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
			);
		}
		else {
			alert("Geolocation is not supported by this browser");
		}
			
		function setLatAndLong(position) {
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
			document.getElementById("latitude").value = latitude;
			document.getElementById("longitude").value = longitude;
		}
			
		function displayError(error) {
			var errors = { 
				1: 'Permission denied',
				2: 'Position unavailable',
				3: 'Request timeout'
			};
			alert("Error: " + errors[error.code]);
		}
		
	</script>
	
    </body>

</html>