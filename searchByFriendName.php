<?php
require_once('core/init.php');

?>

<html>

<body>

<?php
$friend_name = $_POST['friend_name'];

include("core/db/dbConfig.php");

$current_time = time();

$result = mysql_query("SELECT fb_id, fb_name, Games.game_id, Games.start_time, game_name FROM Game_Player_Info, Fb_Id_Name, Games WHERE fb_id = player_id AND Game_Player_Info.game_id = Games.game_id AND fb_name LIKE '%" . $friend_name . "%'");

//convert all to lower case and search that way as well???

while($row = mysql_fetch_array($result)){
	if (strtotime($row['start_time']) > $current_time) {
		echo "You found the game <b>" . $row['game_name'] . "</b> with player " . $row['fb_name'];
		echo "<form method='post' action='join.php'><input name='game_id' value=" . $row['game_id'] . " type='hidden'> <input name='submitJoin' type='submit'value='Join'> </form>";
	}
}



?>


</body>

</html>
