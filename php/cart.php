<?php
if(isset($_POST['catbutton3'])){setcookie('cart',$_POST['product_id'],time()+3600,'/');}
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
	
	if(isset($_POST['catbutton3'])){
		
		$id = $_POST['product_id'];
		$idint = (int)$id;
		
		//product_type taken from form input type hidden name="product_type"
		$type = $_POST['product_type'];
		if(isset($_SESSION['email'])){$email = $_SESSION['email'];};
		$email = $_SESSION['email'];
		//echo "WYNIK z email</br>";
		var_dump($email);
		$category = $_POST['product_category'];
		//echo "RESULT of product_category</br>";
		//var_dump($category);
		$price = $_POST['product_price'];
		//var_dump($price);
	    
		//set user_session_id, assign this number to value from $_SESSION['user_session_id']
		$usid = $_SESSION['user_session_id'];
		
		
			if(isset($idint,$type)){
				//echo "TO JEST ID";
		        //var_dump($idint);
				//echo "PONIZEJ JEST WARTOSCproduct_type</br>";
				//var_dump($type);
				
			//insert into DB to table order_cart
			$sql2 = "INSERT INTO order_cart(id,user_session_id,product_type,product_id,quantity,data_created,user_email)
					VALUES('','$usid','$type','$idint','1',NOW(),'$email')";
			
			//var_dump($sql2);
			
            }			

			if(mysqli_query($dbc,$sql2)){
				
				//echo "INSERTED";
				//############################## 	CWBT  ########################################################################
                  //insert here SBrecommends.php file which select rows for recommendation bases on other choices
				// Customers who bought this item also bought
			//wklejam kod do //koniec gdzie }else{
				
				//search for SB who bought the same product_id as  current user is buying
				  $sql_emails = " SELECT user_email
								  FROM order_cart
								  WHERE product_id = '$idint' AND user_email <> '$email' ";
		
					//run a query
					$result_sql_email = mysqli_query($dbc,$sql_emails);
					//echo " WYNIK result_sql_email";
					//var_dump($result_sql_email);
					//var_dump($dbc);
					
					 if(mysqli_num_rows($result_sql_email)>0){
						 
						 while($row = mysqli_fetch_assoc($result_sql_email)){
						 
						 //returns list of users' email who bought the same product_id but without current user
                         //echo "WYNIK z petli WHILE Srow user_email </br>";						 
						 //echo  $row['user_email']. "</br>";
						 
						 //assign output to variable
						 $foundusers = $row['user_email'];
						 //echo "WYNIK Z $foundusers";
						 //var_dump($foundusers);
						    
							 //########################### select what had been bought by people who bought the same product_id as current user
							 $sql_ids = "SELECT product_id
							             FROM order_cart
										 WHERE user_email = '$foundusers'
										 AND product_id <> '$idint'"; // excluding product_id which user just selected,to avoid recommending the same
								
								//run query
								$result_sql_ids = mysqli_query($dbc,$sql_ids);
								//var_dump($sql_ids);
								//echo " WYNIK z Sresult_sql_ids </br>";
								//var_dump($result_sql_ids);
								
								  
								    if(mysqli_num_rows($result_sql_ids)>0){ 
									
									  while($row = mysqli_fetch_assoc($result_sql_ids)){
										  
										  //returns list of products' IDs who bought other users - which bought current user ID product as well
										 //echo " WYNIK z petli WHILE Srow user_IDs </br>";						 
										 //echo  $row['product_id']."</br>";
										 
										 //################# if you have product_IDs find their images and names
										 
										 //asign output value to variable and put into DB query
										 $productids = $row['product_id'];
										 //echo " WYNIKI SproductIDS </br> ";
										 
										   $sql_images = "SELECT name,image
														  FROM products
														  WHERE id = '$productids'";
											
											//run query
											$result_sql_images = mysqli_query($dbc,$sql_images);
											//echo "WYNIK sql_images";
											//var_dump($result_sql_images);
											
											  if(mysqli_num_rows($result_sql_images)>0){

                                                while($row = mysqli_fetch_assoc($result_sql_images)){
                                                    
                                                    //echo "WYNIK Z PETLI name,image </br>";
                                                    //echo $row['name']. " ".$row['image']."</p>"; 
													
													//assign output of loop while to variable and COOKIE
                                                        $final_name = $row['name'];
                                                        $final_image = $row['image'];
														//echo " WYNIK Z Sfinal_image i name </br>";
														//var_dump( $final_name);
														//var_dump($final_image);
														

                                                    //set COOKIE a gdyby wlozc $row['image'] do cookie??
                                                        setcookie("CWBT1",$final_name, time()+3600,'/' );
                                                        setcookie("CWBT2",$final_image, time()+3600,'/');														
												
												} // end of while($row = mysqli_fetch_assoc($result_sql_images))  											  
											  
											  }// end of if(mysqli_num_rows($result_sql_images)>0)
											
										  	  
									  } // end of  while($row = mysqli_fetch_assoc($result_sql_email))  
									
									
									} //end of if(mysqli_num_rows($result_sql_email)>0)
						 
						 } // end of while($row = mysqli_fetch_assoc($result_sql_email))
						 
					 } //end of if(mysqli_num_rows($result_sql_email)

		//############################################ KONIEC WKLEJONEGO KODU		
                               
				
			}else{
				
				echo "<h3>NOT INSERTED</h3>";
			}				
	}// end of isset ['catbutton3']
	
}// end of if request_method

