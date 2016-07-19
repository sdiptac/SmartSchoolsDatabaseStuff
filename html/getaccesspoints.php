<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $bssid = $_REQUEST['bssid'];
  	$ssid = $_REQUEST['ssid'];
        
	$query = "select building, room, apnumber from accesspoint where bssid = '$bssid' and ssid = '$ssid'";
        
	$res = mysql_query($query);
        if(mysql_num_rows($res) == 0){
                echo 1;
        }else{
		$row = mysql_fetch_assoc($res);
		echo json_encode($row);
	}
	mysql_close();
?>