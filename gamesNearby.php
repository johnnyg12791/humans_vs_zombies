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
	
	$query = "SELECT * FROM Games;";
	$result = mysql_query($query);
	$curLatitude = $_POST['latitude'];
	$curLongitude = $_POST['longitude'];
	
	echo "Your current latitude = $curLatitude, and your current longitude = $curLongitude<br>";
	
	while($row = mysql_fetch_array($result)){
		//echo "You found the game <b>" . $row['game_name'] . "</b> at lat= " . $row['latitude'] . " and long = " . $row['longitude'];
		//echo "The game " . $row['game_name'] . " was created ";
	?>
	
	<script>
	/** Converts numeric degrees to radians (From stackoverflow) */
	if (typeof(Number.prototype.toRad) === "undefined") {
	  Number.prototype.toRad = function() {
	    return this * Math.PI / 180;
	  }
	}

	var lat1 = <?=$curLatitude?>;
	var lon1= <?=$curLongitude?>;
	
	var lat2 = <?=$row['latitude']?>;
	var lon2 = <?=$row['longitude']?>;
	//Got this function from "http://www.movable-type.co.uk/scripts/latlong.html"
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
	if ( d < 1) //if the game was created within 1 mile of your location
		document.write("The game <?=$row['game_name']?> was created " + d + " miles from your current location");
	
	</script>
	
	<?	
		echo "<br>";
	}//end of while loop
	?>
	
	
	
	</div><!-- /content -->

	
	
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	<?php
		include('inc/navBar.php');
	 ?>
	</div><!-- /page -->
	

	
    </body>

	
</html>







