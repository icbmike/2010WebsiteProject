<?php include('includes/dbconn.php');
session_start();
if(isset($_SESSION['shcmusic']['username'])){
	header('Location: userpage.php');
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
</script>
</head>
<body>
	<div id="main_box">
		<div id="header">
			<div id="banner">
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
			</div>
			<div id="navbar">
            	<ul class="navbar">
					<li><a class="navbar_links" href="index.php">Home</a></li>
					<li><a class="navbar_links" href="news.php">News</a></li>
					<li><a class="navbar_links" href="events.php">Events</a></li>
					<li><a class="navbar_links" href="resources.php">Resources</a></li>
					<li><a class="navbar_links" href="lessons.php">Lessons</a></li>				
                </ul>
                <form action="search.php" method="get" id="search_form">
					<a class="right" id="search_link" href="javascript:submit('search_form')">Search</a>
					<input class="right" id="search_input" size="16" type="text" name="query" value="" />
				</form>
			</div>
	  	</div>
		<div id="main_content">
			<div id="container_box">
				<div id="about">
					About Us
					<hr />
					Sacred Heart College is a Catholic Marist and Champagnat boys' school for Years 7-13 with boarding and dayboy options. Our vision is to prepare each student to leave the College well grounded in his faith, and ready and able to participate in a complex and changing world. We value excellence in all endeavours.

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
