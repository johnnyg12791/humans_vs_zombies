<?
session_start();
?>

<html>
<body>

<?

$inviter_id = $_SESSION['fb_user_id'];
$invitee_id = $_POST['friend_id'];
$game_id = $_POST['game_id'];

$query = "Insert into Game_Invites (game_id, inviter_id, invitee_id, accepted) values ('$game_id', '$inviter_id', '$invitee_id', 0);";"
$result = mysql_query($query);
if($result)
	echo "successfully invited";
else
	echo "invite didn't go though";

?>

</body>
</html>