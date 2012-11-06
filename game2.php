<!DOCTYPE html>
<html>
	<?php

// generate page title and include the header
// $header_title is passed in the header.php file
$header_title = "Game 2";
include('inc/header.php');


// copy up to here and paste in all your new files. This will make starting a new file 
// a hundred times easier

?>
	
	<body onload = "getLocation()" >
    
    <div data-role="page">

	<div data-role="header">
	
	    <a href="areYouSure.php" data-rel="dialog" data-transition="pop" data-icon="delete">Resign</a>
		<h1>Game 2</h1>
		<a href="gameDetails.php" data-icon="arrow-r">More</a>
	</div><!-- /header -->

	<div data-role="content">
		<div id="mapholder"></div>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script>
	var MY_MAPTYPE_ID = 'zombie mode';
      var styles = [
           {
            featureType: 'all',
            elementType: 'geometry',
            stylers: [
              { hue: '#ff0008' },
              { saturation: -5 },
              { lightness: -62}
            ]
          },
          {
            featureType: 'landscape.man_made',
            elementType: 'geometry.stroke',
            stylers: [
              { hue: '#ff0900' },
              { color: '#000401'},
              { saturation: 97 }
            ]
          },
          {
            featureType: 'road',
            elementType: 'geometry.fill',
            stylers: [
              {weight: 1.7},
              { hue: '#00ff11' },
              { saturation: 1 }, 
              {lightness: -100}
            ]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [
              { hue: '#00ff5e'},
              {lightness: -60}
            ]
          }
        ];

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
			  center:latlon,zoom:15,
			  mapTypeControlOptions: {
              mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
              },
          mapTypeId: MY_MAPTYPE_ID,
		  
		  };
		  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  var styledMapOptions = {
          name: 'Zombie Mode'
        };
        
        var myMapType = new google.maps.StyledMapType(styles, styledMapOptions);
         map.mapTypes.set(MY_MAPTYPE_ID, myMapType);
		  var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
		  var infowindow = new google.maps.InfoWindow({
            content: '<p> You are a Zombie.</p><p> You have killed: 3 humans. </p>'
          });
		  google.maps.event.addListener(marker, 'click', function() {
          	infowindow.open(map,marker);
          });
		  infowindow.open(map,marker);

		  lat2=37.429054;
		  lon2=position.coords.longitude;
		  latlon2=new google.maps.LatLng(lat2, lon2);
		  var zombieMarker=new google.maps.Marker ({position:latlon2, map:map, title: "Zombies here!"});
		  zombieMarker.setIcon('http://android-emotions.com/wp-content/flagallery/zombie-run/zombie-run-cover.png')
		  
		  lat4=37.425054;
		  lon4=-122.175415;
		  latlon4=new google.maps.LatLng(lat4, lon4);
		  var zombieMarker2=new google.maps.Marker ({position:latlon4, map:map, title: "More zombies here!"});
		  zombieMarker2.setIcon('http://android-emotions.com/wp-content/flagallery/zombie-run/zombie-run-cover.png')
		  lat3=37.427339;
		  lon3=-122.165415;
		  latlon3=new google.maps.LatLng(lat3, lon3);
		  var humanMarker=new google.maps.Marker ({position:latlon3, map:map, title: "Humans here!"});
		  humanMarker.setIcon('http://icongal.com/gallery/image/45157/running_man_animation.png')
          var infowindow2 = new google.maps.InfoWindow({
            content: '<p> John Gold is a Human.</p>'+'<p> Survival time: 3.67 hours </p>'+'<p><a href="attack.php">'+
            'Attack!</a></p>'
          });
		  google.maps.event.addListener(humanMarker, 'click', function() {
          	infowindow2.open(map,humanMarker);
          });
		
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
	<h6 style="text-align:right;">humans: 2, zombies: 2<a data-role="button" onclick="getLocation()" data-icon="refresh" data-mini="true" data-inline="true">Update Location</a><h6>
</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	 ?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->

	
    </body>

	
</html>