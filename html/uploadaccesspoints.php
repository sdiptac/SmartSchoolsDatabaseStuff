<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $email = $_REQUEST['email'];
	$ssid = $_REQUEST['ssid'];
	$bssid = $_REQUEST['bssid'];
	$duration = $_REQUEST['duration'];
        $query = "select userID from user where email = '$email'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) == 0){
                echo 4;
                mysql_close();
                return;
        }
        $userid = mysql_fetch_row($res)[0];


	$checkQuery = "select * from accesspoint where ssid = '$ssid' and bssid = '$bssid'";
	$checkResult = mysql_query($checkQuery);
	if(mysql_num_rows($checkResult) == 0){
		$createAPQuery = "insert into accesspoint(ssid, bssid) values ('$ssid','$bssid')";
		$createResult = mysql_query($createAPQuery);
		if(!$createResult){
			echo 1;
			mysql_close();
			return;
        	}
	}	

        $insertquery = "insert into accessedAP values ('$ssid','$bssid','$userid','$duration',now())";
        $res2 = mysql_query($insertquery);
	if(!$res2){
		echo 1;
	}
	else{
		echo 0;
	}
        
        mysql_close();
?>