<?php
$lifetime=3600;
//session_start();
//setcookie(session_name(),session_id(),time()+$lifetime);
  
//if(isset($_POST['search'])){
	//setcookie('search1',$_POST['search'],time()+3600,'/');
//}

 
?>
<?php //check if search button was clicked
if(isset($_POST['search'])){
	
 //assign words submitted in search form field to variable
  $words = $_POST['search'];
  //var_dump($words);
 
 //assign SESSION to $email 
 //echo $_SESSION['email'];
 if(isset($_SESSION['email'])){$email = $_SESSION['email'];}
 //var_dump($email); 

 //execute query to DB
 $sql_search = "INSERT INTO searchword(id,user_email,words,data_created)
                VALUES('','$email','$words',NOW())";

	//run the query against DB
	$result_sql = mysqli_query($dbc,$sql_search);
	//var_dump($result_sql);
	
	//echo "VALUE INSERTED INTO table SEARCHWORD";
}else{
	
	echo "We try to provide this product next time.Thank you";
	
}


?>

