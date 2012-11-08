<?php
require_once('core/init.php');

?>

<html>
<head>

</head>

<body>

<script>
       	var latitude = 0;
		var longitude = 0;
		if (navigator.geolocation) {
			var timeoutVal = 10 * 1000 * 1000;
			navigator.geolocation.getCurrentPosition(
				setLatAndLong, 
				displayError,
				{ enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
			);
		}
		else {
			alert("Geolocation is not supported by this browser");
		}
			
		function setLatAndLong(position) {
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
			document.getElementById("latitude").value = latitude;
			document.getElementById("longitude").value = longitude;
		}
			
		function displayError(error) {
			var errors = { 
				1: 'Permission denied',
				2: 'Position unavailable',
				3: 'Request timeout'
			};
			alert("Error: " + errors[error.code]);
		}		
</script>

<?php
$game_name = $_POST['game_name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

include("core/db/dbConfig.php");

$current_time = time();

echo $user_id . "<br>";

$query = "SELECT * FROM Games WHERE game_name LIKE '%$game_name%' ORDER BY start_time";

/*$query = "SELECT distinct Games.game_id, Games.creator_id, Fb_Id_Name.fb_name, Fb_Id_Name.fb_id, game_name, start_time " . 
		"FROM Games, Game_Player_Info, Fb_Id_Name " . 
		"WHERE game_name fb_id in (SELECT * FROM Games WHERE game_name LIKE '%$game_name$%') ORDER BY start_time"; */
		//AND creator_id != '$user_id' and player_id != '$user_id' ORDER BY start_time";
		//"WHERE Games.game_id = Game_Player_Info.game_id AND Games.creator_id = Fb_Id_Name.fb_id AND game_name LIKE '%$game_name%' ORDER BY start_time";

$result = mysql_query($query);

$i = 0;
echo "latitude is: " . $latitude . "<br>" . $longitude . "<br>";

while($row = mysql_fetch_array($result)){
	if (strtotime($row['start_time']) > $current_time and $row['creator_id'] != $user_id) {
		echo $i;
		echo "You found the game <b>" . $row['game_name'] . "</b>" . " created by " . $row['fb_name'] . ". Starting on " . $row['start_time'];
		?>
		
		<div id="joinGame_<?=$i?>">
           	 	<input id="game_id_<?=$i?>" name="game_id" value="<?=$row['game_id']?>" type="hidden">
           	 	<input id="inviter_id_<?=$i?>" name="inviter_id" value="<?=$row['creator_id']?>" type="hidden">
           	 	<input id="invitee_id_<?=$i?>" name="inviter_id" value="<?=$user_id?>" type="hidden">
           		<input id="latitude_<?=$i?>" name="latitude" type="hidden">
           		<input id="longitude_<?=$i?>" name="longitude" type="hidden">
        		<input id="submit_<?=$i?>" name="submit" type="submit" value="Join">
		</div>
		
		<div id="joinText_<?=$i?>"></div>
			
		<script type="text/javascript">
				
			$("#submit_<?=$i?>").click(function(event) {
				alert("just joined a game");
				$.post("join.php", {game_id: $("#game_id_<?=$i?>").val(), inviter_id: $("#inviter_id_<?=$i?>").val(), 
					invitee_id: $("#invitee_id_<?=$i?>").val() },
						function(data){			
						$("#submit_<?=$i?>").hide();
						$("#joinText_<?=$i?>").html("Joined!");
				});				
			});
		</script>
	

			
		<?php
	}
	++$i;
}


?>

</body>
</html>