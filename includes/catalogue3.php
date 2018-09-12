<?php
session_start();
?>
<! DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body>
<?php
include'../includes/mysql.inc.php';
include'../css/eshop.header.php';
//include tracker2.php for stats how many times this website has been viewed. data goes into table tracker2
include 'tracker2.php';
?> 
<h4> Choose from among the best videogames</h4>
<div class="col-md-6" id="catdiv1">
<h3>you have choosen a catalogue 3. VideoGames</h3>

<?php

//select from products db 
$sql = "SELECT name,id,image,description,price,stock,type,category FROM products WHERE type = 'game'";
$result = mysqli_query($dbc,$sql);

if(mysqli_num_rows($result)>0){
	
	//output data each row
	while($row = mysqli_fetch_assoc($result)){
		
		echo '<li id="item-list">';
		echo '<h4>Name: '.$row['name'].'</h4>';
		echo '<p> This is catalogue-product nr: '.$row['id'].'</p>';
		echo '<img src="'.$row['image'].'" width="60%" height="350px"/>'; //PRAWIDLOWY KOD DO IMAGE DISPLAY
		echo '<p>Category: '.$row['category']. '</p>';
		echo  '<p></br>Description: </p>'.$row['description'].'</br>';
		
		//more info button, after clicking send user to product.php with more info about product
		echo '<form method="POST" action="../products/product.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
		//echo '<a href="#"><button type="button" class="btn btn-info" id="catbutton2">More info</button></a>';
		
		
		//line of code with rest of info about product: price,how many available
		echo '</br></br><strong>Price: £ '.$row['price'].'</strong></br><strong>Stock: '.$row['stock'].'</strong></br></br>';
		
		//create a form to send data to WHISH_LIST.php after pressing button "Add to WishList."
		echo '<form method="POST" action="../php/wishlist.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="hidden" name="product_category" value="'.$row['category'].'">
			  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
		
		// create o from with input hidden to send data to CART.php after press "Add to bakset button" 
		echo '<form method="POST" action="../php/cart.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="hidden" name="product_category" value="'.$row['category'].'">
			  <input type="hidden" name="product_price" value="'.$row['price'].'">
			  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
			  
		echo '</li>';
		
	} // while($row = mysqli_fetch_assoc($result))
	echo '</li>';
	
 }else{
		echo "0 results,sorry";
} // if(mysqli_num_rows($result)>0)

?>
</div>
<?php
//inserted here PHP code which is second and execution part of cycle insert USER after clicking button "MOST WANTED"
//1st part on site eshop.body.php user click button with onclick fired function set cookie
//2nd part which is executed on this page and others with category(can be dynamically changed) 
//does PHP get value from COOKIE and insert it to DB ctr1 - as long as cookie is active = 5sec.

//$email = $_SESSION['email'];
//echo "result email z session";
//var_dump($email);
//echo "result from COOKIE</br>";
//var_dump($_COOKIE["ctr1"]);

//tutaj musi byc warunek. jesli $x ma wartosc wpisz do tabeli, jesli nie ma wpisz wartosc "empty"
if(isset( $_COOKIE['ctr1']) != ""){
//insert this value into BD table CTR1
$sql_insertCTR = "INSERT INTO ctr1(id,event_occur,email,time)
                 VALUES('', '".$_COOKIE['ctr1']."','$email',NOW())";
//run query
$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
//var_dump($dbc);
//echo "result from z sgl_insert</br>";
//var_dump($result_sql_insertCTR);	

}// end of if($x != "")
?>
<?php
// code below check if cookie was set in previous product.php page - if comments were displayed,then insert into DB table record.
//check if cookie exists if yes - is not equal to empty/0 do job in function - insert data t octr1 table DB
if(isset( $_COOKIE['mo']) != ""){
//insert this value into BD table CTR1
$sql_insertCTR = "INSERT INTO mo_comment(id,event_occur,email,time)
                 VALUES('', '".$_COOKIE['mo']."','$email',NOW())";
//run query
$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
//var_dump($dbc);
//echo "result from z sgl_insert</br>";
//var_dump($result_sql_insertCTR);	

}// end of if if(isset( $_COOKIE['mo']) != "")
?>
<?php
        //##################  wklejam tu code do linie ########## koniec kodu
	    if(isset($_COOKIE['mo2'])){$product_id = $_COOKIE['mo2']; }
		//$product_id = $_COOKIE['mo2'];
		//echo "WARTOSC PRODUCT ID z COOKIE mo2</br>";
		//var_dump($product_id);
		// code below check if cookie was set in previous product.php page - if comments were displayed,then insert into DB table record.
		//check if cookie exists if yes - is not equal to empty/0 do job in function - insert data t octr1 table DB
		if(isset( $_COOKIE['mo']) != ""){
		//take form this site aboe value of product_id line53 , below button name="moreinfo
        $product_id = $_COOKIE['mo2'];
		//insert this value into BD table CTR1
		$sql_insertCTR = "INSERT INTO mo_comment(id,event_occur,email,product_id,time)	
						 VALUES('', '".$_COOKIE['mo']."','$email',$product_id,NOW())";
		//run query
		$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
		//var_dump($dbc);
		//echo "result from z sgl_insert</br>";
		//var_dump($result_sql_insertCTR);	

		}// end of if(isset( $_COOKIE['mo']) != "")
		
	// ################### koniec przeklejonego kodu	

?>
<?php
include'../css/eshop.footer.html';
?>
</body>
</html>