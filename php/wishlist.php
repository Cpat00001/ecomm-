<?php // wishlist2 na nowo bubuje wishlist na bazie cart.php,ktora poki co dziala
if(isset($_POST['catbutton3'])){
	setcookie('cart',$_POST['product_id'],time()+3600,'/');
}
session_start([
    'cookie_lifetime' => 86400,
]);

?>
<! DOCTYPE html>
<html>
<head>
  <title> Shopping card</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.cart.css">
</head>
<body>
<?php
include'../includes/mysql.inc.php';
include'../includes/eshop.cartheader.html';
?> 
<?php

//check if button in submit form was clicked
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	if(isset($_POST['addtowishlist'])){
		
		$id = $_POST['product_id'];
		$idint = (int)$id;
		
		//// product_type taken from form input type hidden name="product_type"
		$type = $_POST['product_type'];
		if(isset($_SESSION['email'])){ $email = $_SESSION['email'];
		var_dump($email);
		//set user_session_id, assign this number to value from SESSION['user_session_id']
		$usid = $_SESSION['user_session_id'];
		$category = $_POST['product_category'];
		echo "RESULT of product_category</br>";
		var_dump($category);
		
			if(isset($id,$type)){
				echo "</br>TO JEST ID";
		        var_dump($idint);
				var_dump($type);
				
			//insert into DB to table order_cart
			$sql2 = "INSERT INTO wish_list(id,user_session_id,product_type,product_id,quantity,data_created,user_email)
					VALUES('','$usid','$type','$idint','1',NOW(),'$email')";
			
			var_dump($sql2);
			
            }			

			if(mysqli_query($dbc,$sql2)){
				
				echo "INSERTED</br>";
				
			//wklejam tutaj nowy kod z new1.php jesli nei zadziala cos wytnij az do liniie }else{ bedzie koment 
			
			// PRODUCT_ID wybrany przez usera do wishlist
			$id = $_POST['product_id'];
			$idint = (int)$id;
			//echo "WARTOSC PRODUCT_ID</br>";
			//var_dump($idint);
			//product_type np 'book' wybrany przez usera. np lubi ksiazki podpowiedz mu ksiazke,ale drozsza		
			$type = $_POST['product_type'];
			//echo "WARTOSC PRODUCT_TYPE</br>";
			//var_dump($type);

			//zapytanie do DB wybor innych towarow z tego samego typu ale inne ID
            //echo "PONIZEJ JEST WYNIK z bazy danych</br>";
			$sql1 = "SELECT name,image FROM products 
			         WHERE category = '$category' AND id <> $idint 
			         LIMIT 2";
			//var_dump($sql1);

			//run a query
			$result_sql1 = mysqli_query($dbc,$sql1);
			//echo "WYNIK Z mysql connect</br>";
			//var_dump($dbc);

					//
					if(mysqli_num_rows($result_sql1) > 0){
													
										while($row = mysqli_fetch_assoc($result_sql1)){
											
											echo "{$row['image'] }";
											
											//assign output of loop to $variable and then $variable to COOKIE
											$cookie = $row['image'];
											//echo "WYNIK Z COOKIE</br>";
											//var_dump($cookie);
											
											setcookie("CROSS_SELL", $cookie,time()+3600,'/');
											
											
										}// end of while($row = mysqli_fetch_assoc($result_sql1))
					}//end of if(mysqli_num_rows($result_sql1)


            //koniec			
			}else{
				
				echo "<h3>NOT INSERTED</h3>";
			}
        
        }//end of if(isset($email = $_SESSION['email'])		
	}// end of isset ['catbutton3']
	
}// end of if request_method



?>
<div class="container">
	<div id="cartdiv1">
	  <h3>Your WishList.</h3><h4>Here are your products which you may would like to buy in near future. </h4>
	         <p>If you are decided to buy, please click button "BUY all this STOCK" to proceed.</p>
	    <div id="cartdiv3">
		  <h4>Shiping details</h4>
             <?php
