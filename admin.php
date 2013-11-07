<?php include("includes/dbconn.php");
header('Location: index.php');
function convertSpace($string)
{
return str_replace(" ", "_", $string);
}
function convertBreaks($string)
{
return str_replace("\n", "<br />", $string);
}
if($_POST['type'] == "events"){
	//check required fields
	if($_POST['headline'] == "" ||
	   $_POST['content'] == "" ||
	   $_POST['day'] == "" ||
	   $_POST['month'] == "" ||
	   $_POST['year'] == "")
	   {
		header('Location: events.php?error=empty');
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
		header('Location: events.php?error=image');
	}
	//Checking if file already exists and if not adding a number to the end.
	//If that file exists loop until the number on the end and the filename exist.
	//0therwise save it
	if (file_exists("images/events/" . convertSpace($_FILES["image"]["name"])))
	{
		$addendum = 1;
		while(file_exists("images/events/" . convertSpace($_FILES["image"]["name"] . $addendum))){
			$addendum += 1;
		}
		move_uploaded_file($_FILES["image"]["tmp_name"],
		"images/events/" . $_FILES["image"]["name"] . $addendum);
		$image = "images/events/" . convertSpace($_FILES["image"]["name"] . $addendum);
	}
	else
	{
		move_uploaded_file($_FILES["image"]["tmp_name"],
		"images/events/" . $_FILES["image"]["name"]);
		$image = "images/events/" . $_FILES["image"]["name"];
		
	}
	//grab all the POST varibles into real variables
	$headline = $_POST['headline'];
	$date = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
	$content = convertBreaks($_POST['content']);
	
	$events_sql = sprintf("INSERT INTO events (headline, content, image, date) VALUES ('%s', '%s', '%s', '%s')", $headline, $content, $image, $date);
	$events_query = mysql_query($events_sql) or die(mysql_error());
	
	$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT username, '<a href=\"events.php?id=%d\">SHCMUSIC has a new event</a>',  0, '%s' FROM users", mysql_insert_id(), date("Y-m-d G:i:s", time()));
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: events.php');	
}
elseif($_POST['type'] == "news")
{
	//check required fields
	if($_POST['headline'] == "" ||
	   $_POST['content'] == "")
	   {
		header('Location: news.php?error=empty');
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
		header('Location: news.php?error=image');
	}
	//Checking if file already exists and if not adding a number to the end.
	//If that file exists loop until the number on the end and the filename exist.
	//0therwise save it
	if (file_exists("images/news/" . convertSpace($_FILES["image"]["name"])))
	{
		$addendum = 1;
		while(file_exists("images/news/" . convertSpace($_FILES["image"]["name"] . $addendum))){
			$addendum += 1;
		}
		move_uploaded_file($_FILES["image"]["tmp_name"],
		"images/news/" . $_FILES["image"]["name"] . $addendum);
		$image = "images/news/" . convertSpace($_FILES["image"]["name"] . $addendum);
	}
	else
	{
		move_uploaded_file($_FILES["image"]["tmp_name"],
		"images/news/" . $_FILES["image"]["name"]);
		$image = "images/news/" . $_FILES["image"]["name"];
		
	}
	//grab all the POST varibles into real variables
	$headline = $_POST['headline'];
	$date = $_POST['date'];
	$content = convertBreaks($_POST['content']);
	
	$news_sql = sprintf("INSERT INTO news (headline, content, image, date_added) VALUES ('%s', '%s', '%s', '%s')", $headline, $content, $image, $date);
	$news_query = mysql_query($news_sql) or die(mysql_error());
	
	$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT username, '<a href=\"news.php?id=%d\">SHCMUSIC has news</a>',  0, '%s' FROM users", mysql_insert_id(), date("Y-m-d G:i:s", time()));
	$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: news.php');
	
}elseif($_POST['type'] == "resource")
{
//check required fields
	if($_POST['resource_name'] == "" ||
	   $_POST['content'] == "" ||
	  ($_POST['resource_type'] == "NCEA" &&
	   $_POST['level'] == "") ||
	  ($_POST['resource_type'] == "instrument" &&
	   $_POST['instrument'] == "") ||
	  ($_POST['resource_type'] == "instrument" &&
	   $_POST['grade'] == ""))
	   {
		header('Location: resources.php?error=empty');
		exit;
	}
	//grab all the POST varibles into real variables
	$resource_name = $_POST['resource_name'];
	$content = convertBreaks($_POST['content']);
	$links = $_POST['links'];
	
	if($_POST['resource_type'] == "NCEA"){
		$NCEA_level = $_POST['level'];
		$standard  = $_POST['standard'];
		$instrument = "";
		$grade = 0;
	}else{
		$NCEA_level = 0;
		$standard  = 0;
		$instrument = $_POST['instrument'];
		$grade = $_POST['grade'];
	}
	
	$resource_sql = sprintf("INSERT INTO resources (resource_name, content, links, NCEA_level, standard_number, instrument, grade, date_added) VALUES ('%s', '%s', '%s', '%d', '%d', '%s', '%d', '%s')", $resource_name, $content, $links, $NCEA_level, $standard, $instrument, $grade, date("Y-m-d", time()));
	$resource_query = mysql_query($resource_sql) or die(mysql_error());
	
	if($_POST['resource_type'] == "NCEA"){
		$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT users.username, '<a href=\"resources.phpid=%d\">New NCEA Level %d Resource</a>', '0', '%s' FROM `users` JOIN user_standards ON users.username = user_standards.user JOIN resources ON resources.standard_number = user_standards.standard_number WHERE resources.NCEA_level = '%d'", mysql_insert_id(), $NCEA_level,  date("Y-m-d G:i:s", time()), $NCEA_level);
	}else{
		$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT users.username, '<a href=\"resources.php?id=%d\">New %s Resource</a>', '0', '%s' FROM `users` JOIN LESSONS ON users.full_name LIKE lessons.student WHERE lessons.instrument = '%s'", mysql_insert_id(), $instrument,  date("Y-m-d G:i:s", time()), $instrument);
	}
		$alert_query = mysql_query($alert_sql) or die(mysql_error());
	
	header('Location: resources.php');
}elseif($_POST['type'] == "lessons"){
	
	//transfer post variables into normal variables
	$student = $_POST['student'];
	$day = $_POST['day'];
	$period = $_POST['period'];
	$instrument = $_POST['instrument'];
	
	if($instrument == "add_new"){
		$instrument_new = $_POST['new'];
		$check_sql = sprintf("SELECT instrument FROM lessons WHERE instrument = '%s'", $instrument_new);
		$check_query = mysql_query($check_sql) or die(mysql_error());
		
		if(mysql_num_rows($check_query) != 0){
			header('Location: lessons.php?error=add');
			exit;
		}else{
		
			for ($day_i = 1;  $day_i < 6; $day_i++){
				for($period_i = 1; $period_i<7; $period_i++){	 
					$add_sql = sprintf("INSERT INTO lessons (instrument, day, period, student) VALUES ('%s', '%d','%d','')", $instrument_new, $day_i, $period_i);
					mysql_query($add_sql) or die(mysql_error());
				}
			}
			$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT username, '<a href=\"lessons.php\">SHCMUSIC has a new instrument Schedule</a>',  0, '%s' FROM users", date("Y-m-d G:i:s", time()));
			$alert_query = mysql_query($alert_sql) or die(mysql_error());
		}
	}
	$lesson_sql = sprintf("UPDATE lessons SET student = '%s' WHERE instrument = '%s' AND day = '%d' AND period = '%d'", $student, $instrument , $day, $period);
	mysql_query($lesson_sql) or die(mysql_error()); 
	header('Location: lessons.php');
	
}elseif($_POST['type'] == "photos"){
	//transfer post variables into normal variables
	$date_added = $_POST['date_added'];
	$album = $_POST['album'];
	$new_album = $_POST['new_album'];
	$max_sql = sprintf("SELECT MAX(album_index) AS last_index FROM photos WHERE album = '%s'", $album);
	$max_query = mysql_query($max_sql) or die(mysql_error());
	$index = mysql_fetch_assoc($max_query);
	
	if($album == 'add_new'){
		if($new_album == ""){
			header('Location: photos.php?error=empty');
			exit;
		}
	
		$check_sql = sprintf("SELECT album FROM photos WHERE album = '%s'", $new_album);
		$check_query = mysql_query($check_sql) or die(mysql_error());
		if(mysql_num_rows($check_query) > 0){
			header('Location: lessons.php?error=add');
			exit;
		}else{
			$add_new_sql = sprintf("INSERT INTO photos (album, album_index, photo, date_added) VALUES ('%s', 1, 'images/photos/default.png', '%s')", $new_album, $date_added);
			$add_new_query = mysql_query($add_new_sql) or die(mysql_error());
			
			$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT username, '<a href=\"photos.php\">SHCMUSIC has a new Photo Album</a>',  0, '%s' FROM users",$album, $index['last_index'] +1, date("Y-m-d G:i:s", time()));
			$alert_query = mysql_query($alert_sql) or die(mysql_error());
			
			header('Location: photos.php');
			exit;
		}
	}else{
		//check file type, file size and upload error
		if (!((($_FILES["image"]["type"] == "image/gif")
		|| ($_FILES["image"]["type"] == "image/png") 
		|| ($_FILES["image"]["type"] == "image/jpeg") 
		|| ($_FILES["image"]["type"] == "image/pjpeg"))
		&& ($_FILES["image"]["size"] < 5000000)
		&& ($_FILES["image"]["error"] == 0)))
		{
			header('Location: photos.php?error=image');
		}
		//Checking if file already exists and if not adding a number to the end.
		//If that file exists loop until the number on the end and the filename exist.
		//0therwise save it
		if (file_exists("images/photos/" . convertSpace($_FILES["image"]["name"])))
		{
			$addendum = 1;
			while(file_exists("images/photos/" . convertSpace($_FILES["image"]["name"] . $addendum))){
				$addendum += 1;
			}
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"images/photos/" . $_FILES["image"]["name"] . $addendum);
			$image = "images/photos/" . convertSpace($_FILES["image"]["name"] . $addendum);
		}
		else
		{
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"images/photos/" . $_FILES["image"]["name"]);
			$image = "images/photos/" . $_FILES["image"]["name"];
			
		}
		$add_new_sql = sprintf("INSERT INTO photos (album, album_index, photo, date_added) values ('%s', '%d', '%s', '%s')", $album, $index['last_index'] +1, $image, $date_added);
		$add_new_query = mysql_query($add_new_sql) or die(mysql_error());
		
		$alert_sql = sprintf("INSERT INTO alerts (user, content, viewed, date_time) SELECT username, '<a href=\"photos.php?album=%s&index=%d\">SHCMUSIC has a new Photo</a>',  0, '%s' FROM users",$album, $index['last_index'] +1, date("Y-m-d G:i:s", time()));
		$alert_query = mysql_query($alert_sql) or die(mysql_error());
		
		header('Location: photos.php');
		exit;
	}

}
?>