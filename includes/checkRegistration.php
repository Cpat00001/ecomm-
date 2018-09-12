<! DOCTYPE Html!>
<html lang="en">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style1.css">
<title>Check registration form </title>

</head>
<body>

<?php
include'mysql.inc.php';

//define variables and set to empty values
$userErr = $userErr2 = $emailErr = $emailErr2 = $pswdErr = $pswd2Err = $fnameErr = $fnameErr2 =  $lnameErr = $lnameErr2 = $bioErr = "";
$user = $email = $pswd = $pswd2 =$fname = $lname = $bio = $age = $hobby = $otherHobby = "";
$boolean = 0;
$message="";

//check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $userErr = "Username field is required";
	$boolean = 1;
  } else {
    $user = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$user)) {
      $userErr2 = "Only letters,numbers and white space allowed in USERNAME";
      $boolean = 1;	  
    }
  }
	//check an email input
	if(empty($_POST['email'])){
		$emailErr = "You forgot enter your email";
		$boolean = 1;
		//echo $emailErr. "</br>";
	}else{
		$email = test_input($_POST['email']);
		//check if email is well-formed
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailErr2 = "Invalid email format";
			$boolean = 1;
			//echo $emailErr2. "</br>";
		}
	}
	//check password 
	if(empty($_POST['pswd'])){
		$pswdErr = "You forgot to enter password";
		$boolean = 1;
		//echo $pswdErr . "</br>";
	}else{
		//check if pswd matches to pswd2
		if($_POST['pswd']!= $_POST['pswd2']){
			$pswd2Err = "Your password doesnt match to confirmed password";
			$boolean = 1;
			//echo $pswd2Err. "</br>";
		}else{
		$pswd = test_input($_POST['pswd']);
		}
	}
	// check validity of first name
	if(empty($_POST['fname'])){
		$fnameErr = "You forget to enter your first name";
		$boolean = 1;
		//echo $fnameErr. "</br>"; 
	}else{
		$fname = test_input($_POST['fname']);
		//check if input contains only letters and whitespaces
		if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
			$fnameErr2 = "Only letters and white spaces allowed FIRSTNAME";
			$boolean = 1;
			//echo $fnameErr2."</br>";
		}
	}
	if(empty($_POST['lname'])){
		$lnameErr = "You forget to enter your last name";
		$boolean = 1;
		//echo $lnameErr. "</br>"; 
	}else{
		$lname = test_input($_POST['lname']);
		//check if input contains only letters and whitespaces
		if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
			$lnameErr2 = "Only letters and white spaces allowed in LASTNAME";
			$boolean = 1;
			//echo $lnameErr2."</br>";
		}
	}
		
	if(empty($_POST['bio'])){
		$bioErr = "Gender is required";
		$boolean = 1;
		//echo $bioErr."</br>";
	}else{
		$bio = test_input($_POST['bio']);
	}
	//add new input fields from expanded registration form
	if(isset($_POST['age'])){
		
		$age = test_input($_POST['age']);
	}
	if(!empty($_POST['hobby'])){
		
		$hobby = test_input($_POST['hobby']);
		//include file with COOKIE,which remembers users' hobby and display related category products.
		//include'hobbycookie.php';
		
	}else{
		
		echo "";
	}
	if(!empty($_POST['otherHobby'])){
		$otherHobby = test_input($_POST['otherHobby']);
		//check if input contains only letters and whitespaces ++ colon,semicolon,dots
		if(!preg_match("/^[a-zA-Z ,;. ]*$/",$otherHobby)){
			$lnameErr2 = "Only letters and white spaces allowed in HOBBY FILED";
			$boolean = 1;
			//echo "NOT allowed in other hobby field"."</br>";
		}else{
			
			echo "";
		}
	}
	if(!empty($_POST['socialmedia'])){
		
		$socialmedia = test_input($_POST['socialmedia']);
	}
	     		
} // end of input fields to check in test_input

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<?php
 if($boolean==0){
	 $user = $_POST['username'];
	 $email = $_POST['email'];
	 $q = "SELECT * FROM users WHERE username = '$user' OR  email = '$email'";
	 $result = mysqli_query($dbc, $q);
     $rows = mysqli_num_rows($result);
      //printf to check how many rows are selected   	 
	 //printf("result has set: . $rows");
       if($rows==0){
		   $q2 = "INSERT INTO users (username,email,pass,first_name,last_name,bio,data_created,age,hobby,otherHobby,socialmedia) 
		          VALUES ('$user','$email','$pswd','$fname','$lname','$bio', NOW(),'$age','$hobby','$otherHobby','$socialmedia')";
		   $r2 = mysqli_query($dbc,$q2);
		     if($r2){
				 $message2 = "Thank you, You have been...";
				 //echo $message2;
				 include 'successLogin1.php';
				 //send an email to user as registration confirmation
				 $to = $_POST['email'];
				 $subject = 'registration confirmation';
				 $message3 = 'thank you for registration. your username is : $_POST["username"]';
                 $header = 'From: eMedia123.com';
                 mail ($to, $subject, $message3 , $header);				 
				 
			 }
	   }else{
		   $message = "Sorry the user already exists, try again.</br>";
		   //echo $message;
		   include 'unsuccess1.php';
	   }
       	  
 }else{
	 include 'unsuccessLogin2.php';
 }

?>
</body>
</html>