<?php
setcookie('name','Janek');
if(isset($_POST['kolor'])){
	setcookie('kolorowe', $_POST['kolor'],time()+3600,'/');
}

?>
<! DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="../css/customizedcolor.css">
<style>
body {
<?php 
if(isset($_COOKIE['kolorowe'])){	
   echo "background-color: #".($_COOKIE['kolorowe']).";\n";
}else{
	echo "background-color: brown;";
}  
?>
}
</style>
</head>
<body>
<p> here set a session 2</p>

<a href="http://localhost/ecomm/includes/home.php">GO SHOPPING</a>

<form action="session1.php" method="POST">
<select name="kolor">
<option value="9932CC"> kolor1 </option>
<option value="E30B5C"> kolor2 </option>
<option value="20B2AA"> kolor3 </option>
</select>
<input type="submit" name="wyslij" value="set my preferences"/>
</form>
</body>
</html>