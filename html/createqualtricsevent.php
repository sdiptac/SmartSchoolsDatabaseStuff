<?php
        $config = parse_ini_file('../config.ini');
        $link = mysqli_connect($config['endpoint'],$config['username'],$config['password'],$config['dbname']);

        $email = $_REQUEST['email'];
        $query = "select userID from user where email = '$email'";
        $res = mysqli_query($link,$query);
        if(mysqli_num_rows($res) == 0){
                echo 4;
                mysqli_close($link);
                return;
        }
	
        $userid = mysqli_fetch_row($res)[0];
	
	$eventstoexpire = "select eventid from user_event where userid = '$userid'";
	$res = mysqli_query($link,$eventstoexpire);
	while ($row = mysqli_fetch_assoc($res)) {

                $info[] = $row;
        }
	foreach ($info as $eventid){
		$eventid = $eventid["eventid"];
		$expirequery = "update event set isExpired = 't' where eventid = '$eventid'";
		if(mysqli_query($link, $expirequery)) {
			do{
				if($res3 = mysqli_store_result($link)) {
					 mysqli_free_result($res3);
				}
			} while(mysqli_more_results($link) && mysqli_next_result($link));
		}
	}
	unset($eventid); 	

	$query = "select questionid from questions where groupid = 1";
	$res = mysqli_query($link,$query);
        while ($row = mysqli_fetch_assoc($res)) {

                $info[] = $row;
        }
	
	$good = 0;
	$currentTime = date('Y-m-d H:i:s');

	foreach ($info as $questionid) {
		$questionid = $questionid["questionid"];
		$insertquery = "lock tables event write,user_event write, questions_event write,event as event1 read; 
	   		     insert into event(timeOfEvent,typeOfEvent,isExpired) values ('$currentTime','qualtrics','f'); 
			     insert into questions_event values ('$questionid',LAST_INSERT_ID()); 
			     insert into user_event values('$userid',LAST_INSERT_ID());
			     unlock tables;";
		
		if (mysqli_multi_query($link, $insertquery)) {
		   do {
			if ($res2 = mysqli_store_result($link)) {
            	      	       mysqli_free_result($res2);
        	      }

    		   } while (mysqli_more_results($link) && mysqli_next_result($link));
		}
	}
	unset($questionid);
	echo $good;
        mysqli_close($link);
?>