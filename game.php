<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Games
 * Location:        "/game.php"
 * 
 * Description:     This will show the main map of the game, all the impt info
 * 
 * Author:          John Gold
 * Date:            11/1/12
 * Version:         1.0
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
$header_title = "Game";
include('inc/header.php');
?>

<body>
<?
$game_id = $_POST['game_id'];

$nameQuery = "select game_name from Games where game_id = '$game_id';";
$humansQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 1;";
$zombiesQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 0;";
$startTimeQuery = "select start_time from Games where game_id = '$game_id';";

$game_nameArray = mysql_fetch_assoc(mysql_query($nameQuery));
$num_humansArray = mysql_fetch_assoc(mysql_query($humansQuery));
$num_zombiesArray = mysql_fetch_assoc(mysql_query($zombiesQuery));
$start_timeArray = mysql_fetch_assoc(mysql_query($startTimeQuery));


$game_name = $game_nameArray['game_name'];
$num_humans = $num_humansArray['num'];
$num_zombies = $num_zombiesArray['num'];
$start_timestamp = $start_timeArray['start_time'];
//$start_time = strtotime($start_timestamp)
date_default_timezone_set('America/Los_Angeles'); //just get users actual time zone
$cur_date = date('Y-m-d h:i:s', time());

echo "This is game id = $game_id<br>";
echo "The game name is = $game_name<br>";
echo "The num_humans is = $num_humans<br>";
echo "The num_zombies is = $num_zombies<br>";

//echo "This game has not yet started, it will start on $start_time<br>";
$now = time();
$start = strtotime($start_timestamp);
echo "it is currently $now, then start, $start<br>";




if ($now < $start) {
	//echo "This game has not yet started, it will start on $start_time<br>";
	$num_hours_till_start = ($start - $now)/3600;
	//$start_date_info = date('Y-m-d h:i:s', $start - $now)
	echo "That is in $num_hours_till_start hours";
} else {
	//echo "This game started on = $start_timestamp<br>";
	$num_hours_so_far = ($now - $start)/3600;;
	echo "It has been going on for $num_hours_so_far hours";
}

?>
</body>
</html>