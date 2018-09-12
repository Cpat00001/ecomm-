<?php
include'../includes/mysql.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- button -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.eshop.css">

</head>
<body>
<a href="testonclick1.php"><img src="../images/mostwanted.jpg" alt="Most wanted category" id="image1" style="width:30%;height:200px";></a>
<script>
//function assigned to element "image1" which is image with link to the most viewed category
document.getElementById('image1').onclick = function(){
	
	//function set cookies and existing time for cookies only 1minut,which is necessary for proper collecting data.
	//every reload page would generate value of cookie
	function createCookie(name,value,minutes) {
    if (minutes) {
        var date = new Date();
        date.setTime(date.getTime()+(minutes*60*1000));
        var expires = "; expires="+date.toGMTString();
    } else {
        var expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}

createCookie("ctr1","clicked",1)
alert('klikniete');
}

</script>
<?php
//echo $most_viewed; 
//echo "value sent from JavaScript function to PHP</br>";
echo $_COOKIE['ctr1'];
$x = $_COOKIE['ctr1'];
var_dump($x);
//$email = $_SESSION['email'];
//echo "WYNIK email z session";
//var_dump($email);

//tutaj musi byc warunek. jesli $x ma wartosc wpisz do tabeli, jesli nie ma wpisz wartosc "empty"
if($x != ""){
//insert this value into BD table CTR1
$sql_insertCTR = "INSERT INTO ctr1(id,event_occur,email,time)
                 //VALUES('','$x','$email',NOW())";
//run query
$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
//var_dump($dbc);
}// end of if($x != "")

// usun cookie,zrobione przez JS.zamknie wtedy cykl wpisze do bazy i usunie ciasteczko 
//setcookie("ctr1", "", time() - 3600);
?>
</body>
</html>