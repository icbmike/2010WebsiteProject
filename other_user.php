<?php include('includes/dbconn.php');
session_start();


if (!isset($_SESSION['shcmusic']['username'])){
	header('Location: index.php');
	exit;
}
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
	
	if(!isset($_GET['id'])){
		header('Location: index.php');
	}else{
		if($_GET['id'] == $RsUser['user_id']){
			header('Location: userpage.php');
		}
		
		$check_friend_sql = sprintf("SELECT u.username, f2.approved, f1.approved AS iapprove 
									 FROM friends f1 
									 JOIN friends f2 
									 ON f1.friendship_id = f2.friendship_id 
									 JOIN users u ON u.username = f2.username 
									 WHERE f1.username = '%s' 
									 AND f2.username <> '%s' 
									 AND u.user_id = '%d' 
									 ORDER BY f1.friendship_id",
									 $RsUser['username'], $RsUser['username'], $_GET['id']);
									 
		$check_friend_query = mysql_query($check_friend_sql) or die(mysql_error());
		$check_friend_num_rows = mysql_num_rows($check_friend_query);
		$friend_user = mysql_fetch_assoc($check_friend_query);
		if($check_friend_num_rows > 0){
			
			if($friend_user['approved']){
			$are_we_friends = true;	
			
			$friend_user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $friend_user['username']);
			$friend_user_query = mysql_query($friend_user_sql) or die(mysql_error());
			$RsFriendUser = mysql_fetch_assoc($friend_user_query);
			
			$friends_sql = sprintf("SELECT u.full_name, u.user_id 
									FROM friends f1 
									JOIN friends f2 
									ON f1.friendship_id = f2.friendship_id 
									JOIN users u 
									ON u.username = f2.username 
									WHERE f1.username = '%s' AND f2.username <> '%s' ORDER BY f1.friendship_id", 
			$RsFriendUser['username'], $RsFriendUser['username']);
										
			$friends_query = mysql_query($friends_sql) or die(mysql_error());
			
		
			$lessons_sql = "SELECT * FROM lessons WHERE student LIKE '%" . $RsFriendUser['full_name'] . "%' ORDER BY instrument, day, period";
			$lessons_query = mysql_query($lessons_sql) or die(mysql_error());
			
			$inst_res_sql = "SELECT DISTINCT resources.resource_id, resources.instrument, resources.grade, resources.resource_name FROM resources JOIN lessons ON resources.instrument = lessons.instrument WHERE lessons.student LIKE '%" . $RsFriendUser['full_name'] . "%' ORDER BY resources.grade";
			$inst_res_query = mysql_query($inst_res_sql) or die(mysql_error());
			$inst_res_num_rows = mysql_num_rows($inst_res_query);
			
			$resources_sql = sprintf("SELECT user_standards.standard_number, resources.resource_id, resources.NCEA_level FROM user_standards LEFT JOIN resources ON user_standards.standard_number = resources.standard_number WHERE user_standards.user = '%s' ORDER BY resources.NCEA_level DESC", $RsFriendUser['username']);
			$resources_query = mysql_query($resources_sql) or die(mysql_error());
			$res_num_rows = mysql_num_rows($resources_query);
			}else{
				$are_we_friends = false;
				$friend_user_sql = sprintf("SELECT * FROM users WHERE user_id = '%d'", $_GET['id']);
				$friend_user_query = mysql_query($friend_user_sql) or die(mysql_error());
				$RsFriendUser = mysql_fetch_assoc($friend_user_query);
			}
		}else{
			$are_we_friends = false;
			$friend_user_sql = sprintf("SELECT * FROM users WHERE user_id = '%d'", $_GET['id']);
			$friend_user_query = mysql_query($friend_user_sql) or die(mysql_error());
			$RsFriendUser = mysql_fetch_assoc($friend_user_query);
		}	
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $RsFriendUser['username'];?> � SHC Music</title>
<link type="text/css" rel="stylesheet" href="style.css" > 
<script type="text/javascript">
function submit (form_id)
{
var form = document.getElementById(form_id);
form.submit();
}
</script>
</head>
<body>
	<div id="main_box">
		<div id="header">
			<div id="banner">
                <div id="logged_in_div">
                	<img id="user_image" src="<?php echo $RsUser['image'];?>" width="50" height="50" style="display:inline;float:right;padding-left:5px;">
                    <a href="userpage.php" style="color:#FF0000;">Profile Page</a> � <a href="sign_out.php"style="color:#FF0000;">Sign Out</a><br />
                    <a href="lessons.php">Lessons</a> � <a href="events.php">Events</a><br />
                    <a href="resources.php">Resources</a> � <a href="photos.php">Photos</a>
                </div>
			</div>
			<div id="navbar">
            	<ul class="navbar">
					<li><a class="navbar_links" href="index.php">Home</a></li>
					<li><a class="navbar_links" href="news.php">News</a></li>
					<li><a class="navbar_links" href="events.php">Events</a></li>
					<li><a class="navbar_links" href="resources.php">Resources</a></li>
					<li><a class="navbar_links" href="lessons.php">Lessons</a></li>		
                </ul>
                <form action="search.php" method="get" id="search_form">
					<a class="right" id="search_link" href="javascript:submit('search_form')">Search</a>
					<input class="right" id="search_input" size="16" type="text" name="query" value="" />
				</form>
			</div>
	  	</div>
		<div id="main_content">
			<?php if($are_we_friends == true){?>
            <div id="left_col">
                <div id="profile_pic_div">
                    Profile Picture
                    <hr />
                    <img src="<?php echo $RsFriendUser['image'];?>" width="130" height="130"style="margin-top:2px;" />       
                </div>
                <div id="friends_div">
                    <a href="friends.php">Friends</a>
                    <hr />
                    <?php while($RsFriends = mysql_fetch_assoc($friends_query)){?>
                    <a href="other_user.php?id=<?php echo $RsFriends['user_id'];?>"><?php echo $RsFriends['full_name'];?></a><br />
                    <?php }?>
                </div>
            </div>
			<div id="right_col">
				<div id="alert_div">
					<span>Alerts</span>
					<hr />
                    No Alerts
				</div>
				<div id="container_div">
					<div id="profile_div">
						Profile
						<hr />
						Name: <?php if(isset($_GET['id'])){echo $RsFriendUser['full_name'];}else{echo $RsUser['full_name'];}?> <br /><br />
						Year: <?php if(isset($_GET['id'])){echo rtrim($RsFriendUser['homeroom'], "A..Z a..z");}else{echo rtrim($RsUser['homeroom'], "A..Z a..z");}?> <br><br />
						Homeroom: <?php if(isset($_GET['id'])){echo $RsFriendUser['homeroom'];}else{echo $RsUser['homeroom'];}?> <br><br />
						Instruments I play: <?php if(isset($_GET['id'])){echo $RsFriendUser['instruments'];}else{echo $RsUser['instruments'];}?><br /><br />
                        NCEA Standards being taken: 
						<?php while($RsRes = mysql_fetch_assoc($resources_query)){
						if(is_null($RsRes['resource_id'])){
						 echo $RsRes['standard_number'] . ' ';
						 }else{
						 echo '<a href="resources.php?id=' . $RsRes['resource_id'] . '" style="color:#F00">' . $RsRes['standard_number'] . '</a> ';
						 }}?><br /><br />
						Favourite Artists: <?php if(isset($_GET['id'])){echo $RsFriendUser['bands'];}else{echo $RsUser['bands'];}?><br /><br />
						Description of Yourself:<br />
						<?php echo $RsFriendUser['description'];?>
					</div>
					<div id="user_lessons_box">
						<a href="lessons.php">Instrument Lessons</a>
						<hr />
                        <?php while($RsLessons = mysql_fetch_assoc($lessons_query)){?>
							<a href="lessons.php?instrument=<?php echo $RsLessons['instrument'];?>" style="color:#FF0000;"><?php echo ucfirst($RsLessons['instrument']);?></a>:<br /> <?php echo day($RsLessons['day']);?>, Period <?php echo $RsLessons['period'];?><br /><br />
						<?php }?>
					</div>
                    <div id="user_resources_box">
						<a href="resources.php">Resources</a>
						<hr />
						<?php
						if($res_num_rows > 0){
						$current_lvl = "";
						mysql_data_seek($resources_query, 0);
						while($RsRes = mysql_fetch_assoc($resources_query)){
						if(!is_null($RsRes['resource_id']))
						 {
							 if($RsRes['NCEA_level'] != $current_lvl){
							 	echo "NCEA Level " . $RsRes['NCEA_level'] . "<br />";
								$current_lvl = $RsRes['NCEA_level'];
								}
							 echo '<a href="resources.php?id=' . $RsRes['resource_id'] . '" style="color:#F00">' . $RsRes['standard_number'] . '</a><br />';
						 }}
						 echo '<br />';}
						 ?>
                         <?php
						 if($inst_res_num_rows > 0){
						 	$current_instrument = "";
						 	while($RsInstRes = mysql_fetch_assoc($inst_res_query)){
								if($current_instrument != $RsInstRes['instrument']){
									$current_instrument = $RsInstRes['instrument'];
									if($RsInstRes['grade'] > 0){
										echo $RsInstRes['instrument'] . " Grade " . $RsInstRes['grade'] . "<br />";
									}else{
										echo $RsInstRes['instrument'] . "<br />";
									}
								}
								echo '<a href="resources.php?id=' . $RsInstRes['resource_id'] . '" style="color:#F00">' . $RsInstRes['resource_name'] . '</a><br />';
							}
							echo '<br />';
						}
						 ?>
						<br />
					</div>    
				</div>
			</div>
            <?php }else{?>
            <div id="not_friends">
                <?php if($friend_user['approved'] == 0 && $friend_user['iapprove'] == 0){echo "Add As Friend";}else{echo "Waiting on Confirmation";}?>
                <hr />
                <img src="<?php echo $RsFriendUser['image'];?>" width="150" height="150" style="postition:relative;border:1px solid #F00; padding:2px; margin:3px;float:right;" />
                <?php echo $RsFriendUser['full_name'];?><br />
                Homeroom: <?php echo $RsFriendUser['homeroom'];?><br />
                Favourite Artists: <?php echo $RsFriendUser['bands'];?><br />
                Instruments Played: <?php echo $RsFriendUser['instruments'];?><br />
				<?php if($friend_user['approved'] == 0 && $friend_user['iapprove'] == 0){?>
                	<a href="user_edit.php?action=add&primary_user=<?php echo $RsUser['username'];?>&secondary_user=<?php echo $RsFriendUser['username'];?>" class="red_box_links" style="height:20px;width:100px;">Add as Friend</a>
            	<?php }else{?>
					<a href="friends.php" class="red_box_links" style="width:130px;height:20px;">Back to Friends</a>
				<?php }?>
			</div>
            <?php }?>
		</div>
		<div id="footer">
			<table class="footer">
				<tr>
					<td style="color:#FFFFFF;">&copy;2010 Sacred Heart Music</td>
					<td><a href="http://www.sacredheart.school.nz">Sacred Heart Main Website</a></td>
					<td><a href="contact.php">Contact Information<a/></td>
					<td><a href="about.php">About Us</a></td>
				</tr>
			</table>
		</div>
	</div>

</body>
</html>
