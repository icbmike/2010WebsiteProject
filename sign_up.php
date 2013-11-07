<?php include('includes/dbconn.php');
session_start();
if(isset($_SESSION['shcmusic']['username'])){
header('Location: index.php');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sign Up to SHC MUSIC</title>
<link type="text/css" rel="stylesheet" href="style.css" > 
<script type="text/javascript">
function submit (form_id)
{
var form = document.getElementById(form_id);
form.submit();
}
function collapse_standards(id){
var standards_div = document.getElementById(id);
if (standards_div.style.display == 'none'){
	standards_div.style.display = 'block';
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
standards_div.style.display = 'none';
}
}
</script>
</head>
<body>
	<div id="main_box">
		<div id="header">
			<div id="banner">
				<div id="sign_in">
                	<div style="margin:10px;">
						<form id="sign_in_form" method="post" action="sign_in.php">
							<input size="16" type="text" name="username" value="Username" />
							<a href="javascript:submit('sign_in_form')">Sign In</a>
							<br />
							<input size="16" type="password" name="password" value="******" />
							<a href="sign_up.php">Sign Up</a>
						</form>
                  </div>
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
				<div id="sign_up_form_div">
                	Sign Up
                    <hr />
                    <?php if(isset($_GET['error'])){
						switch ($_GET['error']){
							case 'username':
							echo '<span style="color:#F00;">The username you entered is taken</span>';
							break;
							case 'email':
							echo '<span style="color:#F00;">The email addresses you entered didn\'t match</span>';
							break;
							case 'password':
							echo '<span style="color:#F00;">The passwords you entered didn\'t match</span>';
							break;
							case 'image':
							echo '<span style="color:#F00;">There was a problem uploading the file you selected.<br />Please make sure it\'s the right file type and below 500kB in size.</span>';
							break;
							case 'empty':
							echo '<span style="color:#F00;">You left some essential fields empty</span>';
							break;
						}
					}
					?>
                    <form action="sign_up_process.php" method="post" id="sign_up_form" enctype="multipart/form-data">	
                        Please fill out the form honestly - * indicates required field<br /><br />
                        <div id="left_col" style="border-right:1px solid #000; padding-right: 3px">
                            Please enter your full name<br />
                            *<input name="full_name" type="text" size="16" /><br />
                            Please enter your desired username<br />
                            *<input name="username" type="text" size="16" /><br />
                            Please enter your homeroom<br />
                            *<input name="homeroom" type="text" size="16" /><br />
                            Please enter and confirm the password you want to use<br />
                            *<input name="password" type="password" size="16" />
                            *<input name="password_confirm" type="password" size="16" /><br />
                            Please enter and confirm your email address<br />
                            *<input name="email" type="text" size="16" />
                            *<input name="email_confirm" type="text" size="16" /><br />
                            Please enter any instruments you play sperated by commas<br />
                            <textarea name="instruments" cols="32" rows="4"></textarea><br />
                            Please enter your favourite bands seperated by commas<br />
                            <textarea name="bands" cols="32" rows="4" ></textarea><br />
                            Please give a brief description of yourself<br />
                            <textarea name="description" cols="32" rows="8" ></textarea>
                    	</div>
                        <div id="right_col" style="padding-left:5px;">
                    		Please select the NCEA standards you're taking<br />
                            <a href="javascript:collapse_standards('3')">Level 3</a>
                            <div id="3" style="display:none;">
                            <input type="checkbox" name="ncea_standards[]" value="90497">90497 - Examine the contexts that influence <br />the expressive qualities of music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90498">90498 - Compare and contrast music works<br />
                            <input type="checkbox" name="ncea_standards[]" value="90499">90499 - Research and present a music topic<br />
                            <input type="checkbox" name="ncea_standards[]" value="90526">90526 - Present a performance of a programme of <br />music as a member of a group<br />
                            <input type="checkbox" name="ncea_standards[]" value="90527">90527 - Arrange Music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90530">90530 - Demonstrate an understanding of harmonic and <br/>tonal procedures in a range of music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90775">90775 - Present a portfolio of musical composition<br />
                            <input type="checkbox" name="ncea_standards[]" value="90776">90776 - Prepare and present performances of music as <br />a featured soloist<br />
                            <input type="checkbox" name="ncea_standards[]" value="90777">90777 - Demonstrate aural skill across a range of musical <br />styles and genres<br />
                            </div>
                            <br />
                            <a href="javascript:collapse_standards('2')">Level 2</a>
                            <div id="2"style="display:none;">
                            <input type="checkbox" name="ncea_standards[]" value="90264">90264 - Present contrasting performances as a <br />featured soloist<br />
                            <input type="checkbox" name="ncea_standards[]" value="90265">90265 - Present a music performance as a member of <br />a group<br />
                            <input type="checkbox" name="ncea_standards[]" value="90266">90266 - Compose effective pieces of music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90267">90267 - Create an instrumentation<br />
                            <input type="checkbox" name="ncea_standards[]" value="90268">90268 - Identify, describe and transcribe elements <br />of music through listening to a range of music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90269">90269 - Demonstrate an understanding of the materials <br />and processes of music in a range of scores<br />
                            <input type="checkbox" name="ncea_standards[]" value="90270">90270 - Demonstrate knowledge and understanding of <br />music works<br />
                            </div>
                            <br />
                            <a href="javascript:collapse_standards('1')">Level 1</a>
                            <div id="1" style="display:none;">
                            <input type="checkbox" name="ncea_standards[]" value="90012">90012 - Perform contrasting music as a featured soloist<br />
                            <input type="checkbox" name="ncea_standards[]" value="90013">90013 - Perform music as a member of a group<br />
                            <input type="checkbox" name="ncea_standards[]" value="90014">90014 - Compose music to meet specified requirements<br />
                            <input type="checkbox" name="ncea_standards[]" value="90015">90015 - Aurally identify, describe and transcribe<br /> music elements from simple music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90016">90016 - Identify and describe fundamental materials <br />of music<br />
                            <input type="checkbox" name="ncea_standards[]" value="90017">90017 - Demonstrate knowledge of music works<br />
                            </div>
                            <br />
                            <br />
                            Please upload an image for your profile picture<br />
                            <input type="file" name="image" size="16" />
                            <br />
                            Please don't upload any image over 500kb in size <br />Please use JPEGs or GIFs <br />
                            <br />
                            <a href="javascript:submit('sign_up_form')" class="red_box_links" style="width: 100px;height: 20px;">Sign Up</a>
                        </div>
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
