<?php
session_start();
?>

<html>

<body>

<?php
$friend_name = $_POST['friend_name'];

include("core/db/dbConfig.php");

$result = mysql_query("SELECT game_id, game_name, player_name FROM Game_Player_Info join Games using(game_id) where player_name = '$friend_name'");


while($row = mysql_fetch_array($result)){
	echo "You found the game <b>" . $row['game_name'] . "</b> with player " . $row['player_name'];
	echo "<form method='post' action='join.php'><input name='game_id' value=" . $row['game_id'] . " type='hidden'> <input name='submitJoin' type='submit'value='Join'> </form>";
}



?>


</body>

</html>
