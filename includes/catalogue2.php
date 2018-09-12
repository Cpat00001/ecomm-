<?php
session_start();
?>
<?php
include'../includes/mysql.inc.php';
// include tracker2.php to count how many times website has been displayed/viewed
include 'tracker2.php';
?>
<! DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body onload="banner()"><!-- ### very important onload function display banner ratingbanner -->
<?php
include'../css/eshop.header.php';
include '../products/baseratingbanner.php';
?>

<h4> Choose from among movies, which have fascinated people</h4>
<div class="col-md-6" id="catdiv1">
<h3>you have choosen a catalogue 2. Movies</h3>

<?php

//select from products db 
$sql = "SELECT name,id,image,description,price,stock,type,category FROM products WHERE type = 'movie'";
$result = mysqli_query($dbc,$sql);

if(mysqli_num_rows($result)>0){
	
	//output data each row
	while($row = mysqli_fetch_assoc($result)){
		
		echo '<li id="item-list">';
		echo '<div id="catdiv2"><h4>Name: '.$row['name'].'</h4></div></br>';
		echo '<p> This is catalogue-product nr: '.$row['id'].'</p>';
		echo '<img src="'.$row['image'].'" width="60%" height="350px"/>'; //PRAWIDLOWY KOD DO IMAGE DISPLAY
		echo '<p>Category: '.$row['category']. '</p>';
		echo  '<p></br>Description: </p>'.$row['description']."</br>";
		
		//more info button, after clicking send user to product.php with more info about product
		echo '<form method="POST" action="../products/product.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="submit" value="More info" class="btn btn-info" name="moreinfo"></form>';
		
		//echo '<a href="#"><button type="button" class="btn btn-info" id="catbutton2">More info</button></a>';
		echo '</br></br><strong>Price: £ '.$row['price'].'</strong></br><strong>Stock: '.$row['stock'].'</strong></br></br>';
		
		//create a form to send data to whish_list after pressing button "Add to WishList."
		echo '<form method="POST" action="../php/wishlist.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="hidden" name="product_category" value="'.$row['category'].'">
			  <input type="submit" value="Add to WhishList" class="btn btn-success" name="addtowishlist"></form>';
			  
			  //echo '<a href="#"><button type="button" class="btn btn-success" id="catbutton">Add to WishList</button></a></br>';
		
		
		// create a form with input hidden to send data to cart.php after press "Add to bakset button" 
		echo '<form method="POST" action="../php/cart.php">
		      <input type="hidden" name="product_id" value="'.$row['id'].'">
			  <input type="hidden" name="product_type" value="'.$row['type'].'">
			  <input type="hidden" name="product_category" value="'.$row['category'].'">
			  <input type="hidden" name="product_price" value="'.$row['price'].'">
			  <input type="submit" value="Add to basket" class="btn btn-danger btn-lg" name="catbutton3"></form>';
			  
		echo '</li>';
	}
	
   
 }else{
		echo "0 results,sorry";
}

?>
</div>
<?php
//inserted here PHP code which is second and execution part of cycle insert USER after clicking button "MOST WANTED"
//1st part on site eshop.body.php user click button with onclick fired function set cookie
//2nd part which is executed on this page and others with category(can be dynamically changed) 
//does PHP get value from COOKIE and insert it to DB ctr1 - as long as cookie is active = 5sec.

//$email = $_SESSION['email'];
//echo "result email z session";
//var_dump($email);
//echo "result from COOKIE</br>";
//var_dump($_COOKIE["ctr1"]);

//tutaj musi byc warunek. jesli $x ma wartosc wpisz do tabeli, jesli nie ma wpisz wartosc "empty"
if(isset( $_COOKIE['ctr1']) != ""){
//insert this value into BD table CTR1
$sql_insertCTR = "INSERT INTO ctr1(id,event_occur,email,time)
                 VALUES('', '".$_COOKIE['ctr1']."','$email',NOW())";
//run query
$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
//var_dump($dbc);
//echo "result from z sgl_insert</br>";
//var_dump($result_sql_insertCTR);	

}// end of if($x != "")
?>
<?php
// code below check if cookie was set in previous product.php page - if comments were displayed,then insert into DB table record.
//check if cookie exists if yes - is not equal to empty/0 do job in function - insert data t octr1 table DB
if(isset( $_COOKIE['mo']) != ""){
//insert this value into BD table CTR1
$sql_insertCTR = "INSERT INTO mo_comment(id,event_occur,email,time)
                 VALUES('', '".$_COOKIE['mo']."','$email',NOW())";
//run query
$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
//var_dump($dbc);
//echo "result from z sgl_insert</br>";
//var_dump($result_sql_insertCTR);	

}// end of if(isset( $_COOKIE['mo']) != "")
?>
<?php
        //##################  wklejam tu code do linie ########## koniec kodu
	    if(isset($_COOKIE['mo2'])){$product_id = $_COOKIE['mo2']; }
		//$product_id = $_COOKIE['mo2'];
		//echo "WARTOSC PRODUCT ID z COOKIE mo2</br>";
		//var_dump($product_id);
		// code below check if cookie was set in previous product.php page - if comments were displayed,then insert into DB table record.
		//check if cookie exists if yes - is not equal to empty/0 do job in function - insert data t octr1 table DB
		if(isset( $_COOKIE['mo']) != ""){
		//take form this site aboe value of product_id line53 , below button name="moreinfo
        $product_id = $_COOKIE['mo2'];
		//insert this value into BD table CTR1
		$sql_insertCTR = "INSERT INTO mo_comment(id,event_occur,email,product_id,time)	
						 VALUES('', '".$_COOKIE['mo']."','$email',$product_id,NOW())";
		//run query
		$result_sql_insertCTR = mysqli_query($dbc,$sql_insertCTR);
		//var_dump($dbc);
		//echo "result from z sgl_insert</br>";
		//var_dump($result_sql_insertCTR);	

		}else{
			
			echo "Click a pop-up banner,to hide it</br>";
		}// end of if(isset( $_COOKIE['mo']) != "")
		
	// ################### koniec przeklejonego kodu	

