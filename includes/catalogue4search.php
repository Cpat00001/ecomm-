<?php
session_start();
if(isset($_POST['search'])){
	setcookie('search1',$_POST['search'],time()+3600,'/');
}
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
?> 
<!-- selection according to user input in search field-->

<h4>Enjoy your E-shopping.</h4>
<div class="col-sm-6" id="catdiv1">
<h4>Below we have prepered a list of products you are looking for...</h4>

<?php
//$test= $_SESSION['search'];
if($_SERVER['REQUEST_METHOD']=='POST'){

  //echo value of search field :" name="tester"
  echo "<h3 id='text'>Result of search word: " .$search."</h3>";
   //display a list of products equal to input wordwrap
   $input = $_POST['search'];
   
   //include a file with a code to insert search word to BD table
	include 'searchword.php';
   
   //search in DB all products related to travel searchword
   // after added a few categories would be better SWITCH code than if,elseif,else.
   if($input === 'travel'){
	   echo "<h4 id='text'>All our products related to ".$input."...</h4>";
	    $sql = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'travel'";
            $result = mysqli_query($dbc,$sql);
			
			
			if(mysqli_num_rows($result)>0){
			    //output each row with a product
                while($row = mysqli_fetch_assoc($result)){
				   
				    echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
					
			    } // end of  while($row = mysqli_fetch_assoc($result))			
			
			} //if(mysqli_num_rows($result)>0) 
			
	}elseif($input=== 'action'){//search in DB all products related to ACTION searchword
	
            //if($input === 'action')
			   echo "<h4 id='text'>All our products related to ".$input."...</h4>";
				$sql = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'action'";
					$result = mysqli_query($dbc,$sql);
					
			
			if(mysqli_num_rows($result)>0){
			    //output each row with a product
                while($row = mysqli_fetch_assoc($result)){
				   
				    echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
			    } // end of while($row = mysqli_fetch_assoc($result))			
			
			} // end of if(mysqli_num_rows($result)>0)
	
	
    }elseif($input==='science-fiction'){//search in DB all products related to SCIENCE-FICTION searchword
	
			//if($input === 'action')
			   echo "<h4 id='text'>All our products related to ".$input."...</h4>";
				$sql = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'science-fiction'";
					$result = mysqli_query($dbc,$sql);
					
			
			if(mysqli_num_rows($result)>0){
			    //output each row with a product
                while($row = mysqli_fetch_assoc($result)){
				   
				    echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p></br>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
			    } // end of  while($row = mysqli_fetch_assoc($result))			
			
			} // end of if(mysqli_num_rows($result)>0)
	
	}elseif($input==='technology'){
		
		//if($input==='technology')
			echo "<h4 id='text'>All our products related to ".$input."...</h4>";
		    $sql_tech = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'technology'";
			//run query
			$result_tech = mysqli_query($dbc,$sql_tech);
			
			if(mysqli_num_rows($result_tech)>0){ 
			    
				//output each product from category === technology
				while($row = mysqli_fetch_assoc($result_tech)){

				  echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p></br>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
				
				
				
				}// end of while($row = mysqli_fetch_assoc($result_tech))
			
			}// end of if(mysqli_num_rows($result_tech)>0)
						
		
	}elseif($input==='western'){
		
		//if($input==='western')
			echo "<h4 id='text'>All our products related to ".$input."...</h4>";
		    $sql_western = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'western'";
			//run query
			$result_western = mysqli_query($dbc,$sql_western);
			
			if(mysqli_num_rows($result_western)>0){ 
			    
				//output each product from category === western
				while($row = mysqli_fetch_assoc($result_western)){

				  echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p></br>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
				
				
				
				}// end of while($row = mysqli_fetch_assoc($result_western))
			
			}// end of if(mysqli_num_rows($result_western)>0)
	
    }elseif($input==='history'){
		
		//if($input==='history')
			echo "<h4 id='text'>All our products related to ".$input."...</h4>";
		    $sql_history = "SELECT id,name,description,image,price,stock,type FROM products WHERE category = 'history'";
			//run query
			$result_history = mysqli_query($dbc,$sql_history);
			
			if(mysqli_num_rows($result_history)>0){ 
			    
				//output each product from category === history
				while($row = mysqli_fetch_assoc($result_history)){

				  echo '<li id="item-list">';
                    echo "<p>Name: ".$row['name']."</p>";				   
					echo 'Description: </br></br>'. $row['description'].'</br>';
					echo '</br><img src="'.$row['image'].'" width="60%" height="350px"/></br>';
					
					echo '</br>';
					echo '<form method="POST" action="../products/product.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
					
					echo '<p>Price: £ '.$row['price'].'</p><p>Stock: '.$row['stock'].'</p></br>';
					
					//create a form to send data to whish_list after pressing button "Add to WishList."
					echo '<form method="POST" action="../php/wishlist.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
					
					// create o from with input hidden to send data to cart.php after press "Add to bakset button" 
					echo '<form method="POST" action="../php/cart.php">
						  <input type="hidden" name="product_id" value="'.$row['id'].'">
						  <input type="hidden" name="product_type" value="'.$row['type'].'">
						  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
					
					
					echo '</li>';
				
				
				
				}// end of while($row = mysqli_fetch_assoc($result_history))
			
			}// end of if(mysqli_num_rows($result_history)>0)
	
    }else{
	   //display error message,
	   echo "<div id='errormess'>Sorry,we dont have this product.</br></br> Try to use words like: 
	         <p></br>travel,</br>technology,</br>action,</br>history,</br>western.</br>science-fiction,</br></p></div>";
	   echo "<p>We collect what our users search for,and we will try to have on stock this product next time for your convenience</p>";	 
   }
}else{
	echo "theres no value input field from form - eshop.header.php ";
}// end of if($_SERVER['REQUEST_METHOD']=='POST')	
?>
</div>

<?php
include'../css/eshop.footer.html';
?>
</body>
</html>