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

$lessons_sql = "SELECT * FROM LESSONS ORDER BY instrument, period, day";
	$lessons_query = mysql_query($lessons_sql) or die(mysql_error());
	$current_instrument = "";
	$current_period = 0;
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
function show_times(id){
var table_div = document.getElementById(id);
if (table_div.style.display == 'none'){
	table_div.style.display = 'block';
	
}else{
table_div.style.display = 'none';
}
}
function add_new(){
var select_input = document.getElementById('instrument_select');
var new_input = document.getElementById('new_instrument');
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
var select_input = document.getElementById('instrument_select');
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
            	<?php if($logged_in){if($RsUser['admin']){
				$instruments_sql = "SELECT instrument FROM lessons";
				$instruments_query = mysql_query($instruments_sql) or die(mysql_error());
				?>
            	<div id="admin">
                	Edit Instrument Lessons
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
							echo '<span style="color:#F00;">That instrument name already exists. Please enter a different name</span>';
							break;
						}
					}
					?>
                    <form action="admin.php" method="post" id="admin_form">
                    <input type="hidden" value="lessons" name="type"/>
                    Instrument<select name="instrument" onChange="add_new()" id="instrument_select">
                    <option value="add_new">Add New Instrument</option>
                    <?php while($row = mysql_fetch_assoc($instruments_query)){
					if ($row['instrument'] != $current_instrument){
					 $current_instrument = $row['instrument'];?>
                    <option value="<?php echo $row['instrument'];?>"><?php echo ucfirst($row['instrument']);?></option>
					<?php }}?>
                    </select><br />
                    <span id="new_instrument">New Instrument <input name="new" type="text" size="16" /></span>
                    <div id="not_new" style="display:none;">
                    Day<select name="day">
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    </select>
                    Period<select name="period" style="width:30px;">
                   <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    </select>
                    <br />
                    Student/s<input type="text" size="20" name="student"/>
                    </div>
                    <a href="javascript:submit('admin_form')"class="red_box_links" style="width:100px;height:20px;">Submit</a>
                    </form>
                </div>
                <?php }} ?>
				<div id="lessons_box">
					Instrument Lessons
					<hr />
                    <?php 
					$current_instrument = "";
					while ($RsLessons = mysql_fetch_assoc($lessons_query)){
					 if ($RsLessons['instrument'] != $current_instrument){
					 $current_instrument = $RsLessons['instrument'];
					?>
					<br /><a href="javascript:show_times('<?php echo $RsLessons['instrument'];?>')"><?php echo ucfirst($RsLessons['instrument']);?></a>
					<div id="<?php echo $RsLessons['instrument'];?>" <?php if(isset($_GET['instrument'])){
																				if($_GET['instrument'] == $RsLessons['instrument']){
																				echo 'style="display:block;"';}
																				else{echo 'style="display:none;"';}
																				}else{echo 'style="display:none;"';}
																				?>
                    <table class="lessons_table">
							<tr><td></td><td class="td_header">Monday</td><td class="td_header">Tuesday</td><td class="td_header">Wednesday</td><td class="td_header">Thursday</td><td class="td_header">Friday</td></tr>
                            <?php }?>
							<?php if($current_period != $RsLessons['period']){
									$current_period = $RsLessons['period'];
									echo '<tr><td class="td_header">Period ' . $RsLessons['period'] . '</td>';
									}
								echo "<td>" . $RsLessons['student'] ."</td>";
								if($RsLessons['day'] == 5){echo '</tr>';}
								if($RsLessons['day'] == 5 && $RsLessons['period'] == 6){
								echo '</table></div>';
								}
								}?>
					<br /><br />To schedule a lesson time, call 555-5555 ext 5, or email abc@sacredheart.school.nz 
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
