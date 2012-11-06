<?
session_start();
?>

<html>
<body>

<?


$inviter_id = $_SESSION['user_fb_id'];
$invitee_id = $_POST['friend_id'];
$game_id = $_POST['game_id'];

$invitee_name = $_SESSION['user_fb_name'];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];

$query = "Update Game_Invites where game_id = '$game_id' and inviter_id = '$inviter_id' and invitee_id = 'invitee_id' set accepted = 1;";"
$result = mysql_query($query);
if($result)
	echo "successfully accepted invite";
else
	echo "invite not accepted correctly";
	
	
	
$query2 = "insert into Game_Player_Info (game_id, player_id, player_name, recent_latitude, recent_longitude) values ('$game_id', '$invitee_id', '$invitee_name', '$latitude', '$longitude');";
$result2 = mysql_query($query2);
if($result2)
	echo "joined the game database";
else
	echo "could not join game database";

?>

</body>
</html>