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
$events_sql = sprintf("SELECT * FROM events WHERE event_id = '%s'", $_GET['id']);
$events_id = true;
}
else{
$events_sql = "SELECT * FROM events  WHERE happened <> 1 ORDER BY date ASC LIMIT 0, 10";
$events_id = false;
}
$events_query = mysql_query($events_sql) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events · SHC Music</title>
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
                	<form  enctype="multipart/form-data" method="post" action="admin.php" id="admin_form" >
                    	<input type="hidden" value="events" name="type"/>
                        Add New Event<hr />
                        Headline<br  />
                        <input type="text" name="headline" size="16" /><br />
                        Date<br />                       
                        <select name="day">
                            <option> - Day - </option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select name="month">
                            <option> - Month - </option>
                            <option value="01">January</option>
                            <option value="02">Febuary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="year">
                            <option> - Year - </option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                        </select>
                        <br  />
                        Text content<br  />
                        <textarea name="content"  rows="8" cols="100"></textarea><br  />
                        The image for the event<br  />
                        <input type="file" name="image" size="16" /><br />
                        Keep the file size below 500Kb
                        <br />
						<a href="javascript:submit('admin_form')" class="red_box_links" style="width:100px;height:20px;">Submit</a>
                    </form>
                </div>
				<?php } }
				while($RsEvents = mysql_fetch_assoc($events_query)){
				if (date("Y-m-d", time()) == $RsEvents['date']){
				$happened_sql = sprintf("UPDATE events SET happened = 1 WHERE event_id = '%d'", $RsEvents['event_id']);
				$happend_query = mysql_query($happened_sql) or die(mysql_error());
				}?>
                <div class="news_box">
					<?php echo $RsEvents['headline'] . " · " . date("jS \of F, Y",strtotime($RsEvents['date']));?>
                    <hr />
                    <img src="<?php echo $RsEvents['image'];?>" style="float:right; margin:5px;padding:2px;" width="225" />
                    <p><?php if($events_id == false){echo substr($RsEvents['content'], 0, 1400) . "...";}else{echo $RsEvents['content'];}?></p> 
                    <br />
                    <a href="events.php<?php if($events_id == false){echo "?id=" . $RsEvents['event_id'];}?>" class="red_box_links" style="width:80px; height:  20px;"><?php if($events_id == false){echo "Read More";}else{echo "More Events";}?></a>
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
