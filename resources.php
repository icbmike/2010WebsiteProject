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
$resources_sql = sprintf("SELECT * FROM resources WHERE resource_id = '%s'", $_GET['id']);
$resources_query = mysql_query($resources_sql) or die(mysql_error());
$RsResource = mysql_fetch_assoc($resources_query);

$resources_id = true;
}
else{
$ncea_resources_sql = "SELECT resource_id, NCEA_level, resource_name FROM resources WHERE NCEA_level > 0 ORDER BY NCEA_level";
$instrument_resources_sql = "SELECT resource_id, instrument, grade, resource_name FROM resources WHERE NCEA_level = 0 ORDER BY instrument ASC, grade";
$resources_id = false;

$ncea_resources_query = mysql_query($ncea_resources_sql) or die(mysql_error());
$instrument_resources_query = mysql_query($instrument_resources_sql) or die(mysql_error());
}
$current_instrument = ""; 
$current_level = ""; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resources · SHC Music</title>
<link type="text/css" rel="stylesheet" href="style.css" /> 
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
function Rtype (){
var radio = document.getElementById('instrument');
var text = document.getElementById('which_instrument');
var grade = document.getElementById('grade');
var level = document.getElementById('level');
var standard = document.getElementById('standard');
if (radio.checked){
	text.disabled = false;
	grade.disabled = false;
	level.disabled = true;
	level.value = "";
	standard.disabled = true;
	standard.value = "";
}else{
	level.disabled = false;
	standard.disabled = false;
	text.disabled = true;
	text.value = "";
	grade.disabled = true;
	grade.value = "";
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
				<?php if(!isset($_GET['id'])){
					if($logged_in){if($RsUser['admin']){?>
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
                	<form method="post" action="admin.php" id="admin_form">
                    	Add Resource<hr />
                        <input type="hidden" value="resource" name="type"/>
                        Resource Name<br />
                        <input type="text" name="resource_name" size="40" /><br />
                        Article Content<br />
                        <textarea name="content" rows="8" cols="100"></textarea><br />
                        Resource Type<br />
                        <input type="radio" id="NCEA" name="resource_type" value="NCEA" onClick="Rtype()" />NCEA<br />
                        <input type="radio" id="instrument"name="resource_type" value="instrument" onClick="Rtype()" />Instrument<br />
                        Which Instrument<br />
                        <input type="text" id="which_instrument" name="instrument" size="16" /><br />
                        What Grade<br />
                        <Input type="text" id="grade" name="grade" size="5" /><br />
                        What NCEA Level<br />
                        <Input type="text" id="level" name="level" size="5" /><br />
                        Standard Number<br />
                        <Input type="text" id="standard" name="standard" size="6" /><br />
                        Article Links seperated by commas<br />
                        <textarea name="links" rows="8" cols="100" ></textarea><br />
                        <a href="javascript:submit('admin_form')" class="red_box_links" style="width:100px;height:20px;">Submit</a>
                    </form>
                </div>
                <?php }}?>
				<div id="ncea_resources">
                	NCEA Resources
                	<hr />
                    <?php 
					while($RsNCEA = mysql_fetch_assoc($ncea_resources_query)){
						if ($current_level != $RsNCEA['NCEA_level']){
							echo "NCEA Level " . $RsNCEA['NCEA_level'] . "<br />";
							$current_level = $RsNCEA['NCEA_level'];
						}
						echo '<a href="resources.php?id=' . $RsNCEA['resource_id'] . '" style="color:#FF0000;">' . $RsNCEA['resource_name'] . '</a><br />';					
					}?>
                </div>
                <div id="instrument_resources">
                	Instrument Resources
                	<hr />
                    <?php 
					while($RsInstruments = mysql_fetch_assoc($instrument_resources_query)){
						if ($current_instrument != $RsInstruments['instrument']){
							echo $RsInstruments['instrument'] . "<br />";
							$current_instrument = $RsInstruments['instrument'];
						}
						if($RsInstruments['grade'] > 0){
							echo '<a href="resources.php?id=' . $RsInstruments['resource_id'] . '" style="color:#FF0000;">' . $RsInstruments['resource_name']  . " Grade " . $RsInstruments['grade']. '</a><br />';
						}else{
							echo '<a href="resources.php?id=' . $RsInstruments['resource_id'] . '" style="color:#FF0000;">' . $RsInstruments['resource_name'] . '</a><br />';
						}
											
					}?>
                </div>
                <?php }else{?>
                <div id="resource">
					<?php echo $RsResource['resource_name'];?>
                    <hr />
                    <?php if($RsResource['links'] != ""){?>
                    	<div id="links">
                        Useful Links
                        <hr />
                        <?php 
						$links = explode(", ", $RsResource['links']);
						foreach($links as $lnk){
							echo  '<a href="' . $lnk .'">' . $lnk . '</a><br />';
						}?>
                        </div>
                       <?php }?>
                    <?php 
					if ($RsResource['NCEA_level'] > 0){
					echo "NCEA Level " . $RsResource['NCEA_level'];
					}else{
					if($RsResource['grade'] > 0){
						echo $RsResource['instrument'] . " Grade " . $RsResource['grade'];
					}else{
					echo $RsResource['instrument'];
					}}?>
                    <br /><br />
                    <?php echo $RsResource['content'];?><br  />
                    <a href="resources.php" class="red_box_links" style="width:100px; height:20px;">More Resources</a>
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
