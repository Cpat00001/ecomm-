<?php //ratingbannerrecomm.php
// this file capture that user clicked rating banner with UPSELL recomendation
//then search product related by category or type to product_id 
//displayed in rating banner catalogue2.php for user who has rated movie 4 or 5

//required connection with DB,if this file is not inserted to bigger one which has already DB connection
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
if(isset( $_COOKIE['banner4']) != ""){
	
	$product_id = $_COOKIE['banner4'];
	var_dump($product_id);
	
	//search for type and category where product_id fromm COOKIE[banner4] belonges to..
	$sql_select = "SELECT type,category 
	               FROM products
				   WHERE id = '$product_id'";
    //run a querry
    $result_sql_select = mysqli_query($dbc,$sql_select);
    //var_dump( $result_sql_select);

   if(mysqli_num_rows( $result_sql_select)>0){ 
   
     //output data each row
	while($row = mysqli_fetch_assoc($result_sql_select)){ 
	
	  echo "RESULT from result_sql_select</br>";
      echo "category : ".$row['category']." type : ".$row['type']."</br>";
	  
	  //asign output from while to variables
	  $category = $row['category'];
	  $type = $row['type'];
	  
	    //if I have category >> I think is better to suggest products base on category/genre/subject
		$sql_other = "SELECT id,name,image 
				     FROM products
					 WHERE category = 'travel'
					 LIMIT 4";
					 
		//run query
		$result_sql_other = mysqli_query($dbc,$sql_other);
		
		if(mysqli_num_rows($result_sql_other)>0){
			
		echo "<div class='container'>";
        echo "<div class='row'>";
			
		  //output data each row
	      while($row = mysqli_fetch_assoc($result_sql_other)){ 

            echo "<div class='col-md-3'>";
				echo "<div id='recom3'>";
				echo "<p>recommendations base on click ratingbanner</p>";
				echo "<p> product id: ".$row['id']."</p";
				echo "</br><p style='color:orange'><strong> product name: ".$row['name']. "</strong></p>";
				echo "</div>";
				
				echo '<img src="'.$row['image'].'" width="100%" height="220px"/>';
				
				echo "</div>";
			
          
          }//end of while($row = mysqli_fetch_assoc($result_sql_other))	
        
        echo "</div>
              </div>";
		
			
		}//end of if(mysqli_num_rows($result_sql_other)>0)
		
      	  
	}//end of while($row = mysqli_fetch_assoc($result_sql_select))
   
   }//end of if(mysqli_num_rows( $result_sql_select)>0)	
	
}// end of if(isset( $_COOKIE['banner4']) != "")

?>
</body>
</html>