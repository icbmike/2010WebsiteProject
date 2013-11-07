<?php include('includes/dbconn.php');
session_start();
if (!isset($_POST['username']) || !isset($_POST['password'])){
	header("Location: loginerror.php");
	exit;
}else{
	$username = $_POST['username'];
	$password = md5($_POST['password']); //encrypt password
	
	$login_check_sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$login_check_query = mysql_query($login_check_sql) or die (mysql_error());  
	$login_check_num_rows = mysql_num_rows($login_check_query);
	
	if($login_check_num_rows != 0){
		
		$rsUser_info = mysql_fetch_assoc($login_check_query) or die(mysql_error());
		
		$_SESSION['shcmusic']['username'] = $rsUser_info['username'];
		
		header('Location: userpage.php');
	}else{
		header('Location: loginerror.php');
		exit;
	}
}
?>