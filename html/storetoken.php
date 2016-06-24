<?php
	$config = parse_ini_file('../config.ini');
	mysql_connect($config['endpoint'],$config['username'],$config['password']);
	mysql_select_db($config['dbname']);

	$accesstoken = $_REQUEST['accesstoken'];
	$email = $_REQUEST['email'];
	$query = "select * from user where accesstoken='$accesstoken'";
	$result = mysql_query($query);
	$query = "update user set accesstoken='$accesstoken' where email='$email'";
	$result = mysql_query($query);
	if(!$result){
		echo "#databaseError,Database Error";
		mysql_close();
		return;
	}
	echo "success";
	mysql_close();
?>