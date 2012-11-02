<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Create Game
 * Location:        "/createGame.php"
 * 
 * Description:     Create a new game
 * 
 * Author:          author
 * Date:            date
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


// copy up to here and paste in all your new files. This will make starting a new file 
// a hundred times easier

?>


	<body onload = "getLocation()" >
    
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
	
	
	<ul data-role="listview" data-inset="true">
	<form action="submitCreateGame.php" method="post" id="createGame">
    	<h1>Enter Game Name and Time to start</h1>
    	<fieldset id="inputs">
        	<input id="game_name" name = "game_name" type="text" placeholder="Enter Game Name" autofocus required>   
        	<input id="start_date" name = "start_date" type="date" placeholder="Enter Start Date">
            <input id="latitude" name = "latitude" type="hidden">
            <input id="longitude" name = "longitude" type="hidden">
    	</fieldset>
    	
    	<fieldset id="actions">
        	<input type="submit" id="submit" value="Go">
    	</fieldset>
	</form>
	</ul>
	
	</div><!-- /content -->
	
	<!--submit search for game name script -->
	<script type="text/javascript">
	$("#createGame").click(function() {
		event.preventDefault();
		$.post("submitCreateGame.php", $("#createGame").serialize(), function(data){
			$("#GameNameResults").html(data);
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