<?php// comments.php
//scenario : SB only sent comment 
//insert a COMMENT if anybody write something about product. if type STH insert values
//inser user_email,product_id,comment,date_inserted. field grade should be blank
$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);


include '../includes/mysql.inc.php';
//check if form was submited and icheck if POST method was used - POST
if($_SERVER['REQUEST_METHOD']==='POST'){  
  //check if button  was clicked
				  if(isset($_POST['comment']) && ($_POST['product_id'])){
					  
					  //comment value comes from FORM sent in file product.php
					  $comment = test_input($_POST['comment']);
					  var_dump($comment);
					  //product_id from hidden value of form from product.php
		              $product_id = $_POST['product_id'];
					  var_dump($product_id);
					  //user email from loginCheck.php sent by session
					  if(isset($_SESSION['email'])){
					  $email = $_SESSION['email'];
					  var_dump($email);
					  
					  // use REPLACE INTO  to be able to overwrite new user opinion AND NOT TO MULTIPLY the same USER
					  $sql_comment = "REPLACE INTO comment(user_email,product_id,comment)
		                 VALUES('$email','$product_id','$comment')";
						 
						 //execute a query
							$result_sql_comment = mysqli_query($dbc,$sql_comment);
							var_dump($result_sql_comment);
							var_dump($dbc);
							echo "<h4>THANKS FOR YOUR COMMENT</h4>";
							
					  }// end of if(isset($_SESSION['email']))		
					  
					  
				  }// end of if(isset($_POST['comment'])

}//end og $_SERVER['REQUEST_METHOD']

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>