<?php // this file insert into tables "sales" data. the "sales" table if a confirmation of bought products
session_start();

?>
<!DOCTYPE html>
<html>
<head>

<meta charset = "UTF-8">
<meta name="keywords" content="shipping cart eMediaShop">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body>
<?php
include'../includes/mysql.inc.php';

//session value from loginCheck.php
if(isset($_SESSION['user_session_id'])){
echo ($_SESSION['user_session_id']);
$user_session_id = $_SESSION['user_session_id'];
var_dump($user_session_id);



// get id from order_cart to insert this value into next query into "sales" table 
$sql_sold1 = "SELECT id,product_id FROM order_cart WHERE user_session_id = $user_session_id";
 //echo "PONIZEJ WYNIK sql_sold1 </br>"; 
 //var_dump($sql_sold1);


$result_sql_sold1 = mysqli_query($dbc,$sql_sold1);


if(mysqli_num_rows($result_sql_sold1) > 0){
	
	//output data each row
	while($row = mysqli_fetch_assoc($result_sql_sold1)){
		
		echo "id from order_cart: " .$row['id']."</br>";
		echo "product_id from order_cart: " .$row['product_id']."</br>";
		
		//assign values from while loop to $$
		$id_order_cart = $row['id'];
		// ustaw order_cart_id session dla tabeli shipping. podaj ta wartosc przez session
		$_SESSION['order_cart_id'] = $id_order_cart;
		$product_id = $row['product_id'];
		
		// jesli mam dane: $product_id = $row['product_id'] oraz $user_session_id = $_SESSION['user_session_id'] - ktory jest rowny ID usera
		// moge teraz wyszukac SQL INNER JOIN or LEFT JOIN all product FORM category where product_id = "category" i przypisac do usera
		// jesli sie zaloguje ten sam user wyswietl mu rekomendacje po user_session_id
		
		// SELECT category where product_id given belongs to
		$sql_select = "SELECT category,price FROM products WHERE id = $product_id";
		
		$result_sql_select = mysqli_query($dbc,$sql_select);
        //echo "BELOW RESULT OF result_sql_select</br>";
        //var_dump($result_sql_select);
		//var_dump($dbc);
		
				if(mysqli_num_rows($result_sql_select)>0){
				
					//output data row
					while($row = mysqli_fetch_array($result_sql_select,MYSQLI_ASSOC)){
						echo"RESULT from category and price</br>";
						echo $row['category'];
						echo $row['price'];
						//$product_id = $row['product_id'];
						echo "POZNIZEJ WYNIK Sproduct_id, price </br>";
						//var_dump($product_id);
						$price = $row['price'];
						var_dump($price);
					
					//if I have a category , now i can find random from this category and recommend user to bou other product corelated to category
					//for example user bought book from travel category i can recommend now movie and game from the same category/genre to generate sale
					$category = $row['category'];
					
					//query to DB to select all product related by category/genre
					$sql_select_category = "SELECT name,image FROM products 
											WHERE category = '$category'
											AND price > '$price'
											ORDER BY RAND()
											LIMIT 2";
					
					//run the query
					$result_sql_select_category = mysqli_query($dbc,$sql_select_category);
					//echo "BELOW RESULT OF result_sql_select_category </br></br>";
					//var_dump($result_sql_select_category);
					//echo "BELOW RESULT OF dbc connection </br>";
					//var_dump($dbc);
					
						if(mysqli_num_rows($result_sql_select)==1){
				
							//output data row
							while($row = mysqli_fetch_array($result_sql_select_category,MYSQLI_ASSOC)){
								
								//below are displayed all rows related to category where bought by user product come from
								// ponizej wynik skorelowany categoria/gatunkiem do produkty ktory kupil i potwierdzil USER naciskajac Confirmation button
								echo "</br>  product name: " .$row['name']." product_image: ".$row['image']. "</br></br>";
								echo "{$row['name']}";
								echo "{$row['image']}";
								
								//assign output to $_COOKIE and sent to desirable subsite example: '../css/eshop.body.php'
								// cookie random name related to category/genre
								$upsell1 = "{$row['name']}";
								$upsell2 = "{$row['image']}";
								//echo "WYNIKI Z Sran1 i Sran2 wpisane do setcookie";
								//var_dump($ran1);
								//var_dump($ran2);
								setcookie("UPSELL1",$upsell1,time()+3600,'/');
								setcookie("UPSELL2",$upsell2,time()+3600,'/');
								
								
								/*
								
								while($row = mysqli_fetch_assoc($result_sql1)){
											
											echo "{$row['image'] }";
											
											//assign output of loop to $variable and then $variable to COOKIE
											$cookie = $row['image'];
											//echo "WYNIK Z COOKIE</br>";
											//var_dump($cookie);
											
											setcookie("UPSELL", $cookie,time()+3600,'/');
								
								
								*/
								
								
							} //end of while($row = mysqli_fetch_array($result_sql_select_category,MYSQLI_ASSOC))
					
				        } //end of if(mysqli_num_rows($result_sql_select)>0) 
					
					
					}// end of while($row = mysqli_fetch_array($result_sql_select,MYSQLI_ASSOC))
					
				} // end of if(mysqli_num_rows($result_sql_select)>0)
				

//ODBLOKUJ KOMENTARZ NA $sql_sold2 = "INSERT INTO sales(id,order_cart_id,product_id,purchase_date)
// ORAZ LINII VALUES('','$id_order_cart','$product_id',NOW())";
// ZABLOKOWALEM NA CZAS TESTOW I UZUSKANIA WYNIKU DLA REKOMENDACJI. TE DANE MUSZA BYC WSTAWIANE DO TABELI sale - ODBLOKUJ TO!!
// JESLI NIE ODBLOKUJESZ REKOMENDACJE BAZUJACE NA TABELI sales.php NIE BEDA DZIALAC,NIE BEDZIE PO PROSTU KOLEJNYCH REJESTRACJI ZAKUPY po confirmation		
		
		
	
	} // end of while($row = mysqli_fetch_assoc($result_sql_sold1))
	
}else{ 

      echo "NO result from result_sql_sold1";
}//end of if(mysqli_num_rows($result_sql_sold1) > 0)

} // end of if(isset($_SESSION['user_session_id']))

//query to insert data to "sales" table
$sql_sold2 = "INSERT INTO sales(id,order_cart_id,product_id,purchase_date) 
             VALUES('','$id_order_cart','$product_id',NOW())";

$result_sql_sold2 = mysqli_query($dbc,$sql_sold2);
var_dump($sql_sold2);

?>

</body>
</html>