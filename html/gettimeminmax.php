<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $query = "select * from questions_time_number";
        $res = mysql_query($query);
        while ($row = mysql_fetch_assoc($res)) {

                $info[] = $row;
        }
        echo json_encode($info);
        mysql_close();
?>