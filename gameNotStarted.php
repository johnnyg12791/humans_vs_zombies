<div data-role="page">
		<div data-role="header">
		<?php
		//echo "This game has not yet started, it will start on $start_time<br>";
		$num_hours_till_start = ($start - $now)/3600;
		$start_date_info = date('Y-m-d h:i:s', $start - $now)
		//echo "That is in $num_hours_till_start hours";
		
		?>
		<h1><?=$game_name?></h1>
		</div>
	<div data-role="content">
	<?php
		//$creatorQuery = "SELECT creator_id FROM Games where game_id = '$game_id'";
		//$creatorResult = mysql_fetch_assoc(mysql_query($creatorQuery));
		//$creator_id = $creatorResult['creator_id'];
		$creator_id = $game_nameArray['creator_id'];
		if($creator_id = $user_id){
			echo "<br>You created this game, congratulations. That is special.<br>";
			echo "You have the power to start this game immediately";
		}
	
	?>
	
	
		
		<div>
			<script type="text/javascript">
				var currentDate = new Date()
				var day = currentDate.getDate()
				var month = currentDate.getMonth() + 1
				var year = currentDate.getFullYear()
				document.write("Current date: " + day + "/" + month + "/" + year)
			</script>
		</div>
		
		<div>
			This game has not yet started, it will start on <?=date('Y-m-d h:i:s', $start)?><br>
		</div>
		
		<div>
			<script type="text/javascript">
				var currentTime = new Date()
				var hours = currentTime.getHours()
				var minutes = currentTime.getMinutes()

				if (minutes < 10) {
					minutes = "0" + minutes
				}

				document.write("<b>" + hours + ":" + minutes + " " + "</b>")
			</script>
		</div>
		
		<?php
		
		$invited = "SELECT game_id, invitee_id FROM Game_Invites WHERE game_id = '$game_id'";
		$invited_result = mysql_query($invited);
		
		$idArray = array();
		while($row = mysql_fetch_assoc($invited_result)){
			$idArray[] = $row['invitee_id'];	
		}
		
		$fql = 'SELECT uid, name, pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1 ORDER BY name';
		$ret_obj = $facebook->api(array(
                                   'method' => 'fql.query',
                                   'query' => $fql,
                                 ));
                                 
		$count = count($ret_obj);
		
		
		
		
		while ($row = mysql_fetch_assoc($invited_result)) {
			echo $row['invitee_id'] . '<br>';
		}
		echo $invited_result['data'];
		?>
		
		<h3>Select friends to invite!</h3>
		<ul data-role="listview" data-inset="true" id="invite">
		<?php
		for ($i = 0; $i < $count; $i++) {
        	if (!in_array($ret_obj[$i]['uid'], $idArray)) {
        		?>
        		<img src="<?php echo $ret_obj[$i]['pic_square']; ?>">
       			<?php
       			echo $ret_obj[$i]['name'];
       			?>
       			<div id="inviteFriend_<?=$ret_obj[$i]['uid']?>">
            		<input id="friend_id_<?=$i?>" name="friend_id" value="<?php echo $ret_obj[$i]['uid']; ?>" type="hidden">
           	 		<input id="game_id" name="game_id" value="<?php echo $game_id; ?>" type="hidden">
        			<input id="submit_<?=$ret_obj[$i]['uid']?>" type="submit" name="submit" value="Invite">
				</div>
				<div id="invitedText_<?=$ret_obj[$i]['uid']?>"></div>
			
				<script type="text/javascript">
				
					$("#submit_<?=$ret_obj[$i]['uid']?>").click(function(event) {
						alert("just invited a friend");
					
						$.post("invite.php", {friend_id: $("#friend_id_<?=$i?>").val(),
							game_id: $("#game_id").val() },
							function(data){
							//$("#inviteFriend_<?php echo $ret_obj[$i]['uid']; ?>").html = "Invited!";
							//this removes the button
							alert('Trying to hide button');
							$("#inviteFriend_<?=$ret_obj[$i]['uid']?>").hide();
							$("#invitedText_<?=$ret_obj[$i]['uid']?>").html("Invited!");
						});
					});
				</script>
       			<?php
        	}
        }
        ?>
        </ul>
    
    </div> <!--end of content-->
    <div data-role="footer" data-id="samebar" class="nav-icons" data-position="fixed" data-tap-toggle="false">
	
	<?php
		include('inc/navBar.php');
	 ?>
</div>
</div>