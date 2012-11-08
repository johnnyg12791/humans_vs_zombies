<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Resign
 * Location:        "/resign.php"
 * 
 * Description:     Just a database request really
 * 
 * Author:          John Gold
 * Date:            11/2/12
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
$header_title = "Humans vs. Zombies";
include('inc/header.php');
?>

<body>

<? 

$player_id = $_POST['player_id'];
$game_id = $_POST['game_id'];

$query = "DELETE from GAME_PLAYER_INFO where game_id = '$game_id' and player_id = '$player_id';";
$result = mysql_query($query);

if($result)
	echo "successfully resigned";
else
	echo "error in resigning";

?>

</body>
</html>