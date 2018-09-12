<?php
session_start([
    'cookie_lifetime' => 86400,
]);

?>
<! DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>eMediaShop mainpage</title>
	<link rel= "stylesheet" href="../css/style.eshop.css">
	
</head>
<body>
<?php
include '../css/eshop.header.php';
?>
<?php
// all these echo was moved to div element in eshop.body.php.echo values from session (user name from DB) a time of login from time()
//echo "<h4>you have loggined as: ".$_SESSION['user']."</h4>";
//echo "<p>You started your shopping at : " . $_SESSION['time']."</p>";
//echo "your email is: ".$_SESSION['email']."</p>";
//echo "your SESSION NR: ".$_SESSION['user_session_id']."</p>";

if(isset($_COOKIE['pswd3'])){
print "<p> Password z cookie poslany POSTEM: " .$_COOKIE['pswd3']."</p>";
}
	
if(isset($_SESSION['xxx'])){	
   echo "<p>you are :" .$_SESSION['xxx']."</p>";
}

?>
<?php
include '../css/eshop.body.php';
include '../css/eshop.footer.html';
?>
</body>
</html>