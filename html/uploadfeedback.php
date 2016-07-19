<?php
        $config = parse_ini_file('../config.ini');
        $link = mysqli_connect($config['endpoint'],$config['username'],$config['password'],$config['dbname']);

        $email = $_REQUEST['email'];
        $eventid = $_REQUEST['eventid'];
        $questionid = $_REQUEST['questionid'];
	$response = $_REQUEST['response'];
        $query = "select userID from user where email = '$email'";
        $res = mysqli_query($link,$query);
        if(mysqli_num_rows($res) == 0){
                echo 4;
                mysqli_close($link);
                return;
        }
        $userid = mysqli_fetch_row($res)[0];
	$insertquery = "lock tables feedback write,feedback_event write, questions_feedback write,feedback as feedback1 read; insert into feedback(userID,response) values ('$userid','$response'); insert into feedback_event values (LAST_INSERT_ID(),'$eventid'); insert into questions_feedback values('$questionid',LAST_INSERT_ID());unlock tables;";

        $res2 = mysqli_multi_query($link,$insertquery);
        if(!$res2){
                echo 1;
        }
        else{
                echo 0;
        }

        mysqli_close($link);
?>