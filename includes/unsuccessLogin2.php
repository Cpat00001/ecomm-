<!DOCTYPE html>
<head>

</head>
<body>
<div class="jumbotron" id="jumbo1">
<?php // checkRegistration.php
echo "<b>Sorry , you havent been registered.</b></br></br>";
echo $userErr. "</br>";
echo $userErr2."</br>";
echo $emailErr."</br>";
echo $emailErr2. "</br>";
echo $pswdErr . "</br>";
echo $pswd2Err. "</br>";
echo $fnameErr. "</br>"; 
echo $fnameErr2."</br>";
echo $lnameErr. "</br>";
echo $lnameErr2."</br>";
echo $bioErr."</br></br>";
echo $message. "</br>";
echo "<b>Click a button 'Return' to fill in a form properly and register. Thank you</b></br></br>";
?>
<a href="http://localhost/ecomm/includes/home.php" class="btn btn-primary btn-lg active" role="button"  aria-pressed="true"> Return </a>
</br></br>
</div>
</body>
</html>