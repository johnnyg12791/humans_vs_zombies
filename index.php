<?php
/* *****************************************************************************
 * *****************************************************************************
 * Title:           Index
 * Location:        "/index.php"
 * 
 * Description:     The landing page for the application
 * 
 * Author:          Justin/John
 * Date:            date
 * Version:         1.1
 * *****************************************************************************
 * *****************************************************************************
 */
 
session_start();

include("core/db/dbConfig.php");

// initialise the app
// init.php contains all facebook sdk info, session control, and the works
require_once('core/fb_sdk/facebook.php');

$facebook = new Facebook(array(
  'appId'  => '170592053078647',
  'secret' => '2db5b8a6bb450555ece006bab737ad63',
  'cookie' => 'true',
));

$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    
    
    
    //This is for the Fb_Id_Name table in the database
    $uid = $user;
    $user_name = $user_profile['name'];
    
    $checkQuery = "select * from Fb_Id_Name where fb_id = '$uid' ";
    $checkResult = mysql_query($checkQuery);
    if(mysql_num_rows($checkResult)==0){
    
    $query = "insert into Fb_Id_Name values ('$uid', '$user_name');";
    $result = mysql_query($query);                
    if($result) 
    	echo "Welcome to Humans vs Zombies (for the first time)";
    } //else user is in the database, no need to change anything
    
    
    
    
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}


?>



<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

<?php

// generate page title and include the header
// $header_title is passed in the header.php file
$header_title = "Login";
include('inc/header.php');


?>

<body>

	<div data-role="page">

		<div data-role="header">
			<h1>Login!</h1>
		</div><!-- /header -->

		<div data-role="content">
	
	
		


    		<?php if ($user): ?>
      		<a href="<?php echo $logoutUrl; ?>">Logout</a><br>
      
      		<?php	
      			try {
        		$fql = 'SELECT uid, name, pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1 ORDER BY name';
        		$ret_obj = $facebook->api(array(
                                   		'method' => 'fql.query',
                                   		'query' => $fql,
                                 		));
         
        
        
        
        		// FQL queries return the results in an array, so we have
        		//  to get the user's name from the first element in the array.
        
        		$count = count($ret_obj);
        
        		for ($i = 0; $i < $count; $i++) {
        			?>
        			<img src="<?php echo $ret_obj[$i]['pic_square']; ?>">
       				<?php
        		}
        		echo "<br>";

      		} catch(FacebookApiException $e) {
        		// If the user is logged out, you can have a 
        		// user ID even though the access token is invalid.
        		// In this case, we'll get an exception, so we'll
        		// just ask the user to login again here.
        		$login_url = $facebook->getLoginUrl(); 
        		echo 'Please <a href="' . $login_url . '">login.</a>';
        		error_log($e->getType());
        		error_log($e->getMessage());
      		}  
      		?>
  		
    		<?php else: ?>
      			<div>
        			<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      			</div>
    		<?php endif ?>

    		<?php if ($user): ?>
    
    			<a href="welcome.php">Continue to application</a><br>
    
      			<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      			<!-- <h3>Your User Object (/me)</h3> -->
      			<!-- <pre><?php print_r($user_profile); ?></pre> -->
      
            
    		<?php else: ?>
      			<strong><em>You are not Connected.</em></strong>
    		<?php endif ?>   	
   	
  
		
		</div><!-- /content -->


	<div data-role="footer">	

	</div>
	
	

	</div><!-- /page -->


</body>

</html>