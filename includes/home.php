<?php
session_start();
$message = "Welcome Back.</br>
            We are happy you visit us quite often.</br> 
			We prepared a discount for you...3% for all books</br> 
			till the end of this week";
setcookie("Often",$message, time()+3600,'/');

?>

<! DOCTYPE html>
<html lang="en">
<head> 
<title>eMediaShop</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/style1.css">
<style>
#div1{
  height:75%;
  background-color:rgb(15,73,168);
 
}
#div2{
 width:auto;
 padding:1%;
 background-color: rgb(100,150,250);
 margin-top: 2%;
 color: gold;
}
#div3{
  width:auto;
  padding:1%;
  background-color: brown;
  margin-bottom: 2%;
  color: gold;
}
#x1{
   display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
 
}
#onedisplay{
  background-color:rgb(100,100,250);
  margin-left:20%;
  margin-right:10%;
  width:50%;
  padding:5%;
  border:1px black;
}
#btncancel{
 float: right;
}

</style>
</head>
<body>
<?php
//connect to DB
require('mysql.inc.php');
include '../js/cookiepolicy.html';


$userErr = $emailErr = $pswdErr = $pswd2Err = $fnameErr = $lnameErr = $bioErr ="";
$user = $email = $pswd = $pswd2 =$fname = $lname = "";
?>
<script>
//var m = document.getElementById("x1");

function fun1(){
 document.getElementById("x1").style.display = "block";
}

</script>

<div class="container">
  <div class="col-sm-12" id="header">
    <h2>eMediaShop</h2><h3> e-books, movies,games,comics,others...</h3>
	<div class="col-sm-6" id="form">
	<form class="form" method= "POST" action = "loginCheck.php"><!-- zamienilem loginCheck.php z tymczasowym session2.php -->
	  <label for="email">Login</label>
	  <input type="email" class="form-control" id="email" name="email3" placeholder="Enter email">
	  <label for="password"> Password </label>
	  <input type="password" class="form-control" id="psw" name="pswd3" placeholder="Enter password">
	  </br>
	  <div class="checkbox">
	    <label><input type="checkbox" name="remember"> Remember me</label>
	  </div>
	    <button type="submit" class="btn btn-success" id="button" name="submit1"> Login </button>
	</form>
	
	</div>
  </div>
</div>
  <div class="container" id="registerform">
  <div class="row">
    <!-- here put new button and JS -->
    <div class="col-sm-3" id="div1">
	       
		   <h3 style="color:gold;">Registration form</h3></br></br>
		   
		   <div class="cols-sm-3" id="div1div1">
		  <h3>Register to continue shopping</h3>
		  <button class="btn btn-warning btn-lg" onclick="fun1()">Registration button</button>
		  </div>
    </div>
    
   
	<div class="col-sm-6" id="two" >
	 <!-- <h2> here is main body</h2>-->
  
  <!--carousel elements-->
  <div class="col-md-12" id="homediv21">
  <h3 id="text1" style="margin-top:10%";>Many possibilities, huge opportunities , great deals. Choose a product. </h3>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="../images/eBooks.jpg" alt="eBooks,comics" style="width:100%; height:300px">
		 <div class="carousel-caption">
		   <h4 style="color:black">Books you love.</br>Comics you desire...</h4>
		 </div>
      </div>

      <div class="item">
        <img src="../images/movies.jpg" alt="movies" style="width:100%; height:300px">
		  <div class="carousel-caption">
		    <h4 style="color:white">Movies,which you will never forget</h4>
		  </div>
      </div>
    
      <div class="item">
        <img src="../images/games.jpg" alt="games" style="width:100%; height:300px">
		  <div class="carousel-caption">
		    <h4 style="color:white">Amazing and Spectacular VideoGames!</h4>
		  </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>

  
</div>


	<div class="col-sm-3" id="three" >
	  <p>(search word selected using category/genre)recommendation by genre </p>
	  <h4>last user's search. </h4>
	  <?php
	    //read from COOKIE set in catalogue4search.php in field SEARCH/ displays last search.
	    if(isset($_COOKIE['search1'])){
			$ciastko = $_COOKIE['search1'];
			var_dump($ciastko);
			
	    echo "<h3 style='color:orange'> your last search: " .$_COOKIE['search1']."</h3>";
		}else{
			echo "Try to search something for you";
		}
	  ?>
	</div>
  </div>
  </div>
  <div class="container">
    <div class="col-sm-4" id="four">
	  <p>Frequent visitors</p>
	  <?php
	  //read cookie from cookieOftenVisitor.php
	  include'cookieOftenVisitor.php';
	  ?>	 	  
	</div>
	<div class="col-sm-4" id="five">
	  <p>(added but not bought- reminder) </p>
	  <h4 style="color:orange">last item you have added to your basket </h4>
	   <?php
	  //read from COOKIE set in cart.php last added to order_cart items
	  if(isset($_COOKIE['cart'])){
		  //echo $_COOKIE['cart'];
	     $show =  $_COOKIE['cart'];
		 
		 
	          // execute a query select image from products table
			  $sql_show = "SELECT image FROM products WHERE id = $show";
			  //var_dump($sql_show);
			  
			  
			  
			  $result_show = mysqli_query($dbc,$sql_show);
			  //var_dump($result_show);
			  //var_dump($dbc);
			  
			  
			  
			  if(mysqli_num_rows($result_show) > 0){
				 
				//display all selected rows/data - should be only one as $_COOKIE['cart'] which is == $_POST['product_id'] from cart.php 
				while($row = mysqli_fetch_assoc($result_show)){
					
					echo '<img src="'.$row['image'].'" width="100%" height="250px"/>';
					
				}//end of isset($_COOKIE)
				}// end od while loop 
			  }// end of if(mysqli_num_rows)
	  
	  
	  
	  if(isset($_COOKIE['cart'])){
		  
            //echo $_COOKIE['cart']. "</p>";		  
	  }else{
	        echo "So far you have not bought any item in our online store.</br> Try this time.";
       }
      ?>
	  
	</div>
	<div class="col-sm-4" id="six">
	<p>Cross_selling marketing technic</p>
	  <h4 style="color:orange">other items you may like</h4>
	  <?php
	  // wyswietl tutaj COOKIE z wishlist
	  if(isset($_COOKIE["CROSS_SELL"])){
		  $image = $_COOKIE["CROSS_SELL"];
		  //echo "WYNIK Z Simage: </br>";
		  //var_dump( $image);
		    //display image from cookie from wishlist.php
            echo '<img src = "'.$image.'" width="100%" height="250px"/></p>';														
	  }else{
	        echo "At the moment you dont have any wish_list products.</br>";
       }
      ?>
	  
	</div>
  </div>
  <div class="col-sm-12" id="footer">
    <div class="col-sm-5" id="footer1">
      <h4> "So many books,so little time.." Zappa</h4>
	</div>
    <div class="col-sm-7" id="footer2">
      <p> eMedia123 e-mail adress: customerservice@eMedia123.com </p>
	  <p> free delivery within 24hours</p>
    </div>	
  </div>
