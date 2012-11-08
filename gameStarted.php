<div data-role="page">
		<div data-role="header">
		
		<?php
		
		//echo "This game started on = $start_timestamp<br>";
		$num_hours_so_far = floor(($now - $start)/3600);;
		//echo "It has been going on for $num_hours_so_far hours";
		
		$queryPlayers = "SELECT fb_name, recent_latitude, recent_longitude, is_human, num_bites FROM Game_Player_Info, Fb_Id_Name WHERE fb_id = player_id AND game_id = '$game_id'";
		$resultPlayers = mysql_query($queryPlayers);
		$counter = 0;
		while($row = mysql_fetch_assoc($resultPlayers)){
			
			$player['fb_name'] = $row['fb_name'];
			$player['latitude'] = $row['recent_latitude'];
			$player['longitude'] = $row['recent_longitude'];
			$player['is_human'] = $row['is_human'];
			$player['num_bites'] = $row['num_bites'];
			$playersArray[$counter] = $player;
			$counter++;
		}
		
		
	?>
	
	    <div id="resign">
	    <!--<input id="player_id" name="player_id" type="hidden">
	    //<input id="game_id" name="game_id" type="hidden"> -->
	    <input id="submit" type="button" value="resign">
	    </div>
	    
	    <script type="text/javascript">
		$("#submit").click(function(event) {
			$.post("resign.php", {
				game_id: <?=$game_id?>, 
				player_id: <?=$player_id?>,
				}, function(data){
					alert(data);
			});
		});
	</script>

	    
		<h1><?=$game_name?></h1>
		<a href="gameDetails.php?game_id=<?=$game_id?>" data-icon="arrow-r">More</a>
	</div><!-- /header -->

	<div data-role="content">
		<div id="mapholder" style="width: devic-width; height: 400px;"></div>
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
		  
		  var isHuman=1; 
		  var map;
		  //HUMANVERSION
		  if(isHuman){
		  	var myOptions={
			 	 center:latlon,zoom:15,
			 	 mapTypeId:google.maps.MapTypeId.ROADMAP,
			  	mapTypeControl:false
		 	 };
		 	 //initialize the map
		  	 map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  }else{
		  //ZOMBIEVERSION!!!
		  	var myOptions={
				  center:latlon,zoom:15,
				  mapTypeControlOptions: {
        	      	mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
				  },
        	  	  mapTypeId: MY_MAPTYPE_ID
			 };
			 map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  	 var styledMapOptions = {
          		name: 'Zombie Mode'
          	};
         	var myMapType = new google.maps.StyledMapType(styles, styledMapOptions);
         	map.mapTypes.set(MY_MAPTYPE_ID, myMapType);
		  }
		  var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
		  if(isHuman){
		  	marker.setIcon('http://maps.google.com/mapfiles/ms/micons/blue-dot.png');
		  }
		  var infowindow;
		  if(isHuman){
		  	infowindow = new google.maps.InfoWindow({
            	content: '<h5> You are a Human.</h5><h5> Survival time: <?=$num_hours_so_far?> hours</h5>'
          	});
		  }else{
		  	infowindow = new google.maps.InfoWindow({
            	content: '<h5> You are a Zombie.</h5><h5> Humans killed: "number"</h5>'
          	});
		  }
		  google.maps.event.addListener(marker, 'click', function() {
          	infowindow.open(map,marker);
          });
		  infowindow.open(map,marker);
		  
		  <?
		  for($i=0;$i<count($playersArray);$i++){
		  ?>	
		  
		  	lat2=<?=$playersArray[$i]['latitude']?>;
		  	lon2=<?=$playersArray[$i]['longitude']?>;
		  	latlon2=new google.maps.LatLng(lat2, lon2);
		  	marker_<?=$i?>=new google.maps.Marker ({position:latlon2, map:map, title: "Friends here!"});
		  
		  var playerStatus;
		  var playermessage;
		  	if(<?=$playersArray[$i]['is_human']?>){
		  	  marker_<?=$i?>.setIcon('http://icongal.com/gallery/image/45157/running_man_animation.png');
		  	  playerStatus='Human';
		  	  playerMessage='';
		  	  
		  	}else{
		  		marker_<?=$i?>.setIcon('http://android-emotions.com/wp-content/flagallery/zombie-run/zombie-run-cover.png');
		  		playerStatus='Zombie';
		  		playerMessage="Killed: <?=$playersArray[$i]['num_bites']?> humans";
		  	}
		 
		 	 var playerName="<?=$playersArray[$i]['fb_name']?>";
		 	 var infowindow_<?=$i?> = new google.maps.InfoWindow({	
         		content: '<h5>'+playerName+' is a '+playerStatus+ '.</h5><h5>'+playerMessage+'</h5>'
         	 });
		 	google.maps.event.addListener(marker_<?=$i?>, 'click', function() {
         	infowindow_<?=$i?>.open(map,marker_<?=$i?>);
        	 });
         <?}?>       	  
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
	
</div><!-- /page -->
	
	<script type="text/javascript">
		var currentDate = new Date()
		var day = currentDate.getDate()
		var month = currentDate.getMonth() + 1
		var year = currentDate.getFullYear()
		document.write("<b>" + day + "/" + month + "/" + year + "</b>")
	</script>