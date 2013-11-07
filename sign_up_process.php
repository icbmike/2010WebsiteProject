<?php include("includes/dbconn.php");
function convertSpace($string)
{
return str_replace(" ", "_", $string);
}
function convertBreak($string)
{
return str_replace("\n", "<br />", $string);
}
//checl required fields
if($_POST['username'] == "" ||
   $_POST['full_name'] == "" ||
   $_POST['homeroom'] == "" ||
   $_POST['password'] == "" ||
   $_POST['password_confirm'] == "" || 
   $_POST['email'] == "" ||
   $_POST['email_confirm'] == "")
   {
	header('Location: sign_up.php?error=empty');
	exit;
}
//check passwords and emails match
if($_POST['password'] != $_POST['password_confirm']){
	header('Location: sign_up.php?error=password');
	exit;
	}
if($_POST['email'] != $_POST['email_confirm']){
	header('Location: sign_up.php?error=email');
	exit;
	}
	
//check file type, file size and upload error
if (!((($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/png") 
|| ($_FILES["image"]["type"] == "image/jpeg") 
|| ($_FILES["image"]["type"] == "image/pjpeg"))
&& ($_FILES["image"]["size"] < 500000)
&& ($_FILES["image"]["error"] == 0)))
{
    header('Location: sign_up.php?error=image');
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
//grab all the POST varibles into real variables
$username = $_POST['username'];
$fullname = $_POST['full_name'];
$homeroom = $_POST['homeroom'];
$password = md5($_POST['password']); // encrypt the password
$email = $_POST['email'];


$instruments = $_POST['instruments'];
$bands = $_POST['bands'];
$description = convertBreak($_POST['description']);
if(isset($_POST['ncea_standards'])){
	$standards = $_POST['ncea_standards'];
}

//check if username already exists
$check_sql = sprintf("SELECT user_id FROM users WHERE username = '%s'", $username);
$check_query = mysql_query($check_sql) or die(mysql_error());
$check_num_rows = mysql_num_rows($check_query);

if($check_num_rows > 0){
	header('Location: sign_up.php?error=username');
	exit;
}


$sign_up_sql = sprintf("INSERT INTO users (username, full_name, password, email, homeroom, instruments, bands, description, image) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $username, $fullname, $password, $email, $homeroom, $instruments, $bands, $description, $image);
$sign_up_query = mysql_query($sign_up_sql) or die(mysql_error());

if(!empty($standards)){
	foreach($standards as $s){
		$standards_sql = sprintf("INSERT INTO user_standards (user, standard_number) VALUES ('%s', '%s')", $username, $s);
		mysql_query($standards_sql) or die(mysql_error());
	}
}

header('Location: index.php');

?>