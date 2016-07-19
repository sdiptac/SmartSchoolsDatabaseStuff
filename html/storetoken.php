<?php
        $config = parse_ini_file('../config.ini');
        $link = mysqli_connect($config['endpoint'],$config['username'],$config['password'],$config['dbname']);

        $email = $_REQUEST['email'];
        $accesstoken = $_REQUEST['accesstoken'];
        $fitbitid = $_REQUEST['fitbitid'];

      

	$query = "update user set accesstoken='$accesstoken', fitbitid='$fitbitid' where email='$email'";
        $result = mysqli_query($link,$query);
        if(!$result){
                echo "#databaseError, Database Error";
                mysqli_close($link);
                return;
        }
	
        $query = "select userid from user where email = '$email'";
        $result = mysqli_query($link,$query);
	if(!$result){
		echo "#databaseError, Database Error";
                mysqli_close($link);
                return;
	}

	$userid = mysqli_fetch_row($result)[0];
	
	$query = "select * from device natural join user_device where userid = '$userid' and typeOfDevice = 'fitbit'";
	$result = mysqli_query($link,$query);
	if(mysqli_num_rows($result) == 0){

       		$query = "insert into device(typeOfDevice) values ('fitbit'); 
		insert into user_device(userID,deviceID) values ('$userid',LAST_INSERT_ID()); 
		insert into fitbit values(LAST_INSERT_ID())";

        	$result = mysqli_multi_query($link,$query);
		if(!$result){
			echo "#databaseError, Database Error";
                	mysqli_close($link);
                	return;
        	}
	}
        echo "good";

        mysqli_close($link);
?>
