<?php
	$config = parse_ini_file('../config.ini');
	mysql_connect($config['endpoint'],$config['username'],$config['password']);
	mysql_select_db($config['dbname']);

	$eventID = $_REQUEST['eventid'];

	$query = "update event set isExpired = 'f' where eventID = '$eventID'";

	$res = mysql_query($query);
	if(mysql_affected_rows() > 0){
				 echo 0;
				 }else{
              			 echo 1;
				 }

        mysql_close();
?>
