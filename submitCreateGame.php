<?
session_start();
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


$query3 = "insert into Game_Player_Info (game_id, player_id, player_name, recent_latitude, recent_longitude) values ('$game_id', '$creator_id', '$creator_name', '$latitude', '$longitude');";
$result2 = mysql_query($query3);


/*this is just for testing that the queries worked*/
	if ($result2) {
		echo "good query for GamePlayerInfo<br>";
	} else {
		echo "bad query for GamePlayerInfo<br>";
	}

	if ($result) {
		echo "good query for Games<br>";
	} else {
		echo "bad query for Games";
	}

?>
</body>

</html>