</div>

<!-- ####################### hidden registrations form button "Registration with a bonus" #############################-->
<div id="x1">
  <div id="register1"> 
     <div class="col-sm-3" id="onedisplay">
     <b>New here?</br>Register to explore great offers.</b>
	 <form class="form" method="POST" action="checkRegistration.php">
	   <div class="form-group">
	    <label for="form"> Create your profil </label></br>
        <input type="username" class="form-control" id="user" placeholder="username" name="username">
       </div></br>
       <div class="form-group">
        <input type="email" class="form-control" id="email2" placeholder="your email" name="email">
       </div></br>
       <div class="form-group">
        <input type="password" class="form-control" id="pswd1" placeholder="enter password" name="pswd">
       </div></br>		
	   <div class="form-group">
	    <input type="password" class="form-control" id="pswd2" placeholder="confirm password" name="pswd2">
	   </div></br>
	   <div class="form-group">
	    <input type="fname" class="form-control" id="fname" placeholder="first name" name="fname"> 
	   </div></br>
	   <div class="form-group">
	     <input type="lname" class="form-control" id="lname" placeholder="last name" name="lname">
		</div>
		<label for="gender">Gender</label>
		<div class="checkbox">
	    <label><input type="checkbox" class="form-check-input" name="bio" value="M"> Male</label>
		<label><input type="checkbox" class="form-check-input" name="bio" value="F"> Female</label>
		<label><input type="checkbox" class="form-check-input" name="bio" value="O"> Other</label>
	  </div>
	  </br>
	  
	  <h4>If you want to get a free video game please fill in input fileds below.</h4></br>
		<label for="age">How old are you?</label>
		<div class="form-group">
		  <label for="age"><input type ="checkbox" class="form-check-input" name="age" value="18-30"> 18-30</label>
		  <label for="age"><input type ="checkbox" class="form-check-input" name="age" value="30-45"> 30-45</label>
		  <label for="age"><input type ="checkbox" class="form-check-input" name="age" value="45-60"> 45-60</label>
		  <label for="age"><input type ="checkbox" class="form-check-input" name="age" value="60"> 60+ </label> 
		</div>
		<div class="form-group">
		  <label for="hobby"> Hobby </label>
		  <select class="form-control" id="selectHobby" name="hobby">
		    <option> Hiking </option>
			<option> Sport </option>
			<option> Electronics </option>
			<option> Cars </option>
			<option> Traveling </option>
			<option> UFO</option>
			<option>Space</option>
			<option> Other...</option>
			</select>
		</div>
		<div class="form-group">
			<p> if other...what's your hobby?</p>
			<textarea class="form-control" id="otherHobby" rows="3" name="otherHobby"></textarea>
		
		</div>
		<div class="form-group">
		  <label for="socialmedia"> What is your favourite social media ? </label>
		  <select class="form-control" id="selectMedia" name="socialmedia">
		    <option> Facebook </option>
			<option> Twitter </option>
			<option> G + </option>
			<option> Pinterest </option>
			<option> YouTube </option>
			<option> LinkedIn </option>
			<option> None </option>
			</select>
		</div>
		<!-- <p> element for JS displays output function myFunction() -->
		<p id="leave"></p>
			
		<button type="submit" class="btn btn-success"> Create an account</button>
		<!--<a href="http://localhost/ecomm/includes/home.php" class="btn btn-info" id="btncancel" onclick="myFunction()"> Cancel</a>-->
		<button type = "button" onclick="myFunction()" class="btn btn-info" id="btncancel" > Cancel </button>
		
		
		
		
		<!-- ################# JavaScript code from registrationConfirmation.js. ############ -->
		<script>
        // this function will be onclick "Cancel" button 
		function myFunction() {
		  
		  var txt;
		  if(confirm("Are you sure that you'are leaving us?")){
			  
			  txt = "You really leaivng us. we are upset";
			  document.location.replace('http://localhost/ecomm/includes/home.php');
		  }else{
			  
			  txt = "We are happy, that you have decided to stay.Thank you";
		  } 
		   document.getElementById("leave").innerHTML = txt;
			
		}// end of function
        </script>
		
		
		
	 </form>
   </div>
</div>


</div>

</body>
</html>
