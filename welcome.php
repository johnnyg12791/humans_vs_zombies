<html>
    <head>
    
		<title>Welcome</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
		<link rel="stylesheet" href="style.css" />

    </head>
    
    <body>
    
    <div data-role="page">

	<div data-role="header">
		<h1>Welcome to Humans vs Zombies</h1>
	</div><!-- /header -->

	<div data-role="content">
	
		<ul data-role="listview" data-inset="true">	
		<div data-role="collapsible-set">
			
			<div data-role="collapsible" data-inset="true">
				<h3>Current Games</h3>
				<ul data-role="listview" data-inset="true">
					<?php
					include("dbConfig.php");
					$query = "SELECT * FROM test1";
					$result = mysql_query($query);
					while ($row = mysql_fetch_assoc($result)) {
						echo "<li><a href='game/".$row['game_id'].".html'>".$row["game_name"]."</a></li>";
					}  
					?>
					<li>Game 1</li>
					<li>Game 2</li>
				</ul>
			</div>
			<div data-role="collapsible" data-inset="true">
				<h3>Game Invites</h3>
				<ul data-role="listview" data-inset="true">
					<li>See game 3</li>
					<li>See game 4</li>
				</ul>
			</div>
		</div><!--end of collapsible set -->
		
			<li><a href="createGame.html">Create a new Game</a></li>
	        <li><a href="search.html">Search for Games</a></li>
	        <li><a href="howToPlay.html">How To Play</a></li>
	        <li><a href="info.html">Info</a></li>
		</ul>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
		<?php
		include("navBar.html");
		?>
	<!--#include virtual="navBar.html" -->
	
	</div><!-- /page -->
	
    </body>

</html>