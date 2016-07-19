<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $email = $_REQUEST['email'];

        $query = "select fitbitID, accessToken from user where email = '".$email."' and fitbitID is not null and accessToken is not null";
        $doesFitbitExist = mysql_query($query);

        if(mysql_num_rows($doesFitbitExist) == 0){
               echo '7';
        }
        else{
               echo '0';
        }
        mysql_close();
?>