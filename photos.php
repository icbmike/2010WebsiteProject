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

if(!isset($_GET['album'])){
	$photos_sql = "SELECT DISTINCT album FROM photos ORDER BY date_added";
	$photos_query = mysql_query($photos_sql) or die(mysql_error());
}else{
	$photos_sql = sprintf("SELECT * FROM photos WHERE album = '%s' AND album_index = '%d'", $_GET['album'], $_GET['index']);
	$photos_query = mysql_query($photos_sql) or die(mysql_error());
	$RsPhoto = mysql_fetch_assoc($photos_query);
	
	$max_sql = sprintf("SELECT MAX(album_index) AS last_index FROM photos WHERE album = '%s'", $_GET['album']);
	$max_query = mysql_query($max_sql) or die(mysql_error());
	$max = mysql_fetch_assoc($max_query);
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
function show_gallery(id){
var gallery_div = document.getElementById(id);
if (gallery_div.style.display == 'none'){
	gallery_div.style.display = 'block';
}else{
gallery_div.style.display = 'none';
}
}
function add_new(){
var select_input = document.getElementById('album_select');
var new_input = document.getElementById('new_album');
var not_new = document.getElementById('not_new');
if (select_input.selectedIndex == 0){
	new_input.style.display = 'block';
	not_new.style.display = 'none';
}else{
new_input.style.display = 'none';
not_new.style.display = 'block';
}
}
function onload(){
var select_input = document.getElementById('album_select');
select_input.selectedIndex = 1;
}
</script>
</head>
<body onLoad="onload()">
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
                    <a href="userpage.php" style="color:#FF0000;">Profile Page</a> � <a href="sign_out.php"style="color:#FF0000;">Sign Out</a><br />
                    <a href="lessons.php">Lessons</a> � <a href="events.php">Events</a><br />
                    <a href="resources.php">Resources</a> � <a href="photos.php">Photos</a>
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
            <?php if($logged_in && $RsUser['admin'] && !isset($_GET['album'])){?>
				<div id="admin">
				Add Photos
				<hr />
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
				<form id="admin_form" enctype="multipart/form-data" method="post" action="admin.php">
                <input type="hidden" value="photos" name="type"/>
                <input type="hidden" value="<?php echo date("Y-m-d", time());?>" name="date_added"/>
				Photo album: <select name="album" onChange="add_new()" id="album_select">
                    <option value="add_new">Add New Album</option>
                    <?php while($RsAlbums = mysql_fetch_assoc($photos_query)){
					if ($RsAlbums['album'] != $current_album){
					 $current_instrument = $RsAlbums['album'];?>
                    <option value="<?php echo $RsAlbums['album'];?>"><?php echo ucfirst($RsAlbums['album']);?></option>
					<?php }}?>
                    </select>
                    <br />
                  	<span  id="new_album">New Album <input type="text" name="new_album" size="16" /></span>
                    <div id="not_new" style="display:none;">
                    New Photo <input type="file" name="image" size="16" />
                    </div>
                    <a class="red_box_links" style="width:100px;height:20px;" href="javascript:submit('admin_form')">Submit</a>
				</form>
				</div>
                <?php }?>
				<div id="photos">
					Photos <?php if(isset($_GET['album'])){echo '� ' . $_GET['album'];}?>
					<hr />
                    <br />
                    	<?php if(isset($_GET['album'])){?>
                        <div class="photo_gallery_div">
                            <img id="photo" src="<?php echo $RsPhoto['photo'];?>"/>
                            <?php if($_GET['index'] < $max['last_index']){?>
                            <a href="photos.php?album=<?php echo $_GET['album'];?>&index=<?php echo $_GET['index'] + 1;?>" class="red_box_links" style="width:100px;height:20px;float:right;">Next</a>
                            <?php }if($_GET['index'] > 2){?>
                            <a href="photos.php?album=<?php echo $_GET['album'];?>&index=<?php echo $_GET['index'] - 1;?>" class="red_box_links" style="width:100px;height:20px;">Previous</a>
                            <?php }?>
                            <a href="photos.php" class="red_box_links" style="width:150px;height:20px;margin-left:auto;margin-right:auto;">Back to Photo Albums</a>
                        </div>
						<?php }else{
						mysql_data_seek($photos_query, 0);
						while($RsAlbums = mysql_fetch_assoc($photos_query)){?>
                        <a href="photos.php?album=<?php echo $RsAlbums['album'];?>&index=2"><?php echo $RsAlbums['album'];?></a><br />
						 <?php }}?>
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
