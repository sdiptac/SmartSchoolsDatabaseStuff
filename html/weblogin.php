<?php
   $EmailExistError = "Invalid Email";
   $IncorrectPasskeyError = "Incorrect Password";
   $config = parse_ini_file('../config.ini');
   mysql_connect($config['endpoint'],$config['username'],$config['password']);
   mysql_select_db($config['dbname']);
   $email = $_POST['email'];
   $passkey = $_POST['passkey'];
   $query = "select email,passkey from user where email = '$email'";
   $DoesEmailExist = mysql_query($query);
   if(mysql_num_rows($DoesEmailExist) == 0){
   				      echo "#emailError,Invalid Email";
   				      mysql_close();
   				      return;
   }
   else{
	$row = mysql_fetch_row($DoesEmailExist);
   	$hash_passkey = $row[1];

   	if(password_verify($passkey,$hash_passkey)){
		echo "good";
   	}
   	else {
   	     echo "#passwordError,Incorrect Password";
   	}

   mysql_close();
   return;
   }

?>