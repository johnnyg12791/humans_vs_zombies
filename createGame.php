<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Create Game
 * Location:        "/createGame.php"
 * 
 * Description:     Create a new game
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
$header_title = "Create Game";
include('inc/header.php');

?>

	<body>
    
    <div data-role="page">

	<div data-role="header">
		<h1>Create New Game</h1>
	</div><!-- /header -->

	<div data-role="content">

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
	
	
	<ul data-role="listview" data-inset="true" id="beforeCreatedGame">
	<div id="createGame">
    	<h1>Enter Game Name and Time to start</h1>
    	
        	<input id="game_name" name = "game_name" type="text" placeholder="Enter Game Name" autofocus required>   
        	<input id="start_date" name = "start_date" type="date" placeholder="Enter Start Date">
            <input id="latitude" name = "latitude" type="hidden">
            <input id="longitude" name = "longitude" type="hidden">
        	<input id="submit" type="button" value="Go">
	</div>
	</ul>
	
	<div id="GameCreatedResults"></div>
	<div id="FriendsList"></div>
	
	</div><!-- /content -->
	
	<!--submit search for game name script -->
	<script type="text/javascript">
	$("#submit").click(function(event) {
		//makes sure the time choosen is in the future
		var pickedTime = (new Date($('#start_date').val())).getTime()/1000;
		var currentTime = Math.round(new Date().getTime()/1000);
		if (pickedTime < currentTime){
			alert("This date is in the past, choose a time in the future");	
			return;
		}
		
		
		$.post("submitCreateGame.php", {game_name: $("#game_name").val(), 
			start_date: $("#start_date").val(),
			latitude : $("#latitude").val(),
			longitude : $("#longitude").val() }, function(data){
				$("#GameCreatedResults").html(data);
				//this removes the form
				$("#createGame").hide();
		});
	});
	
	</script>
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	 ?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->
	
    </body>

	
</html>