<?php // tracker4.php
// code measure what product_id was visited,when and by who
//session_start();

//set variables 
$product_name = $_SESSION['product_name'];
$accessTime = date("Y-m-d H:i:s");
$email = $_SESSION['email'];
$product_id = $_SESSION['product_id'];
$product_type = $_SESSION['product_type'];


//insert data to DB table tracker4
$sql_tracker4 = "INSERT INTO tracker4(id,product_id,product_name,product_type,access_time,email)
                 VALUES('','$product_id','$product_name','$product_type','$accessTime','$email')";
//run query
$result_sql_tracker4 = mysqli_query($dbc,$sql_tracker4);
//echo "check results by var_dump</br>";
//var_dump($accessTime);
//var_dump($email);
//echo "product_id</br> product_name";
//var_dump($product_id);
//var_dump($product_name);
//var_dump($dbc);
?>