<html>

	<head>

	<title>Welcome</title> 
	<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
		<link rel="stylesheet" href="style.css" />
		<link rel="shortcut icon" href="stanford.edu/~johngold/cgi-bin/humans_vs_zombies/favicon.ico"> 

	</head>
	
	<div id="fb-root"></div>
	<script>
	
	
  	window.fbAsyncInit = function() {
    FB.init({
      appId      : '170592053078647', // App ID
      channelUrl : 'http://stanford.edu/~johngold/cgi-bin/humans_vs_zombies/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    FB.Event.subscribe('auth.statusChange', handleStatusChange);
  	};

  	// Load the SDK Asynchronously
  	(function(d){
     	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     	if (d.getElementById(id)) {return;}
     	js = d.createElement('script'); js.id = id; js.async = true;
     	js.src = "//connect.facebook.net/en_US/all.js";
     	ref.parentNode.insertBefore(js, ref);
   	}(document));
	</script>
	
	<script>
   	function handleStatusChange(response) {
    	 document.body.className = response.authResponse ? 'connected' : 'not_connected';

  	   if (response.authResponse) {
  	     console.log(response);
  	     
  	     updateUserInfo(response);
   	  }
   	}
	</script>
	
	<body>
	
	<div id="login">
   	<p><button onClick="loginUser();">Login</button></p>
 	</div>
 	<div id="logout">
  	<p><button  onClick="FB.logout();">Logout</button></p>
 	</div>

 	<script>
  	 	function loginUser() {    
     	FB.login(function(response) { }, {scope:'email'});     
     	}
 	</script>
	
	</body>
	
	<style>
 		body.connected #login { display: none; }
  		body.connected #logout { display: block; }
  		body.not_connected #login { display: block; }
      	body.not_connected #logout { display: none; }
	</style>
	
	<div id="user-info"></div>
 
 	<script>
   	function updateUserInfo(response) {
    	FB.api('/me', function(response) {
       		document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
     	});
   	}
 	</script>
 	
 	<a href="#" onclick="getUserFriends();">Get friends</a><br>
 	<div id="user-friends"></div>
 	<script>
 	function getUserFriends() {
   		FB.api('/me/friends&fields=name,picture', function(response) {
     		console.log('Got friends: ', response);

     		if (!response.error) {
       			var markup = '';

     			var friends = response.data;

				for (var i=0; i < friends.length && i < 250; i++) {
         			var friend = friends[i];

         			markup += '<img src="' + friend.picture + '"> ' + friend.name + '<br>';
       			}

       			document.getElementById('user-friends').innerHTML = markup;
     		}
   		});
 	}
 	</script>
	
</html>