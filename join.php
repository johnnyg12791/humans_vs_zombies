<?
session_start();
?>

<html>
<body>
<!-- called when a user joins a game after searching (by friend name or game name) -->
<?
include("core/db/dbConfig.php");
$game_id = $_POST['game_id']; 
/*name and id stored in session variables*/
$player_id = $_SESSION['user_fb_id'];
$player_name = $_SESSION['user_fb_name'];
/*basically get current latitude and longitude*/
/*maybe can also use get/post requests*/
$recent_latitude = 4;
$recent_longitude = 5;

$query = "insert into Game_Player_Info (game_id, player_id, player_name, recent_latitude, recent_longitude) values ('$game_id', '$player_id', '$player_name', '$latitude', '$longitude');";
$result = mysql_query($query);


if($result) {
	echo "good stuff, submitted to database";
} else {
	echo "database submit error";
}

?>


<html>
<body>
