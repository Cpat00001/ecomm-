<?php
  $lifetime=3600;
  session_start();
  setcookie(session_name(),session_id(),time()+$lifetime);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="../css/style1.css">
 <title>Login checking</title>
</head>
<body>
<?php // files check if submited data in login section are correct
include 'mysql.inc.php';


$email3 = $pswd3 = "";
$emailErr = $emailErr2 = $pswd3Err = $notmatch ="";
$boolean = 0;

if ($_SERVER["REQUEST_METHOD"]=== 'POST'){
	
	//check if email valid format for login section
	if(empty($_POST['email3'])){
		$emailErr = 'Email is required to login</br>';
		//echo $emailErr;
		$boolean = 1;
	}else{
		$email3 = test_input($_POST['email3']);
		//check if email is well formated
		if(!filter_var($email3,FILTER_VALIDATE_EMAIL)){
			$emailErr2 = 'Invalid email format</br>';
			//echo $emailErr2;
			$boolean = 1;
       			
		}
	}
	//check if password valid for login section
	if(empty($_POST['pswd3'])){
		$pswd3Err = 'Password is required to login</br>';
		//echo $pswd3Err;
		$boolean = 1;
	}else{
		$pswd3 = test_input($_POST['pswd3']);
		
	}
	
}
if($boolean==0){
	$e = $_POST['email3'];
	$p = $_POST['pswd3'];
	$q = "SELECT id,email,pass,username FROM users WHERE email = '$e' AND pass= '$p'";
	$r = mysqli_query($dbc,$q);
	
	 if(mysqli_num_rows($r)===1){
		 
		 //set session values from $_POST inputs from form login
		 //$e = $_POST['email3'];
		 $p = $_POST['pswd3'];
		 $_SESSION['username'] = $e;
		 $_SESSION['password'] = $p;
		 //$_SESSION['user'] = $us;
		 $date = date('H:i:s');
         $_SESSION['time'] = $date;
		 $fn = $_SESSION['first_name'];
		 //$_SESSION['email3'] = $email;
         		 
		 
		 echo "Success you are login in";
		 // if logined successfully then attach the tracker.php file, to grap data about login user
		 include 'tracker.php';
		 
		 //select username from DB and assign to $_SESSION
		 while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
			 echo $row['username'];
			 $us = $row['username'];
			 $_SESSION['user'] = $us;
             echo $row["first_name"];
			 $fname = $row["first_name"];
			 $_SESSION['xxx'] = $fname;
             echo $row['email'];
			 $email = $row['email'];
			 $_SESSION['email']= $email;
			 echo $row['id'];
			 $user_session_id = $row['id'];
			 $_SESSION['user_session_id'] = $user_session_id;
		 }
		 //include file hobbycookie.php code does all job. if user login in then check user email and compare with hobby from DB
		 include'hobbycookie.php';
		 
		 $_SESSION['xxx'] = $fname;
		 header('Location:http://localhost/ecomm/includes/eshop.php');
		 
	 }else{
		 $notmatch = "Submited email or password doesn't match";
		 //echo "Submited email or password doesnt match";
	 }
	  
}

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div class="alert alert-primary" role="alert" id="jumbo1">
</br>
<?php
echo $emailErr;
echo $emailErr2;
echo $pswd3Err;
echo $notmatch;
?>
</br>
<b>Click button below to try again</b></br></br>
<a href="http://localhost/ecomm/includes/home.php"  class="btn btn-primary btn-lg active" role="button" aria-pressed="true"> Try again </a> 
</div>



</body>
</html>