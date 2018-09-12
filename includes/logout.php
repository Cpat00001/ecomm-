<?php //logout.php

session_start();
include'../includes/mysql.inc.php';
//check if form was submited (what method was used)
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(isset($_POST['but1'])){
	//real user email used during login section.comes from loginCheck.php
	if(isset($_SESSION['email'])){ $realemail = $_SESSION['email'];};
	//insert into database empty record = means user refuses to sign up for newsletter
	$sql_newsletter_empty = "INSERT INTO newsletter(id,event_occur,email,realemail,type,time)
							VALUES('','1','','$realemail','',NOW())";
							
	//run a query
	$result_sql_newsletter_empty = mysqli_query($dbc,$sql_newsletter_empty);
	echo "WYNIKI Z PUSTEGO WSADU...</br>";
	var_dump($result_sql_newsletter_empty);
	var_dump($dbc);
	
	header('Location: http://localhost/ecomm/includes/home.php');
    exit;
    } //end of if(isset($_POST['but1']))
	

} //end of if($_SERVER["REQUEST_METHOD"] == "POST")	


?>