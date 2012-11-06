<html>

<?php

// generate page title and include the header
$header_title = "Are You Sure?";
include('inc/header.php');

?>
<body>

<div data-role="page">
	<div data-role="header">
		<h1>Resign Game</h1>
	</div><!-- /header -->
	<div data-role="content">	
	<H3>Are you sure you want to attack NAME?<H3>
	<a onclick="history.back(-1)" data-role="button">Attack</a>
	<a onclick="history.back(-1)" data-role="button">Cancel</a>
	</div>
	
</div>
</body>
</html>