<?
session_start();

require_once('core/init.php');

?>


<html>
<head>

</head>

<body>
You just created a game. <br>
<?php
$name = $_POST["game_name"];
$date = $_POST["start_date"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$creator_id = $_SESSION['user_fb_id'];
$creator_name = $_SESSION['user_fb_name'];
echo "the latitude = $latitude, and the longitude = $longitude.<br>";
//echo "The game you created is called: $name, the game will start on $date";

include("core/db/dbConfig.php");

$query = "insert into Games (game_name, creator_id, latitude, longitude, start_time) values ('$name', '$creator_id', '$latitude', '$longitude', '$date');";

$result = mysql_query($query);

/*this is to get the game_id of the game just created */
$query2 = "SELECT game_id from Games where game_name = '".$name."'";
$game_id_result = mysql_query($query2);
$row = mysql_fetch_assoc($game_id_result);
$game_id = $row["game_id"];


echo "and the game id is $game_id<br>";
echo "the player name is $creator_name<br>";

?>


<?php
if ($user_id) {
	try {
		$fql = 'SELECT uid, name, pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1 ORDER BY name';
		$ret_obj = $facebook->api(array(
                                   'method' => 'fql.query',
                                   'query' => $fql,
                                 ));
                                 
		$count = count($ret_obj);
		?>
		<h3>Select friends to invite!</h3>
		<?php
		for ($i = 0; $i < $count; $i++) {
        	?>
        	<img src="<?php echo $ret_obj[$i]['pic_square']; ?>">
       		<?php
       		echo $ret_obj[$i]['name'];
       		// echo $ret_obj[$i]['uid'];
       		?>
       		<div>
       			<form action="invite.php" method="post" id="inviteFriend_<?php echo $ret_obj[$i]['uid']; ?>">
       		
            	<input id="friend_id" name="friend_id" value="<?php echo $ret_obj[$i]['uid']; ?>" type="hidden">
           	 	<input id="game_id" name="game_id" value="<?php echo $game_id; ?>" type="hidden">
            
        		<input id="submit" type="submit" value="Invite">
				</form>
			</div>
			
			<script>
				
				$("#inviteFriend_<?php echo $ret_obj[$i]['uid']; ?>").submit(function(event) {
					alert("just invited a friend");
					event.preventDefault();
					$.post("invite.php", $("#inviteFriend_<?php echo $ret_obj[$i]['uid']; ?>").serialize(), function(data){
						$("#inviteFriend_<?php echo $ret_obj[$i]['uid']; ?>").html = "Invited!";
					});
				});
			</script>

       		<?php
       		echo '<br>';
        }
	}
	catch(FacebookApiException $e) {
		$login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
	}		
}
?>

	

<?php

$query3 = "insert into Game_Player_Info (game_id, player_id, player_name, recent_latitude, recent_longitude) values ('$game_id', '$creator_id', '$creator_name', '$latitude', '$longitude');";
$result2 = mysql_query($query3);
/*this is just for testing that the queries worked*/
	if ($result2) {
		//echo "good query for GamePlayerInfo<br>";
	} else {
		//echo "bad query for GamePlayerInfo<br>";
	}

	if ($result) {
		//echo "good query for Games<br>";
	} else {
		//echo "bad query for Games";
	}

?>
</body>

</html>