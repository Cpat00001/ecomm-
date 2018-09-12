<?php //survey.php
//files contains question to grab quality data feedback from users
// define variables and set to empty values
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
 <title>Feedback survey</title>
</head>
<body>
<div class="container">
  <div class="row">
	<!--########### would you recommend our shop your friends?? ########## -->
	<div class="col-md-4" id="sur1">
	   <h4 id="sur4">Would you recommend our shop your friends?</h4>
	    <form method = "POST" action="../admin/checksurvey.php">
		 <label class="radio-inline">
		   <input type="radio" name="radio" value="Yes"> Yes
		 </label>
		 <label class="radio-inline">
		   <input type="radio" name="radio" value="Noo"> No
		 </label>
	</div>
	<div class="col-md-4" id= "sur2">
	<!-- ######## what products would you like to see in our offer ##################-->	
	    <h4 id="sur4">What products would you like to see in our offer ?</h4>
		<div class="form-group">
		  <label for="comment">Comment:</label>
		  <textarea class="form-control" rows="1" name="range"></textarea>
		</div>
		<input type="submit" class="btn btn-warning" value="Send feedback" name="surveyfeed">
	  </form>
	</div>
     <!-- here add non matching add to display for study example -->
	 <div class="col-md-4" id="notmach">
	   <?php
	    //query to DB select RANDOM not matchind add, for comparison purpose with matching ads
		$notmatch = "SELECT id,name,category,image
					 FROM products
					 ORDER BY RAND()
					 LIMIT 1";
		//run query
		$run_notmach = mysqli_query($dbc,$notmatch);
		//var_dump($run_notmach);
		
		if(mysqli_num_rows($run_notmach)> 0){
			
			while($row = mysqli_fetch_assoc($run_notmach)){
				
				echo "<div id='recom3'>";
				echo "<p> not matching advertisement based on RAND()</p>";
				echo "<p> product id:". $row['id']. "</p> ";
				echo "<p style='color:orange'><strong>Product name : ".$row['name']."</strong></p>";
				echo "</div>";// end of div element <div id =recom3>
				echo '<img src= "'.$row['image'].'" width="100%" height="220px"/>';
				
					
			}// end of while loop
			
		}// end of if(mys_sql_num_rows)> 0
	   
	   ?>  
	 </div>
  </div>
</div>
</body>
</html>
