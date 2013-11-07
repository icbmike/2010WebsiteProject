<?php include('includes/dbconn.php');
session_start();
if (!isset($_SESSION['shcmusic']['username'])){
	header('Location: index.php');
	exit;
}
function convertBreaks($string)
{
return str_replace("\n", "<br />", $string);
}
function convertSpace($string)
{
return str_replace(" ", "_", $string);
}
if(isset($_GET['action'])){
	$action = $_GET['action'];
}elseif(isset($_POST['action'])){
	$action = $_POST['action'];
}

if($action == 'approve'){
	$approve_sql = sprintf("UPDATE friends SET approved = 1 WHERE friendship_id = '%d' AND username = '%s'", $_GET['fid'], $_GET['username']);
	$approve_query = mysql_query($approve_sql) or die(mysql_error());
	
	$alert_sql = sprintf("INSERT INTO alerts (content, user, viewed, date_time) VALUES ('<a href=\"other_user.php?id=%d\">%s</a> has accepted your friend request!', '%s', 0, '%s')", $_GET['user_id'],  $_GET['username'], $_GET['sender'],date("Y-m-d G:i:s", time())); 
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: friends.php');
	exit;
}elseif($action == 'delete'){
	$delete_sql = sprintf("DELETE FROM friends WHERE friendship_id = '%d'", $_GET['fid']);
	$delete_query = mysql_query($delete_sql) or die(mysql_error());
	
	$alert_sql = sprintf("INSERT INTO alerts (content, user, viewed, date_time) VALUES ('%s deleted you as a friend', '%s', '0', '%s')", $_GET['username'], $_GET['ex_friend'], date("Y-m-d G:i:s", time()));
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: friends.php');
	exit;
}elseif($action == 'add'){
	$find_last_id_sql =  "SELECT MAX(friendship_id) AS last_fid FROM friends";
	$find_last_id_query = mysql_query($find_last_id_sql) or die(mysql_error());
	$last_id = mysql_fetch_assoc($find_last_id_query);
	$id_used =  $last_id['last_fid'] + 1;
	
	$add_sql = sprintf("INSERT INTO friends (friendship_id, username, approved) VALUES ('%d', '%s', '1'), ('%d', '%s', '0')", $id_used, $_GET['primary_user'], $id_used, $_GET['secondary_user']);
	$add_query = mysql_query($add_sql)or die(mysql_error());
	
	$alert_sql = sprintf("INSERT INTO alerts (content, user, viewed, date_time) VALUES ('<a href=\"friends.php\">%s wants to be your friend</a>', '%s', '0', '%s')", $_GET['primary_user'], $_GET['secondary_user'],  date("Y-m-d G:i:s", time()));
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: friends.php');
	exit;
}elseif($action == 'clear_alert'){
	$alert_sql = sprintf("UPDATE alerts SET viewed = '1' WHERE alert_id = '%d'", $_GET['alert_id']);
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: userpage.php');
	exit;
}elseif($action == 'user_edit'){
	//get current user information to compare against
	$user_sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_SESSION['shcmusic']['username']);
	$user_query = mysql_query($user_sql) or die(mysql_error());
	$RsUser = mysql_fetch_assoc($user_query);
	
	//transfer POST variables into real variables
	$fullname = $_POST['full_name'];
	$homeroom = $_POST['homeroom'];
	$old_pass = md5($_POST['old_password']);
	$new_pass = md5($_POST['new_password']);
	$confirm_pass = md5($_POST['password_confirm']);
	$email = $_POST['email'];
	$confirm_email = $_POST['email_confirm'];
	$instruments = $_POST['instruments'];
	$bands = $_POST['bands'];
	$description = convertBreaks($_POST['description']);
	if(isset($_POST['ncea_standards'])){
		$standards = $_POST['ncea_standards'];
	}
	
	if($old_pass != $RsUser['password']){
		header('Location: profile_edit.php?error=old_password');
		exit;
	}elseif($email != $confirm_email){
		header('Location: profile_edit.php?error=email');
		exit;
	}elseif($new_pass != $confirm_pass){
		header('Location: profile_edit.php?error=new_password');
		exit;
	}
	if($_POST['new_password'] == ""){
		$new_pass = $RsUser['password'];
	}
	
	$clear_old_sql = sprintf("DELETE FROM user_standards WHERE user = '%s'", $RsUser['username']);
	mysql_query($clear_old_sql) or die(mysql_error());
	
	if(isset($_POST['new_image'])){
	//check file type, file size and upload error
		if (!((($_FILES["image"]["type"] == "image/gif")
		|| ($_FILES["image"]["type"] == "image/png") 
		|| ($_FILES["image"]["type"] == "image/jpeg") 
		|| ($_FILES["image"]["type"] == "image/pjpeg"))
		&& ($_FILES["image"]["size"] < 500000)
		&& ($_FILES["image"]["error"] == 0)))
		{
			header('Location: profile_edit.php?error=image');
		}
		//Checking if file already exists and if not adding a number to the end.
		//If that file exists loop until the number on the end and the filename exist.
		//0therwise save it
		if (file_exists("images/users/" . convertSpace($_FILES["image"]["name"])))
		{
			$addendum = 1;
			while(file_exists("images/users/" . convertSpace($_FILES["image"]["name"] . $addendum))){
				$addendum += 1;
			}
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"images/users/" . $_FILES["image"]["name"] . $addendum);
			$image = "images/users/" . convertSpace($_FILES["image"]["name"] . $addendum);
		}
		else
		{
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"images/users/" . $_FILES["image"]["name"]);
			$image = "images/users/" . $_FILES["image"]["name"];	
		}	
	}else{
		$image = $RsUser['image'];
	}
	
	$update_sql = sprintf("UPDATE users SET full_name = '%s', homeroom = '%s', password = '%s', email = '%s', instruments = '%s', bands = '%s', description = '%s', image = '%s' WHERE username = '%s'", $fullname, $homeroom, $new_pass, $email, $instruments, $bands, $description, $image, $RsUser['username']);
	mysql_query($update_sql) or die(mysql_error());
	
	if(isset($_POST['ncea_standards'])){
		foreach($standards as $s){
			$standards_sql = sprintf("INSERT INTO user_standards (user, standard_number) VALUES ('%s', '%d')", $RsUser['username'], $s);
			$standards_query = mysql_query($standards_sql) or die(mysql_query()); 
		}
	}
	header('Location: userpage.php');
	exit;
}

?>