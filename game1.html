<!DOCTYPE html>
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
		<h1>Game 1</h1>
	</div><!-- /header -->

	<div data-role="content">
	

		    <h4 style="text-align:center;">You are a Human!</h4>
		    <p> Hours survived: 3<p>
		
			<div data-role="controlgroup" data-type="horizontal">
				<a data-role="button" onclick="getLocation()" data-icon="refresh" data-iconpos="top" data-mini="true" data-inline="true">Refresh</a>
				<a href="welcome.php" data-role="button" data-icon="delete" data-iconpos="top" data-mini="true" data-inline="true">Resign</a>
				<a data-role="button" data-icon="arrow-r" data-iconpos="top" data-mini="true" data-inline="true">More</a>
			</div>
	
		<div id="mapholder"></div>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script>
		var x=document.getElementById("demo");
		getLocation();
		function getLocation(){
	  		if (navigator.geolocation){
	   	 		navigator.geolocation.getCurrentPosition(showPosition,showError);
	    	}else{x.innerHTML="Geolocation is not supported by this browser.";}
	  	}
  
		function showPosition(position){
		  lat=position.coords.latitude;
		  lon=position.coords.longitude;
		  latlon=new google.maps.LatLng(lat, lon);
		  mapholder=document.getElementById('mapholder');
		  mapholder.style.height='400px';
		  mapholder.style.width='device-width';
		  var myOptions={
			  center:latlon,zoom:17,
			  mapTypeId:google.maps.MapTypeId.ROADMAP,
			  mapTypeControl:false,
		  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
		  };
		  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
		
		}
	
		function showError(error){
	  		switch(error.code){
	    		case error.PERMISSION_DENIED:
	      			x.innerHTML="User denied the request for Geolocation."
	      			break;
	    		case error.POSITION_UNAVAILABLE:
	      			x.innerHTML="Location information is unavailable."
	      			break;
	    		case error.TIMEOUT:
	      			x.innerHTML="The request to get user location timed out."
	      			break;
	    		case error.UNKNOWN_ERROR:
	      			x.innerHTML="An unknown error occurred."
	      			break;
	    	}
	  	}
	</script>
	<p>humans: 3</p>
	<p>zombies: 10</p>
</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	 ?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->

	
    </body>

	
</html>