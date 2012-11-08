<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Game Details
 * Location:        "/gameDetails.php?id=(id_num)"
 * 
 * Description:     This will show more game details, with player names, num_bites
 * 
 * Author:          John Gold / Lucille Benoit
 * Date:            11/5/12
 * Version:         1.1
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
$header_title = "More Details";
include('inc/header.php');
?>


<body>
	<?php
		$game_id = $_GET['game_id'];
		
		$query = "select game_name from Games where game_id = '$game_id'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		$game_name = $row['game_name'];


		$queryPlayers = "SELECT fb_name, recent_latitude, recent_longitude, is_human, num_bites FROM Game_Player_Info, Fb_Id_Name WHERE fb_id = player_id AND game_id = '$game_id' ORDER BY num_bites DESC";
		$resultPlayers = mysql_query($queryPlayers);
		$counter = 0;
		$playersArray = array();
		while($row = mysql_fetch_assoc($resultPlayers)){
			
			$player['fb_name'] = $row['fb_name'];
			$player['latitude'] = $row['recent_latitude'];
			$player['longitude'] = $row['recent_longitude'];
			$player['is_human'] = $row['is_human'];
			$player['num_bites'] = $row['num_bites'];
			$playersArray[$counter] = $player;
			$counter++;
		}
		
	//This gets the number of humans and zombies (probably not the most effifcient...	
	$humansQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 1;";
	$zombiesQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 0;";
	$num_humansArray = mysql_fetch_assoc(mysql_query($humansQuery));
	$num_zombiesArray = mysql_fetch_assoc(mysql_query($zombiesQuery));
	$num_humans = $num_humansArray['num'];
	$num_zombies = $num_zombiesArray['num'];

	?>
	



<div data-role="page">
	
	<div data-role="header">
		<a onclick="history.back(-1)" data-icon="arrow-l">Back</a>
		<h1><?=$game_name?></h1>
	</div><!-- /header -->
	
	<div data-role="content">
	
	<?php
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
			$num_hours_so_far = floor(($now - $start)/3600);
			echo "It has been going on for $num_hours_so_far hours";
		}
		
	?>
	
	<h3 style="text-align:center;">Game: <?=$game_name?> </h3>

		<p></p>
		<ul data-role="listview" data-inset="true" data-filter="true">
			
			<?php
			for($i = 0; $i < count($playersArray); $i++){
				echo "<li>" . $playersArray[$i]['fb_name'];
				if($playersArray[$i]['is_human']){
					echo " is a Human";
				}else{
					echo " is a Zombie and has bitten ";
					echo $playersArray[$i]['num_bites'] . " humans";
				}
				echo "</li>";
			}
			?>
		</ul>
		<h5 style="text-align:right;"> Humans: <?=$num_humans?> Zombies: <?=$num_zombies?> <h5>
	</div> <!-- end of content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	?>
	
	</div> <!-- end of footer -->
	
	</div> <!-- end of page -->
	
	</body>
</html>