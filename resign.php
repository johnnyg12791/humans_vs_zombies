<html>
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