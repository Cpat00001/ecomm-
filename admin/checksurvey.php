<?php // checkshipping.php - this files check input and insert data into DB table shipping
//if clicked a button "Confirmation" then insert into DB table shipping all data collected form delivery and payment section
//connection with DB
session_start();
include'../includes/mysql.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- button -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="../css/style.eshop.css">
 <title>Feedback survey</title>
</head>
<body>  
<?php
include_once ('../css/eshop.header.php');
 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	if(isset($_POST['surveyfeed'])){
		
    	$range = tester_input($_POST['range']);
		$radio = tester_input($_POST['radio']);
		if(isset($_SESSION['email'])){ $email = $_SESSION['email'];}
		$email = $_SESSION['email'];
		//echo "RADIO RESULT</br>";
		//var_dump($radio);
		//var_dump($range);
		
		$sql_feedback = "INSERT INTO feedback(id,grade,comment,email,created_time)
		        VALUES('','$radio','$range','$email',NOW())";
        
        //for testing purpose errors message
		//var_dump($sql_feedback);
		$result = mysqli_query($dbc,$sql_feedback);
		//var_dump($result);
		
		echo "<div id='sur3'><p id='sur4'>Thank you. We have recived your feedback : </br>
				".$radio." and your suggestion : " .$range. "</p></div>";
		
	}// end of if($_POST['surveyfeed'])
				
}else{
		
		echo "We like to hear opinons from you";
		
}//// end of if($_SERVER["REQUEST_METHOD"] == "POST")
	
	//function to sanitize commented already exist in eshop.header.php that file is includes to current file checksurvey.php
			//so this function can be called twice in the same file
			function tester_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
	
    }// end of function test_input($data)
		
?>
<div class="col-md-12" id="surbut">
      <a href="http://localhost/ecomm/includes/eshop.php" class="btn btn-success btn-lg" id="but2" role="button"style="color:white";>Shopping</a>
   </div>
   </br></br>
<div class="col-md-12" id="surbut">
      <a href="http://localhost/ecomm/includes/home.php" class="btn btn-info btn-lg" id="but2" role="button"style="color:white";>Logout</a>
</div>
<?php
include '../css/eshop.footer.html';
?>
</body>
</html>