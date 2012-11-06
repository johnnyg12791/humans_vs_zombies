<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Games
 * Location:        "/game.php"
 * 
 * Description:     This will show the main map of the game, all the impt info
 * 
 * Author:          John Gold
 * Date:            11/1/12
 * Version:         1.0
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
$header_title = "Humans vs. Zombies";
include('inc/header.php');
?>

<body>
<?
$game_id = $_GET['game_id'];

$nameQuery = "select game_name from Games where game_id = '$game_id';";
$humansQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 1;";
$zombiesQuery = "select count(*) as num from Game_Player_Info where game_id = '$game_id' and is_human = 0;";
$startTimeQuery = "select start_time from Games where game_id = '$game_id';";

$game_nameArray = mysql_fetch_assoc(mysql_query($nameQuery));
$num_humansArray = mysql_fetch_assoc(mysql_query($humansQuery));
$num_zombiesArray = mysql_fetch_assoc(mysql_query($zombiesQuery));
$start_timeArray = mysql_fetch_assoc(mysql_query($startTimeQuery));


$game_name = $game_nameArray['game_name'];
$num_humans = $num_humansArray['num'];
$num_zombies = $num_zombiesArray['num'];
$start_timestamp = $start_timeArray['start_time'];
//$start_time = strtotime($start_timestamp)
date_default_timezone_set('America/Los_Angeles'); //just get users actual time zone
$cur_date = date('Y-m-d h:i:s', time());

echo "This is game id = $game_id<br>";
echo "The game name is = $game_name<br>";
echo "The num_humans is = $num_humans<br>";
echo "The num_zombies is = $num_zombies<br>";

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
	$num_hours_so_far = floor(($now - $start)/3600);;
	echo "It has been going on for $num_hours_so_far hours";
}

?>
    
    <div data-role="page">
	<div data-role="header">
	    <a href="areYouSure.php" data-rel="dialog" data-transition="pop" data-icon="delete">Resign</a>
		<h1><?=$game_name?></h1>
		
		<a href="gameDetails.php" data-icon="arrow-r">More</a>
	</div><!-- /header -->

	<div data-role="content">
		<div id="mapholder" style="width: devic-width; height: 400px;"></div>
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
			  center:latlon,zoom:15,
			  mapTypeId:google.maps.MapTypeId.ROADMAP,
			  mapTypeControl:false
		  };
		  //initialize the map
		  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
		  marker.setIcon('http://maps.google.com/mapfiles/ms/micons/blue-dot.png')
		  var infowindow = new google.maps.InfoWindow({
            content: '<h5> You are a Human.</h5><h5> Survival time: <?=$num_hours_so_far?> hours</h5>'
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
		  
		  var infowindow2 = new google.maps.InfoWindow({
            content: '<p> Lucille Benoit is a Zombie.</p><p> Killed: 1 human. </p>'
          });
		  google.maps.event.addListener(zombieMarker, 'click', function() {
          	infowindow2.open(map,zombieMarker);
          });
		  
		  
		  
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
		}
	    //error messages
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
	<h5 style="text-align:right;"><img src="http://icongal.com/gallery/image/45157/running_man_animation.png" width="25" height="25"> Humans: <?=$num_humans?><img src="http://android-emotions.com/wp-content/flagallery/zombie-run/zombie-run-cover.png" width="25" height="25"> Zombies: <?=$num_zombies?><a data-role="button" onclick="getLocation()" data-icon="refresh" data-mini="true" data-inline="true">Update Location</a></h5>
	
</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	 ?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div><!-- /page -->

</body>
</html>