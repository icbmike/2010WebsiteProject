<?php include('includes/dbconn.php');
session_start();
date_default_timezone_set("Pacific/Auckland");
if(isset($_SESSION['shcmusic']['username'])){
	$logged_in = true;
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
}else{
	$logged_in = false;
}
if(isset($_GET['id'])){
$news_sql = sprintf("SELECT * FROM news WHERE news_id = '%s'", $_GET['id']);
$news_id = true;
}
else{
$news_sql = "SELECT * FROM news ORDER BY date_added DESC, news_id LIMIT 0, 5";
$news_id= false;
}
$news_query = mysql_query($news_sql) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News · SHC Music</title>
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
            	<?php if ($logged_in != 1){?>
				<div id="sign_in">
                	<div style="margin:10px;">
						<form id="sign_in_form" method="post" action="sign_in.php">
							<input size="16" type="text" name="username" value="Username" id="Username" onClick="clear_input('Username')"/>
							<a href="javascript:submit('sign_in_form')">Sign In</a>
							<br />
							<input size="16" type="password" name="password" id="password" onClick="clear_input('password')" value="password" />
							<a href="sign_up.php">Sign Up</a>
						</form>
                  </div>
				</div>
                <? }else{?>
                <div id="logged_in_div">
                	<img id="user_image" src="<?php echo $RsUser['image'];?>" width="50" height="50" style="display:inline;float:right;padding-left:5px;">
                    <a href="userpage.php" style="color:#FF0000;">Profile Page</a> · <a href="sign_out.php"style="color:#FF0000;">Sign Out</a><br />
                    <a href="lessons.php">Lessons</a> · <a href="events.php">Events</a><br />
                    <a href="resources.php">Resources</a> · <a href="photos.php">Photos</a>
                </div>
                <?php }?>
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
				<?php if($logged_in){if($RsUser['admin']){?>
				<div id="admin">
                <?php if(isset($_GET['error'])){
						switch ($_GET['error']){
							case 'old_password':
							echo '<span style="color:#F00;">You entered the wrong password for your old password</span>';
							break;
							case 'email':
							echo '<span style="color:#F00;">The email addresses you entered didn\'t match</span>';
							break;
							case 'new_password':
							echo '<span style="color:#F00;">The new passwords you entered didn\'t match</span>';
							break;
							case 'image':
							echo '<span style="color:#F00;">There was a problem uploading the file you selected.<br />Please make sure it\'s the right file type.</span>';
							break;
							case 'add':
							echo '<span style="color:#F00;">That album name already exists. Please enter a different name</span>';
							break;
						}
					}
			?>
                	<form method="post" action="admin.php" id="admin_form" enctype="multipart/form-data">
                    	Add News<hr />
                        <input type="hidden" value="news" name="type"/>
                        <input type="hidden" name="date" value="<?php echo date("Y-m-d", time());?>"/>
                        Headline<br />
                        <input type="text" name="headline" size="16" /><br />
                        Article content<br />
                        <textarea name="content" rows="8" cols="100"></textarea><br />
                        Article Image<br />
                        <input name="image" type="file" size="16" /><br />
                        <a href="javascript:submit('admin_form')" class="red_box_links" style="width:100px;height:20px;">Submit</a>
                    </form>
                </div>
				<?php } }
				while($RsNews = mysql_fetch_assoc($news_query)){?>
                <div class="news_box">
					<?php echo $RsNews['headline'] . " · " . date("jS \of F, Y",strtotime($RsNews['date_added']));?>
                    <hr />
                    <img src="<?php echo $RsNews['image'];?>" style="float:right; margin:5px;padding:2px;width:300px;height:200px;" />
                    <p><?php if($news_id == false){echo substr($RsNews['content'], 0, 700) . "...";}else{echo $RsNews['content'];}?></p> 
                    <br />
                    <a href="news.php<?php if($news_id == false){echo "?id=" . $RsNews['news_id'];}?>" class="red_box_links" style="width:80px; height:  20px;"><?php if($news_id == false){echo "Read More";}else{echo "More News";}?></a>
                </div>
                <?php }?> 
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
