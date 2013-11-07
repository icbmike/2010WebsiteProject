<?php                                                                 
//COnnect to MYSQL as the php acount at localhost                     
@ $dbconn = mysql_connect('localhost', 'php', 'riven02');             
//if connection was not succesful show error and exit                 
if (!$dbconn){                                                         
    echo 'could not connect to the databse server';              
    exit;                                                             
}                                                                     
// select the 'names_db' database on the $dbconn connectiom           
mysql_select_db("shcmusic", $dbconn) or die(mysql_error());

date_default_timezone_set("Pacific/Auckland");

function day($d){
	switch($d){
		case 1:
		return "Monday";
		break;
		case 2:
		return "Tuesday";
		break;
		case 3:
		return "Wednesday";
		break;
		case 4:
		return "Thursday";
		break;
		case 5:
		return "Friday";
		break;
	}
}
?>
