<?php include('includes/dbconn.php');
session_start();

if (!isset($_SESSION['shcmusic']['username'])){
	header('Location: index.php');
	exit;
}
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
	
	$friends_sql = sprintf("SELECT f1.friendship_id, u.full_name, u.username, u.image, u.user_id, f1.approved FROM friends f1 JOIN friends f2 ON f1.friendship_id = f2.friendship_id JOIN users u ON u.username = f2.username WHERE f1.username = '%s' AND f2.username <> '%s' ORDER BY f1.friendship_id", $RsUser['username'], $RsUser['username']); 
	$friends_query = mysql_query($friends_sql) or die(mysql_error());

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $_SESSION['shcmusic']['username'];?> · SHC Music</title>
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
                    <a href="userpage.php" style="color:#FF0000;">Profile Page</a> · <a href="sign_out.php"style="color:#FF0000;">Sign Out</a><br />
                    <a href="lessons.php">Lessons</a> · <a href="events.php">Events</a><br />
                    <a href="resources.php">Resources</a> · <a href="photos.php">Photos</a>
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
        	<div id="container_box">
                <div id="friends_box">
                Friends
                <hr />
                <table class="lessons_table">
                <?php while($RsFriends = mysql_fetch_assoc($friends_query)){?>
                	<tr><td width="15%"><a href="other_user.php?id=<?php echo $RsFriends['user_id'];?>"><?php echo $RsFriends['full_name'];?></a></td>
                	<td width="15%"><?php echo $RsFriends['username'];?></td>
                    <td width="51%"><img src="<?php echo $RsFriends['image'];?>"width="100" height="100" style="vertical-align:middle;" /></td>
                	<td width="19%"><?php if($RsFriends['approved']){?>
                    <a href="user_edit.php?action=delete&ex_friend=<?php echo $RsFriends['username'];?>&username=<?php echo $RsUser['username']?>&fid=<?php echo $RsFriends['friendship_id'];?>" class="red_box_links" style="width:100px;height:20px;margin-left:15px;">Delete Friend</a>
					<?php }else{?>
                    <a href="user_edit.php?action=approve&fid=<?php echo $RsFriends['friendship_id'];?>&user_id=<?php echo $RsFriends['user_id'];?>&username=<?php echo $RsUser['username']?>&sender=<?php echo $RsFriends['username'];?>" class="red_box_links" style="line-height:14px;width:100px;height:27px;margin-left:15px;">Approve as Friend</a>
					<?php }?></td>
               	  </tr>
                <?php }?>
                </table>
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
