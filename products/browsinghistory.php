<?php // browsinghistory.php
//code serach for user's browsing history and displays as a reminder what user was interested
// I will display this item in catalogue1/2/3 which let be quite dynamically typed/changed as reload page
session_start();
//included file below can be commented as long as its attached to other php file with own connection to DB 
include'../includes/mysql.inc.php';
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
// take user email from loginCheck.php
if(isset($_SESSION['email'])){
	
	 $email = $_SESSION['email'];
	 
	 //search for browsing history if you have user's email. to get product image you need to INNER JOIN with table products
	 // in query below I will get 4 lates views of pages made by user_email from SESSION
	 $sql_history = "SELECT DISTINCT tracker4.product_id,tracker4.product_name,products.category,products.image 
					FROM tracker4 
					INNER JOIN products ON tracker4.product_id = products.id 
					WHERE email = '$email' 
					ORDER BY access_time 
					DESC 
					LIMIT 4";
	 //run query
	 $result_sql_history =mysqli_query($dbc,$sql_history);
	 
	 if(mysqli_num_rows($result_sql_history)> 0){
	 
	    while($row = mysqli_fetch_assoc($result_sql_history)){
			
				//echo "<p> product id: ".$row['product_id']."</p";
                //echo "<p> product category ".$row['category']."</br>";
            
			//assign results to varibales
			$product_id = $row['product_id'];
			$category = $row['category'];
			//echo "product_id i KATEGORIA WYNIKI</br>";
			//echo($product_id);
			
			//$yy = explode(',',$category);
			//var_dump($yy);
			
			//if i have categories where logined users has been looking for,why not te suggest him other products from those categories
			// but excluding products he has already seen
			/*$sql_suggest = "SELECT id,name,category,image 
							FROM products 
							WHERE id <> '$product_id' 
							AND category ='$category'";
			*/
			$sql_suggest = "SELECT id,name,category,image 
							FROM products 
							WHERE id NOT IN('$product_id')
							AND category ='$category'";
            				
							
							
							
							
			//run query
			$result_sql_suggest = mysqli_query($dbc,$sql_suggest);
			
			if(mysqli_num_rows($result_sql_suggest)> 0){

              while($row = mysqli_fetch_assoc($result_sql_suggest)){ 
			  
			   //echo "RESULTS from suggestion</br>";
				echo "<p> product_id".$row['id']."</p>";
				//echo "<p>product name ".$row['name']."</p>";
				//echo "<p> category: ".$row['category']."</p>";
			  
			  }//end of  while($row = mysqli_fetch_assoc($result_sql_suggest)) 

			}//end of if(mysqli_num_rows($sql_suggest)> 0) 
			
			
			
		}//end of while($row = mysqli_fetch_assoc($result_sql_history))
			 
	 }// end of if(mysqli_num_rows($sql_history)> 0)
	 
	
}else{
	
	echo "HISTORY that's what inspires us";
	
} // end of if(isset($_SESSION['email']))
?>
</body>
</html>