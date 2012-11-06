<html>

<?php

// generate page title and include the header
$header_title = "More Details";
include('inc/header.php');

?>

<body>

<div data-role="page">
	<div data-role="header">
		<a onclick="history.back(-1)" data-icon="arrow-l">Back</a>
		<h1>Game Name</h1>
	</div><!-- /header -->
	<div data-role="content">	
	<h3 style="text-align:center;">Started: X hours ago<h3>
		<p></p>
		<ul data-role="listview" data-inset="true" data-filter="true">
			<li><a href="#">Barack Obama: Human</a></li>
			<li><a href="#">Mitt Romney: Zombie</a></li>
			<li><a href="#">John Gold: Human</a></li>
			<li><a href="#">Justin Salloum: Human</a></li>
			<li><a href="#">Lucille Benoit: Zombie</a></li>
			<li><a href="#">John Doe: Human</a></li>
			<li><a href="#">Michael Jackson: Zombie</a></li>
		</ul>
		<h5 style="text-align:right;"> Humans: 4 Zombies: 3<h5>
</div>
<div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	?>

	<!--#include virtual="inc/navBar.php" -->
	
	</div>


</div>
</body>
</html>