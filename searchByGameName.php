<?
session_start();
?>


<html>
<head>

</head>

<body>
<?php
$game_name = $_POST['game_name'];

include("core/db/dbConfig.php");

$result = mysql_query("SELECT Games.game_id, game_name, player_name FROM Games, Game_Player_Info where game_name = '$game_name' and Games.game_id = Game_Player_Info.game_id and creator_id = player_id");

while($row = mysql_fetch_array($result)){
	echo "You found the game <b>" . $row['game_name'] . "</b> created by " . $row['player_name'];
	echo "<form method='post' action='join.php'><input name='game_id' value=" . $row['game_id'] . " type='hidden'> <input name='submitJoin' type='submit'value='Join'> </form>";
}


?>

</body>
</html>