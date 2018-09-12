<?php
$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);
  
if(isset($_POST['search'])){
	setcookie('search1',$_POST['search'],time()+3600,'/');
}

 
?>
<?php //check if search button was clicked
if(isset($_POST['search'])){
	
 //assign words submitted in search form field to variable
  $_POST['search'] = $words;
  var_dump($words);
 
 //assign SESSION to $email 
 $_SESSION['email']= $email;
 var_dump($email); 

 //execute query to DB
 $sql_search = "INSERT INTO searchword(id,user_email,words,data_created)
                VALUES('','$email','$words',NOW())";

	//run the query against DB
	$result_sql = mysqli_query($dbc,$sql_search);
	var_dump($result_sql);
	var_dump($dbc);
	
	echo "SILENCE";

}


?>

