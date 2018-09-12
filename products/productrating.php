<?php // productrating.php
// this file takes input fields from product.php
// sanitize input by test_input function
//insert data into DB table "product_rating"
// product rating has two input fields: rating 1-2 select option and textarea,user can leave own comment.
//przenosze tymczasowa inicjacje session do product.php gdzie bedzie zainicjonowana sesji.
//pozostawienie aktywnej sesji w tym pliku spowoduje blad "resend header"
$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);

//izolowalem komentarzem include SQL connection jako,ze wlaczylem ten plik do product.php gdzie juz jest SQL connection zadeklarowane
// jesli wypne ten plik z product.php polaczenie z SQL musi byc aktywowane ponownie
//include '../includes/mysql.inc.php';

//check if form was submited and icheck if POST method was used - POST
if($_SERVER['REQUEST_METHOD']==='POST'){

include'../includes/mysql.inc.php';
	
	//check if button  was clicked
	if(isset($_POST['ratingproduct']) && ($_POST['product_id'])){
		
		//assign value to variables,which you will use in INSERT TABLE
		$rating = $_POST['ratingproduct'];
		var_dump($rating);
		//product_id from hidden value of form from product.php
		$product_id = $_POST['product_id'];
		var_dump($product_id);
		//product_type from hidden value of form from product.php
		$type = $_POST['product_type'];
		var_dump($type);
		$category = $_POST['product_category'];
		echo "kategoria produktu:</br>";
		var_dump($category);
		//user email from loginCheck.php sent by session
		if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		var_dump($email);
		
		  // scenario SB only click comment: insert into table email,product_id,comment,date
		  //use REPLACE INTO  to be able to overwrite new user opinion AND NOT TO MULTIPLY the same USER
		  $sql_rating = "REPLACE INTO rating(user_email,product_id,grade,product_type,category)
		                 VALUES('$email','$product_id','$rating','$type','$category')";
			
						 
			//execute a query
            $result_sql_rating = mysqli_query($dbc,$sql_rating);
            var_dump($result_sql_rating);
			var_dump($dbc);
            echo "<h4>THANKS FOR YOUR RATING</h4>";
	
		}// end of if(isset($_SESSION['email']))
			
	}// end of isset($_POST['ratingproduct'])
	
}//end og $_SERVER['REQUEST_METHOD']
header('Location: http://localhost/ecomm/products/product.php');

	//function test_input izolowalem komentarzem - bo zglasza blad,ze nie moze byc REDECLARE in eshop.header line 28 i w tym pliku
	//, jesli nie pomoze szukja innego rozwiazania
		//function test_input($data){
		  //$data = trim($data);
		  //$data = stripslashes($data);
		  //$data = htmlspecialchars($data);
		  //return $data;
		//}

	
	


// add php syntax which count average from rating table and displays average to proper product_id 

//if($_SERVER['REQUEST_METHOD']==='POST'){
	
//include'../includes/mysql.inc.php';
	
	//check if button  was clicked
	//if(isset($_POST['ratingproduct']) && ($_POST['product_id'])){
		
		//assign value to variables,which you will use in INSERT TABLE
		//$rating = $_POST['ratingproduct'];
		//var_dump($rating);
		//product_id from hidden value of form from product.php
		//poczatek komentarza dobrego kodu przeklejonego do product.php
		
		/*
		echo "REZULTAT Z COOKIE LINIA NIZEJ </br>";
		if(isset($_COOKIE['product_id'])){
			$product_id = $_COOKIE["product_id"];}
		//$product_id = $_COOKIE["product_id"];
		var_dump($product_id);
            
			//query to DB to COUNT(AVR()) on collected in DB values
			$sql_average = "SELECT product_id,ROUND(AVG(grade),1) AS AverageRating
							FROM rating
							GROUP BY product_id";
							
			$result_sql_average = mysqli_query($dbc,$sql_average);
			var_dump($result_sql_average);

			if(mysqli_num_rows($result_sql_average) > 0){
				
					while($row = mysqli_fetch_assoc($result_sql_average)){
						
						echo "ponizej wynik z ROUND(AVG())</br>";
						
						echo "id: ".$row['product_id']. " AverageRating:". $row['AverageRating'].   "</br>";
						
						//assign result of $row[''AverageRating'] to cookie i display on product.php in place with rating
						$cookie_rating = $row['AverageRating'];
						echo "wynik z cookie_rating</br>";
						var_dump($cookie_rating);
						setcookie("AverageRating",$cookie_rating,time()+3600);
						
						//header('Location: http://localhost/ecomm/products/product.php');
						
					}// end of while($row = mysqli_fetch_assoc($result_sql_average))
				
			}//end of if(mysqli_num_rows($result_sql_average) > 0)
				
			
			//koniec komentarza dobrego kodu przeklejonego do product.php
			
			*/
			
			
			
			
			
	
	//}// end of isset($_POST['ratingproduct'])
	
//}//end og $_SERVER['REQUEST_METHOD']




?>

<! DOCTYPE html>
<!-- eshope header-->
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body>
<?php
include'../css/eshop.header.php';
?>
<h4>thanks for you rating</h4>
<a href="http://localhost/ecomm/products/product.php"><button type="button">Back to products!</button></a>

<?php
include'../css/eshop.footer.html';
?>

</body>
</html>