<?php //mostviewed_id.php
//codes selects the most viewed products by id and display LIMIT4 on HomePage eshop.php
//more precised than most wanted bases on category of products search by genre.

//included file below can be commented as long as its attached to eshop.body.php with own connection to DB 
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
//perform INNER JOIN Tto select product_id,product_name,image from table tracker4 and table product
$sql_mostveiwed =  "SELECT tracker4.product_id,tracker4.product_name,products.image
					FROM tracker4
					INNER JOIN products ON tracker4.product_id = products.id
					GROUP BY product_name
					ORDER BY COUNT(*)
					DESC
					LIMIT 4;";
//run query
$result_sql_mostveiwed = mysqli_query($dbc,$sql_mostveiwed);
//var_dump($result_sql_mostveiwed);

if(mysqli_num_rows($result_sql_mostveiwed) > 0){
	
	// display header on website call to action to TOP products displayed in while loop below
	echo "<div id='recom4'><h4> Be trendy. Check our hot TOP 4 products!! </h4></div>";

  while($row = mysqli_fetch_assoc($result_sql_mostveiwed)){ 
  
				echo "<div class='col-md-3'>";
				echo "<div id='recom3'>";
				echo "<p>recommendations most viewed from tracker4</p>";
				echo "<p> product id: ".$row['product_id']."</p>";
				echo "</br><p style='color:orange'><strong> product name: ".$row['product_name']. "</strong></p>";
				echo "</div>";
				echo '<img src="'.$row['image'].'" width="100%" height="220px"/>';
				
				echo "
	                   </div> ";
  
  }// end of 

}//end of if(mysqli_num_rows($result_sql_mostveiwed) > 0))

?>
</body>
</html>