<?php // comment.php
// this file takes input fields from product.php
// sanitize input by test_input function
//insert data into DB table "product_rating"
// product rating has two input fields: rating 1-2 select option and textarea,user can leave own comment.
$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);


include'../includes/mysql.inc.php';

//check if form was submited and icheck if POST method was used - POST
if($_SERVER['REQUEST_METHOD']==='POST'){
	
	//check if button  was clicked
	if(isset($_POST['comment']) && ($_POST['product_id'])){
		
		//assign value to variables,which you will use in INSERT TABLE
		$comment = $_POST['comment'];
		var_dump($comment);
		//product_id from hidden value of form from product.php
		$product_id = $_POST['product_id'];
		var_dump($product_id);
		//product_type from hidden value of form from product.php
		$type = $_POST['product_type'];
		echo "ponizej product type</br>";
		var_dump($type);
		//user email from loginCheck.php sent by session
		if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		var_dump($email);
		//take username from eshop.body.php by session insert into DB comment table,display in everyproduct comment
		if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
			var_dump($user);
		
		  // scenario SB only click comment: insert into table email,product_id,comment,date
		  //use REPLACE INTO  to be able to overwrite new user opinion AND NOT TO MULTIPLY the same USER
		  $sql_rating = "REPLACE INTO comment(user_email,product_id,comment,user,product_type,date_created)
		                 VALUES('$email','$product_id','$comment','$user','$type',NOW())";
			
						 
			//execute a query
            $result_sql_rating = mysqli_query($dbc,$sql_rating);
            var_dump($result_sql_rating);
			var_dump($dbc);
            echo "<h4>THANKS FOR YOUR COMMENT</h4>";
			
	    }//end of if(isset($_SESSION['user']))
		}// end of if(isset($_SESSION['email']))
			
	}// end of isset($_POST['ratingproduct'])
	
}//end og $_SERVER['REQUEST_METHOD']


					  
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


header('Location: http://localhost/ecomm/products/product.php');


?>