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
?> 
<h4> A selection of great books and comics, which you will love</h4>
<div class="col-md-6" id="catdiv1">
<h3> you have choosen a catalogue 1. Books and Comics</h3>

<?php

//select from products db 
$sql = "SELECT name,id,image,description,price,stock,type FROM products WHERE type = 'book'";
$result = mysqli_query($dbc,$sql);

if(mysqli_num_rows($result)>0){
	
	//output data each row
	while($row = mysqli_fetch_assoc($result)){
		
		//echo '<li id="item-list">';
		echo '<div id="catdiv2"><h4>Name: '.$row['name'].'</h4></div></br>';
		echo '<p> This is catalogue-product nr: '.$row['id'].'</p>';
		echo '<img src="'.$row['image'].'" width="60%" height="350px"/>'; //PRAWIDLOWY KOD DO IMAGE DISPLAY
		echo  '<p></br>Description: </p>'.$row['description'];
		echo '<a href="#"><button type="button" class="btn btn-info" id="catbutton2">More info</button></a>';
		echo '</br></br><strong>Price: £ '.$row['price'].'</strong></br><strong>Stock: '.$row['stock'].'</strong>';
		echo '<a href="#"><button type="button" class="btn btn-success" id="catbutton">Add to WishList</button></a></br>';
		
		
		echo '<form method="POST" action="../php/cart.php">
		      <input type="hidden" name="product_id[]" value="'.$row['id'].'">
			  <input type="hidden" name="product_type[]" value="'.$row['type'].'">
		      <input type="submit" value="Add to basket" class="btn btn-warning" name="catbutton3"></form>';
			  
		
		//echo '<a href="../php/cart.php"><button type="button" class="btn btn-warning" id="catbutton3">Add to basket</button></a>';
		//echo '</li>';
	}
	
   
 }else{
		echo "0 results,sorry";
}

//check if button clicked/form submitted
/*if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	if(isset($_POST['catbutton3'])){
		
		$id = (isset($_POST['id']));
		$type= $_POST['type'];
		print_r($id);
		var_dump($type);
		
		
		
		$sql2 = "INSERT INTO order_cart(id,user_session_id,product_type,product_id,quantity,data_created,user_email)
				VALUES('','1','$type','$id','1','NOW()','test@test.com')";
		
       	var_dump($sql2);	

        if(mysqli_query($dbc,$sql2)){
			
			echo "INSERTED";
		}else{
			
			echo "<h3>NOT INSERTED</h3>";
		}				
	}
	
}
*/

?>
</div>

<?php
include'../css/eshop.footer.html';
?>
</body>
</html>