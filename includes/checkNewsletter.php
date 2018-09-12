<?php //checkNewsletter.php
session_start();
include'../includes/mysql.inc.php';
//check if form was submited (what method was used)
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	//echo "WARTOSC Z JAVASCRIPT X <br/>";
	$display_letter = $_POST['display_letter'];
	//var_dump($display_letter); 
	//submited by user email in Newsletter form - can be fake or second which user uses.
	$email = test_input($_POST['NewsEmail']);
	//real user email used during login section.comes from loginCheck.php
	if(isset($_SESSION['email'])){ $realemail = $_SESSION['email'];};
	//echo "realemail wartosc nizej</br>";
	//var_dump($realemail);
	//type: book,movie,game
	$type = $_POST['NewsType'];
	
	//insert into DB table values from Newsletter form
	$sql_newsletter = "INSERT INTO newsletter(id,event_occur,email,realemail,type,time) 
	                   VALUES('','$display_letter','$email','$realemail','$type',NOW())";
	//var_dump($sql_newsletter);				   
					   
	//run query
	if($result_sql_newsletter = mysqli_query($dbc,$sql_newsletter)){
		//echo "inserted into table newsletter ";
	}else{
		
		echo "SORRY an ERROR has OCCURED not inserted into table newsletter";
	};
	//var_dump($dbc);
	
} // end of if ($_SERVER["REQUEST_METHOD"] == "POST")
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<! DOCTYPE html>
<html lang="en">
<head>
 <title>newsletter confirmation</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body>
<div class="container">
  <div class="row">   
   <div class="alert alert-success" role="alert" id="newsdiv1">
      <h4 class="alert-heading">Thank you. You have been signed up</h4>
	  <p> We will send you an email with our latest news,offers,events and deals.</p></br>
	  <p> Your contact emial for a newsletter is...<strong><?php echo $_POST['NewsEmail']; ?></strong></p>
	  <p> We have noticed,that you ticked <strong><?php echo $_POST['NewsType']; ?></strong></p></br>
	  <p> We will send you materials related to your choice, you are most interested in</p></br>
	  <h4><strong>Thank you</strong></h4>
   </div>
   <div class="col-md-12" id="newsdiv2">
      <a href="http://localhost/ecomm/includes/home.php" class="btn btn-info btn-lg" id="but2" role="button"style="color:white";>Logout</a>
   </div>
  </div>   
</div>

</body>
</html>

