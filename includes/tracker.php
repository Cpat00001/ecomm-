<?php 
session_start();
//tracker bases on HTTP_Header available in PHP $_SERVER
//tracker.php file retrives from remote user's data during communication webbrowser - server and saves in a DB data about visitor
      // the file will be added to registration new users: checkRegistration.php and login : loginCheck.php

    // assign $_SERVER HTTP to variable
	$page_name = $_SERVER['SCRIPT_NAME'];
	$accessTime = date("Y-m-d H:i:s");
	$server_addr = $_SERVER['REMOTE_ADDR'];
	$server_software = $_SERVER['SERVER_SOFTWARE'];
	$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$referer = $_SERVER['REMOTE_REFERER']; //informs about website a users come from. 
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$email = $_SESSION['email'];
	
	
	// insert variables into DB table tracker
	$sql1 = "INSERT INTO tracker(id,page_name,access_time,server_addr,server_software,http_accept_language,http_referer,http_user_agent,email)
			  VALUES('','$page_name','$accessTime','$server_addr','$server_software','$language','$referer','$agent','$email')";
	
	// run the query $sql1
	$insert = mysqli_query($dbc,$sql1);
	
	if($insert){
		//if inserted print success message
		echo "<h2> SUCCESS inserted into TRACKER</h2>";
		
	}else{
		//if not inserted print error message
		echo "<h2>ERROR: NOT INSERTED into TRACKER</h2>";
		var_dump($insert);
	}
	

?>
