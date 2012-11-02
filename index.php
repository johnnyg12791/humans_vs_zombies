<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Index
 * Location:        "/index.php"
 * 
 * Description:     The landing page for the application
 * 
 * Author:          author
 * Date:            date
 * Version:         1.1
 * *****************************************************************************
 * *****************************************************************************
 */
 

// initialise the app
// init.php contains all facebook sdk info, session control, and the works
require_once('core/init.php');

//2. retrieving session
$session = $facebook->getSession();

//3. requesting 'me' to API
$me = null;
if ($session) {
	try {
		$uid = $facebook->getUser();
		$me = $facebook->api('/me');
		echo "try";
	} catch (FacebookApiException $e) {
		echo "error";
		error_log($e);
	}
}

//4. login or logout
if ($me) {
	$logoutUrl = $facebook->getLogoutUrl();
	echo "logoutUrl";
} else {
	$loginUrl = $facebook->getLoginUrl();
	echo "loginUrl";
}

?>

<html>

<?php

// generate page title and include the header
// $header_title is passed in the header.php file
$header_title = "Login";
include('inc/header.php');

?>

<body>

	<?php if ($me): ?>
	<?php echo "Welcome, ".$me['first_name']. ".<br />"; ?>
	<a href="<?php echo $logoutUrl; ?>">
		<img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
	</a>
	<?php else: ?>
		<a href="<?php echo $loginUrl; ?>">
			<img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
		</a>
	<?php endif ?>

</body>

</html>