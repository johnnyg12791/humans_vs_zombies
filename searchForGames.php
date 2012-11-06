<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Search For Games
 * Location:        "/searchForGames.php"
 * 
 * Description:     A search script to search for games
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
$header_title = "Search for Games";
include('inc/header.php');


?>


<body>
    
    
    <div data-role="page">

	<div data-role="header">
		<h1>Search For Games</h1>
	</div><!-- /header -->

	<div data-role="content">
	
		<ul data-role="listview" data-inset="true">	
			<div data-role="collapsible-set">
				<div data-role="collapsible" data-inset="true">
					<h3>Search by Game Name</h3>
					<ul data-role="listview" data-inset="true">
						<form id="searchByGameName" method="post" action="searchByGameName.php"  data-ajax="false">
        					<input id="gameName" name="game_name" type="text" placeholder="Enter Game Name" autofocus required>
					        <input type="submit" id="submit" value="Go">
						</form>
						<div id="GameNameResults"></div>
					</ul>
	        	</div><!-- end of collapsible -->
	        	
	        	<div data-role="collapsible" data-inset="true">
					<h3>Search by Friend Name</h3>
					<ul data-role="listview" data-inset="true">
						<form id="searchByFriendName" method="post" action="searchByFriendName.php"  data-ajax="false">
        					<input id="friendName" name="friend_name" type="text" placeholder="Enter Friend Name" autofocus required>
							<input type="submit" id="submit" value="Go">
						</form>
						<div data-role="listview" data-inset="true" id="FriendNameResults"></div>
					</ul>
	        	</div> <!-- end of collapsible -->
	        	
	        	</div> <!-- /end of collapsible set -->
	        	
			<li>
				<form id="gamesNearby" method="post" action="gamesNearby.php" data-ajax="false">
				<input id="latitude" name = "latitude" type="hidden">
            	<input id="longitude" name = "longitude" type="hidden">
            	<input id="submit" name = "submit" type = "submit" value="Search For Games Nearby">
            	</form>
			<!--<a href="gamesNearby.php">Find Games Near Me</a> -->
								</li>
		</ul> <!-- end of listview -->
		
	</div><!-- /content -->
	
	<!--submit search for game name script -->
	<script type="text/javascript">
	
	$("#searchByGameName").submit(function(event) {
		event.preventDefault();
		$.post("searchByGameName.php", $("#searchByGameName").serialize(), function(data){
			$("#GameNameResults").html(data);
		});
	});
	
	$("#searchByFriendName").submit(function(event) {
		event.preventDefault();
		$.post("searchByFriendName.php", $("#searchByFriendName").serialize(), function(data){
			$("#FriendNameResults").html(data);
		});
	});
	</script>
	
	<!--ideally can include geolocation.js instead of all this code, but it works for now -->
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
	
	
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	<?php
		include('inc/navBar.php');
	 ?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->
	
    </body>

	
</html>