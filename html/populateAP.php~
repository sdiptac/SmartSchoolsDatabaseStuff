<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $ssid = $_REQUEST['ssid'];
        $bssid = $_REQUEST['bssid'];
        $room = $_REQUEST['room'];
        $building = $_REQUEST['building'];
        $org = $_REQUEST['org'];
	$apnumber = $_REQUEST['apnumber'];
        $insertquery = "insert into accesspoint values ('$ssid','$bssid','$room','$building','$org','$apnumber')";
        $res = mysql_query($insertquery);
        if(!$res){
                echo 1;
        }
        else{
                echo 0;
        }

        mysql_close();
?>