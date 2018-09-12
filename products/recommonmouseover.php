<?php //recommonmouseover.php
//include'../includes/mysql.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- button -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="../css/style.eshop.css">
 <title>eMediaShop Product</title>
</head>
<body>
<?php
// this code executed recommendation bases onmouseover JavaScript event caputerd in document.cookie mo2., created in file product.php
if(isset($_COOKIE['mo2'])){
	
	$product = $_COOKIE['mo2'];
	
	//search for product's category where product_id = $product, 
	//where $product = $_COOKIE['mo2'] set by document.cookie = "mo2= php echo $id;
	//in file product.php

    $sql_product = "SELECT category 
	                FROM products
					WHERE id = '$product'";
   
    //run query
    $result_sql_product = mysqli_query($dbc,$sql_product);
    
   if(mysqli_num_rows($result_sql_product) > 0){
	   
	   while($row = mysqli_fetch_assoc($result_sql_product)){ 
	   
	    //echo $row['category'];
		
		//assign result to variable. should be only one category as product belongs to only 1 category
		$product_category = $row['category'];
		//echo "RESULT FROM sql_product category</br>"; 
		//var_dump($product_category);
		
		//if you know the category of the product which user mouseover,you can find other products from the same category
		// and try to recommend if user is already interested this category
		//BUT EXLUDING product , which user already has just seen variable: Sproduct 
		
		$sql_other = "SELECT id,category,name,image
						 FROM products
						 WHERE category = '$product_category'
						 AND id <> '$product'";
		//run query
		$result_sql_other = mysqli_query($dbc,$sql_other);
		
		  if(mysqli_num_rows($result_sql_other) > 0){ 
		    
		    while($row = mysqli_fetch_assoc($result_sql_other)){
				
				
				echo "<div class='col-md-3'>";
				echo "<div id='recom2'>";
				echo "<p>recommendations bases onmouseover.event</p>";
				echo "<p> product category: ".$row['category']."</p";
				echo "</br><p style='color:orange'><strong> product name: ".$row['name']. "</strong></p>";
				echo "</div>";
				
				echo '<img src="'.$row['image'].'" width="100%" height="220px"/>';
				
				echo "
	                   </div> ";

			//if you have others products from the category,you can recommend user with hight probability that will like,
			//because already checking comments about this product_category	
			
				
			}//end of  while($row = mysqli_fetch_assoc($result_sql_other))	
		  
		  }//end of if(mysqli_num_rows($result_sql_category) > 0)
		
	   
	   }// end of while($row = mysqli_fetch_assoc($result_sql_product))
	   
	   
   } // end of if(mysqli_num_rows($result_sql_product) > 0)	
	
}// end of if(isset($_COOKIE['mo2']))

?>

</body>
</html>