if($_SERVER["REQUEST_METHOD"]=="POST"){			 
			 //check if button Ad to Basket was clicked if yes then select chosen product by user_session_id
			 if(isset($_POST['addtowishlist'])){
			 //assign session to variable
             if(isset($_SESSION['user_session_id'])){			 
		     $usid = $_SESSION['user_session_id'];
			 //var_dump($usid);
			 
			 // select data  from table order_cart && product. then display as order_cart content into table for a user,to show what has been chosen	  
		    $q_cartcontent = "SELECT products.name,wish_list.product_id,wish_list.quantity,products.price
			                  FROM wish_list
							  INNER JOIN products ON products.id = wish_list.product_id
							  WHERE user_session_id = $usid";
			
			$result_q = mysqli_query($dbc,$q_cartcontent);
			
			if(mysqli_num_rows($result_q)>0){
				
				//output data row
				while($row = mysqli_fetch_array($result_q,MYSQLI_ASSOC)){
					echo "<table class='table table-striped'  id='tablecart'>";
					echo "<thead>";
					//echo "Product: ". $row['name']. " Quantity: " .$row['quantity']. " Price: ".$row['price']. "</br>";
					echo "<tr><th scope='col'>Product.Title: </th><th scope='col'>Quantity: </th><th scope='col'>Price: </th></br>";
					echo "<tbody>";
					echo "<tr><td>".$row['name']."</td>Product_id : ".$row['product_id']."<td>" .$row['quantity']."</td><td> £: ".$row['price']."</td></br>" ;
					echo "</tbody></table>";
					echo "<row>";
					//cos jest zepsute w kodzie ponizej juz na poziomie guzika tak mysle sprawdz uwaznie.
					//po wcisnieciu guzika deletebut kasuje wszystkie pozycje
					// pamietaj zeby odblokowac linie z kodem //$sql2 = "INSERT INTO order_cart i linie ponizej VALUES 
					echo '<form method="post" action="../php/wishlist.php">';
					echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
			        //echo '<input type="hidden" name="product_type" value="'.$row['type'].'">';
					echo '<input type="submit" value="Remove from cart" class="btn btn-info" name="deletebut"></button>';
					echo "</row></br>";
					echo '</form>';
					
				}
					
				
				}
					
						
			    
			}else{
					//display message that at the moment there is any items in a basket
				//echo "You have not chosen any item yet.</br>
				      //We warmly encourage you to explore more our range of products.</br>
				      //And choose the best for you.We know you will like it.</br>";
				
				
			}
			}// end if of isset($_SESSION[])
			}
			
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){			
		//przenioslem caly code z linie 107 - 112
		if(isset($_POST['deletebut'])){
							
							//set user_session_id, assign this number to value from $_SESSION['user_session_id']
						if(isset($_SESSION['user_session_id'])){
							echo $_SESSION['user_session_id'];
		                   $usid = $_SESSION['user_session_id'];
						}
						   $idremove = $_POST['product_id'];
							
							if(isset($usid,$idremove)){
								var_dump($usid);
								var_dump($idremove);
							//DELETE ITEM FROM CART. function is fired when user click "Remove from cart button"
							$delete = "DELETE FROM wish_list WHERE user_session_id = $usid AND product_id = $idremove";
							}
							
							$result_delete = mysqli_query($dbc,$delete);
					
							if(mysqli_query($dbc,$result_delete)){
								
								echo "<h3> 1 Item was removed from you cart</h3>";
							}
								// put into local scope value of $usid from SESSION
								$usid = $_SESSION['user_session_id'];
								//show rest of existing items in wish_list for this user_id
								$show = "SELECT products.name,wish_list.product_id,wish_list.quantity,products.price
			                             FROM wish_list
							             INNER JOIN products ON products.id = wish_list.product_id
							             WHERE user_session_id = $usid";
								
								//run query againt DB
								$result_show = mysqli_query($dbc,$show);
								 
                                     //display existing items in order_cart for user_session_id									
									 if(mysqli_num_rows($result_show)>0){
										 //output data row
				                        while($row = mysqli_fetch_array($result_show,MYSQLI_ASSOC)){
										 echo "<table class='table table-striped'  id='tablecart'>";
										echo "<thead>";
										//echo "Product: ". $row['name']. " Quantity: " .$row['quantity']. " Price: ".$row['price']. "</br>";
										echo "<tr><th scope='col'>Product.Title: </th><th scope='col'>Quantity: </th><th scope='col'>Price: </th></br>";
										echo "<tbody>";
										echo "<tr><td>".$row['name']."</td>Product_id : ".$row['product_id']."<td>" .$row['quantity']."</td><td> £: ".$row['price']."</td></br>" ;
										echo "</tbody></table>";
										
										///button to remove from order_cart
										echo '<form method="post" action="../php/wishlist.php">';
										echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
										echo '<input type="submit" value="Remove from cart" class="btn btn-info" name="deletebut"></button>';
										echo "</row></br>";
										echo '</form>';
										 
									 //header('Location: http://localhost/ecomm/php/cart.php');
				                        }   
								    }
								
								
							}else{
								echo "<h4>Please add any item to your basket to see your shopping list</h4>";
							}
					
}
		


?>
					
		</div>
      <row>	
		<a href="http://localhost/ecomm/admin/shippingform.php" class="btn btn-danger btn-lg" role="button">Buy all this stock</a>
	</row>
	</div>
	<div id="cartdiv2">
		<h4>Thanks for shopping. Free delivery for our customers</h4>
	</div>
</div>
<?php
include'../css/eshop.footer.html';
?>
</body>
</html>
