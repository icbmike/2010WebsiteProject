<?php include('includes/dbconn.php');
session_start();
if(isset($_SESSION['shcmusic']['username'])){
	$logged_in = 1;
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
}else{
	$logged_in = 0;
}
if(isset($_GET['query']) && $_GET['query'] != ""){
	$news_sql = "SELECT news_id, headline, image, date_added FROM news WHERE headline LIKE '%" . $_GET['query'] . "%' ORDER BY date_added DESC";
	$events_sql = "SELECT event_id, headline, image, date FROM events WHERE headline LIKE '%" . $_GET['query'] . "%' AND happened = 0 ORDER BY date";
	$resources_sql = "SELECT resource_id, resource_name, NCEA_level, instrument, grade, date_added FROM resources WHERE resource_name LIKE '%" . $_GET['query'] . "%' OR instrument LIKE '%" . $_GET['query'] . "%' ORDER BY NCEA_level DESC";
	$photos_sql = "SELECT DISTINCT album, date_added FROM photos WHERE album LIKE '%" . $_GET['query'] . "%' ORDER BY album";
	$user_sql = "SELECT user_id, username, full_name, image FROM users WHERE username LIKE '%" . $_GET['query'] . "%' OR full_name LIKE '%" . $_GET['query'] . "%' ORDER BY full_name ASC";
	
	$news_query = mysql_query($news_sql) or die(mysql_error());
	$events_query = mysql_query($events_sql) or die(mysql_error());
	$resources_query = mysql_query($resources_sql) or die(mysql_error());
	$photos_query = mysql_query($photos_sql) or die (mysql_error());
	$user_query = mysql_query($user_sql) or die (mysql_error());
	
	$news_nums = mysql_num_rows($news_query);
	$events_nums = mysql_num_rows($events_query);
	$resources_nums = mysql_num_rows($resources_query);
	$photos_nums = mysql_num_rows($photos_query);
	$user_nums = mysql_num_rows($user_query);

	
}else{
	$news_nums = 0;
	$events_nums = 0;
	$resources_nums = 0;
	$photos_nums = 0;
	$user_nums = 0;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SHC MUSIC</title>
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
function table_collapse(id){
var table_div = document.getElementById(id);
if (table_div.style.display == 'none'){
	table_div.style.display = 'block';
	
}else{
table_div.style.display = 'none';
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
							<input size="16" type="text" name="username" value="Username" id="Username" onClick="clear_input('Username')" />
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
				<?php if(isset($_GET['query']) && $_GET['query'] != ""){?>
                <div id="search_stats">
                    Search Results for "<?php if(isset($_GET['query'])){echo $_GET['query'];}?>"
                    <hr />
                    <?php if($news_nums > 0 || $events_nums > 0 || $resources_nums > 0 ||  $photos_nums > 0 || $user_nums > 0){?>
                    News Results: <?php echo $news_nums;?><br />
                    Events Results: <?php echo $events_nums;?><br />
                    Resources Results: <?php echo $resources_nums;?><br />
                    Photo Results: <?php echo $photos_nums;?><br />
					User Results: <?php echo $user_nums;
					}else{
					?>
                    <br />
                    <p style="padding-bottom:12px; text-align:center;">
                    Sorry no results were found that matched your query.<br />
                    Make sure you spelt and puntuated your query properly.<br />
                    For example 'Rockquest' will not match 'Rock Quest'
                    </p>
					<?php }?>
                </div>
                <?php }else{?>
                <div id="search_stats">
                	Search Results
                    <hr />
					<br />
                    <p style="padding-bottom:12px; text-align:center;">
                    Sorry no results were found that matched your query.<br />
                    Make sure you spelt and puntuated your query properly.<br />
                    For example 'Rockquest' will not match 'Rock Quest'
                    </p>
                </div>
				<?php }
				if($news_nums>0){?>
                <div class="result_box">
                	<a href="javascript:table_collapse('news_table')">News Results</a>
                	<hr />
                    <div id="news_table" style="display:none;">
                    <table class="lessons_table" >
                    	<tr><td>Headline</td><td>Date Added</td><td>Image</td></tr>
                        <?php while($RsNews = mysql_fetch_assoc($news_query)){?>
                        <tr><td><a href="news.php?id=<?php echo $RsNews['news_id'];?>"><?php echo $RsNews['headline'];?></a></td><td><?php echo date("jS \of F, Y", strtotime($RsNews['date_added']));?></td><td><img src="<?php echo $RsNews['image'];?>" width="180" height="130"/></td></tr>
						<?php }?>
                    </table>
                    </div>
                </div>
                <?php }if($events_nums>0){?>
                <div class="result_box">
                	<a href="javascript:table_collapse('events_table')">Events Results</a>
                    <hr />
                    <div id="events_table" style="display:none;">
                    <table class="lessons_table" >
                    	<tr><td>Headline</td><td>Date</td><td>Image</td></tr>
                        <?php while($RsEvents = mysql_fetch_assoc($events_query)){?>
                        <tr><td><a href="events.php?id=<?php echo $RsEvents['event_id'];?>"><?php echo $RsEvents['headline'];?></a></td><td><?php echo date("jS \of F, Y", strtotime($RsEvents['date']));?></td><td><img src="<?php echo $RsEvents['image'];?>" width="180" height="130"/></td></tr>
						<?php }?>
                    </table>
                    </div>
                </div>
				<?php }if($resources_nums>0){?>
                <div class="result_box">
                	<a href="javascript:table_collapse('resources_table')">Resources Results</a>
                    <hr />
                    <div  id="resources_table" style="display:none;">
                    <table class="lessons_table">
                    	<tr><td>Resource Name</td><td>Date Added</td><td>Resource Type</td></tr>
                        <?php while($RsResources = mysql_fetch_assoc($resources_query)){?>
                        <tr><td><a href="resources.php?id=<?php echo $RsResources['resource_id'];?>"><?php echo $RsResources['resource_name'];?></a></td><td><?php echo date("jS \of F, Y", strtotime($RsResources['date_added']));?></td><td>
						<?php if($RsResources['NCEA_level'] > 0){
							  		echo "NCEA Level " . $RsResources['NCEA_level'];
							}else{
									echo $RsResources['instrument'];
									if($RsResources['grade'] > 0){
									echo " Grade " . $RsResources['grade'];
									}
							}
						?>
                        </td></tr>
						<?php }?>
                    </table>
                    </div>
                </div>
                <?php }if($photos_nums>0){?>
                <div class="result_box">
                	<a href="javascript:table_collapse('photos_table')">Photos Results</a>
                    <hr />
                    <div  id="photos_table" style="display:none;">
                    <table class="lessons_table">
                    	<tr><td>Album Name</td><td>Date Added</td></tr>
                        <?php while($RsPhotos = mysql_fetch_assoc($photos_query)){?>
                        <tr><td><a href="photos.php?album=<?php echo $RsPhotos['album'];?>&index=2"><?php echo $RsPhotos['album'];?></a></td><td><?php echo date("jS \of F, Y", strtotime($RsPhotos['date_added']));?></td></tr>
						<?php }?>
                    </table>
                    </div>
                </div>
				<?php }if($user_nums > 0){?>
                <div class="result_box">
                	<a href="javascript:table_collapse('users_table')">User Results</a>
                	<hr />
                    <div id="users_table" style="display:none;">
                    <table class="lessons_table" >
                    	<tr><td>Full Name</td><td>Username</td><td>Image</td></tr>
                        <?php while($RsUsers = mysql_fetch_assoc($user_query)){?>
                        <tr><td><a href="other_user.php?id=<?php echo $RsUsers['user_id'];?>"><?php echo $RsUsers['full_name'];?></a></td><td><?php echo $RsUsers['username'];?></td><td><img src="<?php echo $RsUsers['image'];?>" width="180" height="130"/></td></tr>
						<?php }?>
                    </table>
                    </div>
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