?>

<div class="container">
	<div id="cartdiv1">
	  <h3>Your shopping cart.</h3>
	         <p>If you are decided to buy, please click button "BUY all this STOCK" to proceed.</p>
	    <div id="cartdiv3">
		  <h4>Shiping details</h4>
             <?php
if($_SERVER["REQUEST_METHOD"]=="POST"){			 
			 //check if button Ad to Basket was clicked if yes then select chosen product by user_session_id
			 if(isset($_POST['catbutton3'])){
			 //assign session to variable
             if(isset($_SESSION['user_session_id'])){			 
		     $usid = $_SESSION['user_session_id'];
			 //var_dump($usid);
			 
			 // select data  from table order_cart && product. then display as order_cart content into table for a user,to show what has been chosen	  
		    $q_cartcontent = "SELECT products.name,order_cart.product_id,order_cart.quantity,products.price
			                  FROM order_cart
							  INNER JOIN products ON products.id = order_cart.product_id
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
					echo '<form method="post" action="../php/cart.php">';
					echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
			        //echo '<input type="hidden" name="product_type" value="'.$row['type'].'">';
					echo '<input type="submit" value="Remove from cart" class="btn btn-info" name="deletebut"></button>';
					echo "</row></br>";
					echo '</form>';
					
				}// end of while($row = mysqli_fetch_array($result_q,MYSQLI_ASSOC)) 
					
				
				} // end of if(mysqli_num_rows($result_q)>0)
					
						
			    
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
							//echo $_SESSION['user_session_id'];
		                   $usid = $_SESSION['user_session_id'];
						}
						   $idremove = $_POST['product_id'];
							
							if(isset($usid,$idremove)){
								//var_dump($usid);
								//var_dump($idremove);
							//DELETE ITEM FROM CART. function is fired when user click "Remove from cart button"
							$delete = "DELETE FROM order_cart WHERE user_session_id = $usid AND product_id = $idremove";
							}
							
							$result_delete = mysqli_query($dbc,$delete);
					
							if(mysqli_query($dbc,$result_delete)){
								
								echo "<h3> 1 Item was removed from you cart</h3>";
							}
								// put into local scope value of $usid from SESSION
								$usid = $_SESSION['user_session_id'];
								//show rest of existing items in order_cart for this user_id
								$show = "SELECT products.name,order_cart.product_id,order_cart.quantity,products.price
			                             FROM order_cart
							             INNER JOIN products ON products.id = order_cart.product_id
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
										echo '<form method="post" action="../php/cart.php">';
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
		
<?php

//I copied code below from line 79 - 111(these number were actual before I pasted this code below)

if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['headerbutshoppingcart'])){
	 
	        $usid = $_SESSION['user_session_id'];
			 // select data  from table order_cart && product. then display as order_cart content into table for a user,to show what has been chosen	  
		    $q_cartcontent2 = "SELECT products.name,order_cart.product_id,order_cart.quantity,products.price
			                  FROM order_cart
							  INNER JOIN products ON products.id = order_cart.product_id
							  WHERE user_session_id = $usid";
			
			$result_q2 = mysqli_query($dbc,$q_cartcontent2);
			
			if(mysqli_num_rows($result_q2)>0){
				
				//output data row
				while($row = mysqli_fetch_array($result_q2,MYSQLI_ASSOC)){
					echo "<table class='table table-striped'  id='tablecart'>";
					echo "<thead>";
					echo "<tr><th scope='col'>Product.Title: </th><th scope='col'>Quantity: </th><th scope='col'>Price: </th></br>";
					echo "<tbody>";
					echo "<tr><td>".$row['name']."</td>Product_id : ".$row['product_id']."<td>" .$row['quantity']."</td><td> £: ".$row['price']."</td></br>" ;
					echo "</tbody></table>";
					echo "<row>";
                    ///button to remove from order_cart
					echo '<form method="post" action="../php/cart.php">';
					echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
					echo '<input type="submit" value="Remove from cart" class="btn btn-info" name="deletebut"></button>';
					echo "</row></br>";
					echo '</form>';
				}
			}else{//if theres no any items displa a message
			
			      echo "You have not chosen any item yet.</br>
				      We warmly encourage you to explore more our range of products.</br>
				      And choose the best for you.We know you will like it.</br>";
			
			}		
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