?>
<?php
//################### section of PHP code: handles with COOKIE set by JavaScript, INSERT data INTO table rating_banner

if(isset($_COOKIE['banner'])){
	
	$into_banner = "INSERT INTO rating_banner(id,displayed,user_email,interested) 
	                VALUES('','displayed','$email','')";
	//run query
	$result_into_banner = mysqli_query($dbc,$into_banner);
    //echo "RESULTS from INTO_BANNER</br>";
    //var_dump($result_into_banner);
    //var_dump($dbc);
	
}else{
	
	echo "Don't be afraid to rate products.Speak,write,share";
} // end of if(isset($_COOKIE['banner']))

// section where onclick.event JS fires cookie,then PHP capture value of cookie and INSER data to rating_banner
    // #####################  aditional condition if clicked image then insert interested
/*
	if(isset($_COOKIE['banner3'])){
	
	$into_banner2 = "INSERT INTO rating_banner(id,displayed,user_email,interested)
				     VALUES('','','$email','interested')";
	//run query
	$result_into_banner2 = mysqli_query($dbc,$into_banner2);
	echo "RESULTS from INTO_BANNER2 </br>";
	var_dump($result_into_banner2);
	var_dump($dbc);
	
	//############################# end of if(isset($_COOKIE['banner3'])) 
	
}else{
	
	echo "Speak,write,share you opinions about products.Be opinion-forming";
}// end of if(isset($_COOKIE['banner3']))

	*/

?>
<?php
include'../css/eshop.footer.html';
?>
<!-- ###### line below is inserted a file js which display/hide and create cookie with banner and ad/recommendation ##### -->
<!--<script type="text/javascript" src="../js/ratingbanner.js"></script>-->
<!--######### INSERT ALL CODE FROM ratingbanner.js HERE BELOW insted of outsite included ratingbanner.js. I have to do this to get value
               product_id into document.cookie=banner4. I cannot send phph variable value to external js script  ############-->
<script>

function banner(){

    //this function create cookie, then PHP function insert values to DB,
	//marketer will be able to measure how many times banner was displayed
   
    document.getElementById("ratingbanner").style.display = "block";
    document.cookie = "banner= yes; expires=0; path=/";
}


document.getElementById("bannerbutton").onclick = function() {hideBanner()};

function hideBanner(){
 
  //function hide banner and create cookie.the cookie will be taken by PHP function and sent to DB as user refuse this product
  // amount of displaying AD divide to refuse click button allow to measure CTR (click throught rate of banner)
 document.getElementById("ratingbanner").style.display = "none";
 document.cookie = "banner2= true; expires=0; path=/";
 
 if(document.cookie.replace(/(?:(?:^|.*;\s*)banner2\s*\=\s*([^;]*).*$)|^.*$/, "$1") === "true"){
 
    document.getElementById("ratingbanner").style.display = "none";
 
  } // end of function hideBanner()

} // end of function hideBanner()

document.getElementById("bannerbutt").onclick = function() {register()};

function register(){
  // this function set another cookie - says that user interested-ACCEPT ad-participate,and clicked image with game
  //which will be sent to PHP and base on it the user email will be sent to DB
  //set time in this cookie - to be able not to measure all the time that SB accepted an offer 2nd,3rd time in the sme session
  var now = new Date();
  var time = now.getTime();
  var expireTime = time + 60*1000;
  now.setTime(expireTime);
  //var tempExp = 'Wed, 31 Oct 2012 08:50:17 GMT';
  document.cookie = 'banner3=accept;expires='+now.toGMTString()+';path=/';
  document.cookie = "banner4=<?php echo $product_id; ?>; expires=0;path=/";
} // end of function register()

</script>

<!-- ################################# END OF JAVASCRIPT CODE FROM js/ratingbanner.j ############-->

</body>
</html>
