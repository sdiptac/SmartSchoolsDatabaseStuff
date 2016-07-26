<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);
	
	$int = $_REQUEST['int'];
        $query = "select * from questions_time_number";
        $res = mysql_query($query);
	$info = array();
        while ($row = mysql_fetch_assoc($res)) {
                $info[] = $row;
        }
        echo json_encode($info);
        mysql_close();
?>