<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Zombies on Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script>
    var MY_MAPTYPE_ID = 'zombie mode';
      var stylez = [
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
      
      
      
      
      
      var mypos = new google.maps.LatLng(37.427299, -122.1702);

      var players = [
        new google.maps.LatLng(37.429054, -122.169664),
        new google.maps.LatLng(37.424453, -122.174213),
        new google.maps.LatLng(37.425339, -122.165415)
      ];
      
      var zombies =[
        new google.maps.LatLng(37.529453, -122.184213),
        new google.maps.LatLng(37.422339, -122.165415)
      ];

      var markers = [];
      var iterator = 0;

      var map;

      function initialize() {
        var mapOptions = {
          zoom: 15,
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
          },
          mapTypeId: MY_MAPTYPE_ID,
          center: mypos
        };

        map = new google.maps.Map(document.getElementById('map_canvas'),
                mapOptions);
       var styledMapOptions = {
          name: 'Zombie'
        };
        var myMapType = new google.maps.StyledMapType(stylez, styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, myMapType);
       drop();
      }

      function drop() {
        for (var i = 0; i < players.length; i++) {
          setTimeout(function() {
            addMarker();
          }, i * 200);
        }
        iterator=0;
        for (var i = 0; i < zombies.length; i++) {
          setTimeout(function() {
            addZombieMarker();
          }, i * 200);
        }
      }

      function addMarker() {
        markers.push(new google.maps.Marker({
          position: players[iterator],
          map: map,
          draggable: false,
          animation: google.maps.Animation.DROP
        }));
        iterator++;
      }
      function addZombieMarker() {
        markers.push(new google.maps.Marker({
          position: zombies[iterator],
          map: map,
          draggable: false,
          animation: google.maps.Animation.DROP
        }));
        iterator++;
      }
    </script>
  </head>
  <body onload="initialize()">
  <div data-role="header">
			<h1>GAME 2</h1>
		</div><!-- /header -->
  <h4 style="text-align:center;">You are a Zombie!</h4>
		    <p> Hours survived: 3<p>
		
			<div data-role="controlgroup" data-type="horizontal">
				<a data-role="button" data-icon="alert" data-iconpos="top" data-mini="true" data-inline="true">Attack!</a>
				<a data-role="button" onclick="getLocation()" data-icon="refresh" data-iconpos="top" data-mini="true" data-inline="true">Refresh</a>
				<a href="welcome.php" data-role="button" data-icon="delete" data-iconpos="top" data-mini="true" data-inline="true">Resign</a>
				<a data-role="button" data-icon="arrow-r" data-iconpos="top" data-mini="true" data-inline="true">More</a>
			</div>
    <div id="map_canvas" style="width: device-width; height: 400px;">map div</div>
    <p>Humans: 3</p>
	<p>Zombies: 10</p>
  	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	<!--#include virtual="navBar.html" -->
	</div><!-- /page -->

  </body>
</html>
