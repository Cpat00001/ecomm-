<?php // checkshipping.php - this files check input and insert data into DB table shipping
//if clicked a button "Confirmation" then insert into DB table shipping all data collected form delivery and payment section
//connection with DB
session_start();

//session value from sales.php
if(isset($_SESSION['order_cart_id'])){
echo ($_SESSION['order_cart_id']);
$order_cart_id = $_SESSION['order_cart_id'];
var_dump($order_cart_id);


}

include'../includes/mysql.inc.php';
 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	if(isset($_POST['confirmation'])){
		
    	$email = test_input($_POST['email']);
		$country = test_input($_POST['country']);
		$city = test_input($_POST['city']);
		$postcode = test_input($_POST['postcode']);
		$street = test_input($_POST['street']);
		$house_number = test_input($_POST['house_number']);
		$delivery_time = test_input($_POST['delivery_time']);
		$payment_option = test_input($_POST['payment_option']);
		$card_number = test_input($_POST['card_number']);
		$order_cart_id = $_SESSION['order_cart_id'];
		$sort_code = test_input($_POST['sort_code']);
		
		$sql = "INSERT INTO shipping (id,email,country,city,postcode,street,house_number,delivery_time,payment_option,card_number,sort_code,order_cart_id,created_time)
		        VALUES('','$email','$country','$city','$postcode','$street','$house_number','$delivery_time','$payment_option','$card_number','$sort_code','$order_cart_id',NOW())";
        
        //for testing purpose errors message
		var_dump($sql);
		$result = mysqli_query($dbc,$sql);
		var_dump($result);
		
		include 'sales.php';
		
	    header('Location: http://localhost/ecomm/admin/shippingconfirmation.php');
	}
				
}
	
	function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
	
    }
?>