<?php
	$config = parse_ini_file('../config.ini');
	mysql_connect($config['endpoint'],$config['username'],$config['password']);
	mysql_select_db($config['dbname']);

	$email = $_REQUEST['email'];
	$query = "select userID from user where email = '$email'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) == 0){
		echo 4;
		mysql_close();
		return;
	}
	$userid = mysql_fetch_row($res)[0];
	$query = "select * from
	user_event
	natural join event
	natural join questions_event
	natural join questions
	where userid = 42
	and questionid
	not in
	(select questionid
	from questions_feedback)";
	$res = mysql_query($query);
	while ($row = mysql_fetch_assoc($res)) {
	        
		$info[] = $row;
	}
	echo json_encode($info);
     	mysql_close();
?>