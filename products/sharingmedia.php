<?php // sharingmedia.php - files INSERT INTO DB who,what,when shared on social media,a which sociale media
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){

include'../includes/mysql.inc.php';
	
	//check if button  was clicked
	if(isset($_POST['sharesocial']) && ($_POST['product_id'])){
		
		//set variables
		if(isset($_SESSION['email'])){ $email = $_SESSION['email']; }
		var_dump($email);
		$product_id = $_POST['product_id'];
		$product_type = $_POST['product_type'];
		$category = $_POST['product_category'];
		$media = $_POST['socialmedia'];
		
		//insert submited data to table socialmedia
		$sql_social = "INSERT INTO socialmedia(id,user_email,product_id,product_type,product_category,media,data_created)
		               VALUES('','$email','$product_id','$product_type','$category','$media',NOW())";
		//run query
		$result_sql_social = mysqli_query($dbc,$sql_social);
		//echo "RESULT from SQL_SOCIAL";
		//var_dump($email);
		//var_dump($dbc);
		//var_dump($sql_social);
		
	}// end of if(isset($_POST['sharesocial']) && ($_POST['product_id']))
} // end of if($_SERVER['REQUEST_METHOD']==='GET')
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
include'../css/eshop.header.php';
?>

<div class="alert alert-warning col-md-12 text-center pagination-centered" role="alert" id="social_alert">
  <h4>Click any social media button you wish , and share your content with friends.</h4>
</div>
<div class="col-md-12 text-center pagination-centered">
	<a href='https://www.facebook.com/sharer/sharer.php?u=http%3A//localhost/ecomm/products/product.php'><button type="button" class='fa fa-facebook'></button></a>
	<a href='https://twitter.com/home?status=http%3A//localhost/ecomm/products/product.php'><button type="button" class='fa fa-twitter'></button></a>
	<a href='https://plus.google.com/share?url=http%3A//localhost/ecomm/products/product.php'><button type="button" class='fa fa-google'></button></a>
    </br></br>
</div>

<?php
include'../css/eshop.footer.html';
?>
</body>
</html>