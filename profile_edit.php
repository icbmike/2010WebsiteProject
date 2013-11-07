<?php include('includes/dbconn.php');
session_start();
if (!isset($_SESSION['shcmusic']['username'])){
	header('Location: index.php');
	exit;
}
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
	
	$standards_sql = sprintf("SELECT standard_number FROM user_standards WHERE user = '%s'", $RsUser['username']);
	$standards_query = mysql_query($standards_sql) or die(mysql_error());
	$standards = array(); 
	
	while($RsStandards = mysql_fetch_assoc($standards_query)){
		array_push($standards, $RsStandards['standard_number']);
	}
	
function br2newline($string){
	return str_replace('<br />', '', $string);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $RsUser['username'];?> · SHC Music</title>
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
function show_update(){
var button = document.getElementById('update_button');
button.style.display = 'block';
}
function collapse_standards(id){
var standards_div = document.getElementById(id);
if (standards.style.display == 'none'){
	standards.style.display = 'block';
	switch(id)
	{
	case '1':
	document.getElementById('2').style.display = 'none';
	document.getElementById('3').style.display = 'none';
	break;
	case '2':
	document.getElementById('1').style.display = 'none';
	document.getElementById('3').style.display = 'none';
	break;
	case '3':
	document.getElementById('1').style.display = 'none';
	document.getElementById('2').style.display = 'none';
	break;
	}
}else{
standards.style.display = 'none';
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
            	<div id="admin">
                Edit Profile
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
							echo '<span style="color:#F00;">There was a problem uploading the file you selected.<br />Please make sure it\'s the right file type and below 500kB in size.</span>';
							break;
						}
					}
					?>
                	<form action="user_edit.php" method="post" id="sign_up_form" enctype="multipart/form-data">	
                        <input type="hidden" value="user_edit" name="action"/>
                        Please fill out the form honestly - * indicates required field<br /><br />
                            Please enter your full name<br />
                            <input name="full_name" type="text" size="16" value="<?php echo $RsUser['full_name'];?>"/><br />
                            Please enter your homeroom<br />
                            <input name="homeroom" type="text" size="16" value="<?php echo $RsUser['homeroom'];?>"/><br />
                            Enter your new password and confirm it<br />
                            <input name="new_password" type="password" size="16" />
                            <input name="password_confirm" type="password" size="16" /><br />
                            Please enter and confirm your new email address<br />
                            <input name="email" type="text" size="16" value="<?php echo $RsUser['email'];?>"/>
                            <input name="email_confirm" type="text" size="16" value="<?php echo $RsUser['email'];?>"/><br />
                            Please enter any instruments you play sperated by commas<br />
                            <textarea name="instruments" cols="32" rows="4"><?php echo $RsUser['instruments']?></textarea><br />
                            Please enter your favourite bands seperated by commas<br />
                            <textarea name="bands" cols="32" rows="4" ><?php echo $RsUser['bands'];?></textarea><br />
                            Please give a brief description of yourself<br />
                            <textarea name="description" cols="32" rows="8" ><?php echo br2newline($RsUser['description']);?></textarea><br />
                    		Please select the NCEA standards you're taking<br />
                            <a href="javascript:collapse_standards('3')">Level 3</a>
                            <div id="3" style="display:none;">
                                <input type="checkbox" name="ncea_standards[]" value="90497"<?php foreach($standards as $s){if ($s == '90497'){echo 'checked="checked"';}}?>>90497 - Examine the contexts that influence <br />the expressive qualities of music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90498"<?php foreach($standards as $s){if ($s == '90498'){echo 'checked="checked"';}}?>>90498 - Compare and contrast music works<br />
                                <input type="checkbox" name="ncea_standards[]" value="90499"<?php foreach($standards as $s){if ($s == '90499'){echo 'checked="checked"';}}?>>90499 - Research and present a music topic<br />
                                <input type="checkbox" name="ncea_standards[]" value="90526"<?php foreach($standards as $s){if ($s == '90526'){echo 'checked="checked"';}}?>>90526 - Present a performance of a programme of <br />music as a member of a group<br />
                                <input type="checkbox" name="ncea_standards[]" value="90527"<?php foreach($standards as $s){if ($s == '90527'){echo 'checked="checked"';}}?>>90527 - Arrange Music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90530"<?php foreach($standards as $s){if ($s == '90530'){echo 'checked="checked"';}}?>>90530 - Demonstrate an understanding of harmonic and <br/>tonal procedures in a range of music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90775"<?php foreach($standards as $s){if ($s == '90775'){echo 'checked="checked"';}}?>>90775 - Present a portfolio of musical composition<br />
                                <input type="checkbox" name="ncea_standards[]" value="90776"<?php foreach($standards as $s){if ($s == '90776'){echo 'checked="checked"';}}?>>90776 - Prepare and present performances of music as <br />a featured soloist<br />
                                <input type="checkbox" name="ncea_standards[]" value="90777"<?php foreach($standards as $s){if ($s == '90777'){echo 'checked="checked"';}}?>>90777 - Demonstrate aural skill across a range of musical <br />styles and genres<br />
                            </div>
                            <br />
                            <a href="javascript:collapse_standards('2')">Level 2</a>
                            <div id="2"style="display:none;">
                                <input type="checkbox" name="ncea_standards[]" value="90264"<?php foreach($standards as $s){if ($s == '90264'){echo 'checked="checked"';}}?>>90264 - Present contrasting performances as a <br />featured soloist<br />
                                <input type="checkbox" name="ncea_standards[]" value="90265"<?php foreach($standards as $s){if ($s == '90265'){echo 'checked="checked"';}}?>>90265 - Present a music performance as a member of <br />a group<br />
                                <input type="checkbox" name="ncea_standards[]" value="90266"<?php foreach($standards as $s){if ($s == '90266'){echo 'checked="checked"';}}?>>90266 - Compose effective pieces of music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90267"<?php foreach($standards as $s){if ($s == '90267'){echo 'checked="checked"';}}?>>90267 - Create an instrumentation<br />
                                <input type="checkbox" name="ncea_standards[]" value="90268"<?php foreach($standards as $s){if ($s == '90268'){echo 'checked="checked"';}}?>>90268 - Identify, describe and transcribe elements <br />of music through listening to a range of music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90269"<?php foreach($standards as $s){if ($s == '90269'){echo 'checked="checked"';}}?>>90269 - Demonstrate an understanding of the materials <br />and processes of music in a range of scores<br />
                                <input type="checkbox" name="ncea_standards[]" value="90270"<?php foreach($standards as $s){if ($s == '90270'){echo 'checked="checked"';}}?>>90270 - Demonstrate knowledge and understanding of <br />music works<br />
                            </div>
                            <br />
                            <a href="javascript:collapse_standards('1')">Level 1</a>
                            <div id="1" style="display:none;">
                                <input type="checkbox" name="ncea_standards[]" value="90012"<?php foreach($standards as $s){if ($s == '90012'){echo 'checked="checked"';}}?>>90012 - Perform contrasting music as a featured soloist<br />
                                <input type="checkbox" name="ncea_standards[]" value="90013"<?php foreach($standards as $s){if ($s == '90013'){echo 'checked="checked"';}}?>>90013 - Perform music as a member of a group<br />
                                <input type="checkbox" name="ncea_standards[]" value="90014"<?php foreach($standards as $s){if ($s == '90014'){echo 'checked="checked"';}}?>>90014 - Compose music to meet specified requirements<br />
                                <input type="checkbox" name="ncea_standards[]" value="90015"<?php foreach($standards as $s){if ($s == '90015'){echo 'checked="checked"';}}?>>90015 - Aurally identify, describe and transcribe<br /> music elements from simple music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90016"<?php foreach($standards as $s){if ($s == '90016'){echo 'checked="checked"';}}?>>90016 - Identify and describe fundamental materials <br />of music<br />
                                <input type="checkbox" name="ncea_standards[]" value="90017"<?php foreach($standards as $s){if ($s == '90017'){echo 'checked="checked"';}}?>>90017 - Demonstrate knowledge of music works<br />
                            </div>
                            <br />
                            <br />
                            <img style="max-width:350px;padding:2px; border:1px solid #F00;-moz-border-radius:4px;" src="<?php echo $RsUser['image'];?>"><br />
                            If you want a new profile image, check the box and select an image<br />
                            <input type="checkbox" name="new_image" value="true"/>
                            <input type="file" name="image" size="16" />
                            <br />
                            Please don't upload any image over 500kb in size <br />Please use JPEGs or GIFs <br />
                            <br />
                            Enter your current password - <span style="color:#FF0000;">This must be entered</span><br />
                            <input name="old_password" type="password" size="16" onkeydown="show_update()"/><br />
                            <br />
                            <a id="update_button" href="javascript:submit('sign_up_form')" class="red_box_links" style="width:100px;height:20px;display:none;">Update</a>
                    </form>
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

