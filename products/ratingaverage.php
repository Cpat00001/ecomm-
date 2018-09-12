<?php// ratingaverage.php
//select average of rating with product_id

include '../includes/mysql.inc.php';


$sql_average = "SELECT product_id,ROUND(AVG(grade),1) AS AverageRating
                FROM rating
				WHERE product_id = $product_id";
				
$result_sql_average = mysqli_query($dbc,$sql_average);
var_dump($result_sql_average);

if(mysqli_num_rows($result_sql_average) > 0){
	
	while($row = mysqli_fetch_assoc($result_sql_average)){
		
		echo "id: ".$row['product_id']. " AverageRating:". $row['AverageRating'].   "</br>";
		
	}
	
}

echo "TESTY";

?>