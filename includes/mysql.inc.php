<?php //mysql.inc.php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','Patryk123');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','ecommerce1');

//create DB connection

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$dbc){
	echo "Unable to connect to MySQL";
	echo "debugging errno". mysqli_connect_errno();
	echo "debugging error". mysqli_connect_error();
	exit;
}else{
	echo "Success - connected to MySQL</br>";
}

//set the character set
mysqli_set_charset($dbc,'utf8');



?>