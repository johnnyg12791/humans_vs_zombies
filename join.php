<?php
	require_once('core/init.php');
?>

<html>

<body>
<!-- called when a user joins a game after searching (by friend name or game name) -->
<?


$game_id = $_POST['game_id']; 

$player_id = $_POST['invitee_id'];//CHECK THIS

/*basically get current latitude and longitude*/
/*maybe can also use get/post requests*/
$recent_latitude = $_POST['latitude'];
$recent_longitude = $_POST['longitude'];

$query = "insert into Game_Player_Info (game_id, player_id, recent_latitude, recent_longitude) values ('$game_id', '$player_id', '$latitude', '$longitude')";
$result = mysql_query($query);


if($result) {
	echo "good stuff, user joined the game_player_info database";
} else {
	echo "database submit error";
}

?>


<html>
<body>
