<?php include('includes/dbconn.php');
session_start();
if (!isset($_SESSION['shcmusic']['username'])){
	header('Location: index.php');
	exit;
}
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
	
	$friends_sql = sprintf("SELECT u.full_name, u.user_id FROM friends f1 JOIN friends f2 ON f1.friendship_id = f2.friendship_id JOIN users u ON u.username = f2.username WHERE f1.username = '%s' AND f2.username <> '%s' ORDER BY f1.friendship_id", $RsUser['username'], $RsUser['username']);
	$friends_query = mysql_query($friends_sql) or die(mysql_error());
	
	$alerts_sql = sprintf("SELECT * FROM alerts WHERE user = '%s' AND viewed = '0'", $RsUser['username']);
	$alerts_query = mysql_query($alerts_sql) or die(mysql_error());
	$alerts_num_rows = mysql_num_rows($alerts_query);

	$lessons_sql = "SELECT * FROM lessons WHERE student LIKE '%" . $RsUser['full_name'] . "%' ORDER BY instrument, day, period";
	$lessons_query =mysql_query($lessons_sql) or die(mysql_error());
	
	$inst_res_sql = "SELECT DISTINCT resources.resource_id, resources.instrument, resources.grade, resources.resource_name FROM resources JOIN lessons ON resources.instrument = lessons.instrument WHERE lessons.student LIKE '%" . $RsUser['full_name'] . "%' ORDER BY resources.grade";
	$inst_res_query = mysql_query($inst_res_sql) or die(mysql_error());
	$inst_res_num_rows = mysql_num_rows($inst_res_query);
	
	$resources_sql = sprintf("SELECT user_standards.standard_number, resources.resource_id, resources.NCEA_level FROM user_standards LEFT JOIN resources ON user_standards.standard_number = resources.standard_number WHERE user_standards.user = '%s' ORDER BY resources.NCEA_level DESC", $RsUser['username']);
	$resources_query = mysql_query($resources_sql) or die(mysql_error());
	$res_num_rows = mysql_num_rows($resources_query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $RsUser['username'];?> � SHC Music</title>
<link type="text/css" rel="stylesheet" href="style.css" > 
<script type="text/javascript">
function submit (form_id)
{
var form = document.getElementById(form_id);
form.submit();
}

function clear_input (id){
var input = document.getElementById(id);
if (input.value == id) {
input.value = "";
}
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
                    <li><a class="navbar_links" href="photos.php">Photos</a></li>		
                </ul>
                <form action="search.php" method="get" id="search_form">
					<a class="right" id="search_link" href="javascript:submit('search_form')">Search</a>
					<input class="right" id="search_input" size="16" type="text" name="query" value="" />
				</form>
			</div>
	  	</div>
		<div id="main_content">
			<div id="left_col">
                <div id="profile_pic_div">
                    Profile Picture
                    <hr />
                    <img src="<?php echo $RsUser['image'];?>" width="130" height="130"style="margin-top:2px;" /><br />
                    <a href="profile_edit.php" id="change_profile_pic" class="red_box_links" style="line-height:14px;">Change Profile Picture</a>
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
                    <?php if($alerts_num_rows > 0){
					while($RsAlerts = mysql_fetch_assoc($alerts_query)){
                    	echo '<span style="color:#FFF">' . $RsAlerts['content'] . '</span>'; ?> 
                         <a style="color:#FF0000;" href="user_edit.php?action=clear_alert&alert_id=<?php echo $RsAlerts['alert_id'];?>">[Clear Alert]</a><br />
				 	<?php }}else{?>
                    	No Alerts
                    <?php }?>
				</div>
				<div id="container_div">
					<div id="profile_div">
						Profile
						<hr />
						Name: <?php echo $RsUser['full_name'];?> <br /><br />
						Year: <?php echo rtrim($RsUser['homeroom'], "A..Z a..z");?> <br><br />
						Homeroom: <?php echo $RsUser['homeroom'];?> <br><br />
						Instruments I play: <?php echo $RsUser['instruments'];?><br /><br />
                        NCEA Standards being taken: 
						<?php while($RsRes = mysql_fetch_assoc($resources_query)){
						if(is_null($RsRes['resource_id'])){
						 echo $RsRes['standard_number'] . ' ';
						 }else{
						 echo '<a href="resources.php?id=' . $RsRes['resource_id'] . '" style="color:#F00">' . $RsRes['standard_number'] . '</a> ';
						 }}?><br /><br />
						Favourite Artists: <?php echo $RsUser['bands'];?><br /><br />
						Description of Yourself:<br />
						<?php echo $RsUser['description'];?>
						<a class="red_box_links more" href="profile_edit.php">Edit</a>
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
