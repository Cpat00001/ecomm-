<! DOCTYPE html>
<html>
<head>
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



</body>
</html>
