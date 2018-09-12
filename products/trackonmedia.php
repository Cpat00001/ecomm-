<?php // tracksharedonmedia.php
//If you have a user email and product_id  shared on socialmedia then find this product category
//If you have product category, then check others product (excluding shared products ) fro mthis category.
//Assign to variable
//Then compare result with table sales where product_id is not as product_id from social media
//If you have result list of products then display them users as recommendation.

//these two files included not recquired as long as trackonmedia.php - current file is attached to product.php
//include'../includes/mysql.inc.php';
//session_start();
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
//select product_id,product_type from table socialmedia for a login user to display him/her new recommendations
//select user email from SESSION loginCheck.php
$email = $_SESSION['email'];

$sql_social = "SELECT product_id,product_category
               FROM socialmedia
			   WHERE user_email = '$email'
			   AND product_id <> '0'
			   ORDER BY product_id";
//run querry
$result_sql_social = mysqli_query($dbc,$sql_social);

if(mysqli_num_rows($result_sql_social)>0){
	
	//output data each row
	while($row = mysqli_fetch_assoc($result_sql_social)){ 
	
	  echo "product_id : ".$row['product_id']." product_category: ".$row['product_category']."</br>";
	  
	  //assign result to variable
	  $productmedia = $row['product_id'];
	  $categorymedia = $row['product_category'];
	  //echo "RESULT FROM productmedia</br>";
	  //var_dump($productmedia);
	  //var_dump($categorymedia);
	  
	  //if you have products_ids and categories check categories 
	  $sql_category = "SELECT id,name,category,image
	                   FROM products
					   WHERE id <> '$productmedia'
					   AND category = '$categorymedia'
					   LIMIT 3";
		
		
		 //run query
		 $result_sql_category = mysqli_query($dbc,$sql_category);	 
		//echo "RESULT FROM sql_category";
		//print_r($result_sql_category);
		
        if(mysqli_num_rows($result_sql_category)>0){ 
		
		  while($row = mysqli_fetch_assoc($result_sql_category)){

            echo "<div class='col-md-3'>";
				echo "<div id='recom1'>";
				echo "<p>recommendations click.event shared on socialmedia</p>";
				echo "<p> product category: ".$row['category']."</p";
				echo "</br><p style='color:orange'><strong> product name: ".$row['name']. "</strong></p>";
				echo "</div>";
				
				echo '<img src="'.$row['image'].'" width="100%" height="220px"/>';
				
				echo "
	                   </div> ";		  
		  
		    //echo "product_id : " .$row['id']. "</br> product_category: ".$row['category']. "</br>";
		  
		  //assign result to variables and you can display users products from category he has shared online, but different product_id
		  // than he published. effect is e-shop recommends others products from category which logined users shares on socialmedia
          //we can assume that if SB shares products on social media can be intersted and maybe consider to buy next on from the same category
          //probability not much but still exists.
          		  
		  
		  }//end of while($row = mysqli_fetch_assoc($result_sql_category)) 
		  
		
		}//end of if(mysqli_num_rows($result_sql_category)>0)		
	  
	
	}//end of while($row = mysqli_fetch_assoc($result_sql_social))
	
}//end of if(mysqli_num_rows($result_sql_social)>0)

?>

</body>
</html>