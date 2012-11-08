<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Games Nearby
 * Location:        "/gamesNearby.php"
 * 
 * Description:     A page that tries to find games near the current location
 * 
 * Author:          John Gold
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
$header_title = "Games Nearby";
include('inc/header.php');


?>

<body>
	

<div data-role="page">

	<div data-role="header">
		<h1>Games Nearby</h1>
	</div><!-- /header -->


	<div data-role="content">
	
	
		<?
		
		$curLatitude = $_POST['latitude'];
		$curLongitude = $_POST['longitude'];
		echo "Your current latitude = $curLatitude, and your current longitude = $curLongitude. <br>";
		echo "All of these games were created within 1 mile of your current location. <br>";
		
		$query = "SELECT * FROM Games;";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			?>
			
			
			<script>
			var lat1 = <?=$curLatitude?>;
			var lon1= <?=$curLongitude?>;
			var lat2 = <?=$row['latitude']?>;
			var lon2 = <?=$row['longitude']?>;
			
			if (getDistance(lat1, lon1, lat2, lon2) < 1){ //if the game was created within 1 mile of your location		
			</script>
				
			<!--some sort of listview? -->
				<div id = "clickToJoin">
					<input name='game_id' id="game_id" value="<?=$row['game_id']?>" type='hidden'>
					<input name='latitude' id='latitude' value='<?=curLatitude?>' type='hidden'>
					<input name='longitude' id='longitude' value='<?=curLongitude?>' type='hidden'>
					<input name='accept' id="submitJoinNearby" type='submit' value="Join Game <?=$row['game_name']?>" >
				</div>
				
			<script>
			}
			</script>
		<?	
		}//end of while loop
		?>
	
	
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
		<?php
			include('inc/navBar.php');
		?>
	</div><!-- /footer -->
	
</div><!-- /page -->
	



	<script>
	//Got this function from "http://www.movable-type.co.uk/scripts/latlong.html"
	function getDistance(lat1, lon1, lat2, lon2){
		var R = 6371; // km
		var dLat = (lat2-lat1).toRad();
		var dLon = (lon2-lon1).toRad();
		lat1 = lat1.toRad();
		lat2 = lat2.toRad();
		var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
	        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		var d = R * c * .621371; // * mile conversion
		d = d.toFixed(3);
		return d;
	}
	/** Converts numeric degrees to radians (From stackoverflow) */
	if (typeof(Number.prototype.toRad) === "undefined") {
	  Number.prototype.toRad = function() {
	    return this * Math.PI / 180;
	  }
	}
	
	//AJAX
	$("#submitJoinNearby").click(function(event) {
		$.post("join.php", {
			game_id: $("#game_id").val(), 
			latitude : $("#latitude").val(),
			longitude : $("#longitude").val() }, function(data){
				$("#GameCreatedResults").html(data);
				//this removes the form
				$("#createGame").hide();
		});
	});
			
	<script>
	
    </body>
</html>







