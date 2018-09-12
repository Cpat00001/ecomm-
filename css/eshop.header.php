<?php
if(isset($_GET['shopcolor'])){
	setcookie('shopcolor', $_GET['shopcolor'],time()+3600,'/');
}
?>
<! DOCTYPE html>
<!-- eshope header-->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.eshop.css">
</head>
<body>

<?php
//define variable - input field search from bootstrap search

if($_SERVER["REQUEST_METHOD"]=="POST"){
  // send input to function test_input
  if(isset($_POST['search'])){  
  $search = test_input($_POST["search"]);
  }
}
//function to sanitize an input search field 
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!-- #######################     here is newsletter element used in showNewsletter()  ########################## -->
<div id = "newsletter">
  <h2>Sign up for our Newsletter</h2>
  <h4> Stay informed. let us send you the latest offers and deals.</h4>
  <p> Just simply type in your email below and choose the category you are willint to get news.</br>
	  After all just click agree.</br>
	  Then we will do the rest</p>
     <!-- ########## form to input email and radio button -->
	 <!--######  send this form to sanitization before put into database ### -->
	 <form method="POST" action ="../includes/checkNewsletter.php">
  <div class="form-group">
    <label for="your email">
	<input type="email" name="NewsEmail" class="form-control" id="newsletterForm" aria-describedby="emailHelp" placeholder="Enter you email">
	<small id="emailHelp" class="form-text text-muted"> be informed about our latest deals,discounts and events </small>
  </div>
  <div class="form-check">
		  <div class="form-check">
		  <input class="form-check-input" type="radio" name="NewsType" id="Radio1" value="book" checked>
		  <label class="form-check-label" for="Radio1">
			Books
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="NewsType" id="Radio2" value="movie">
		  <label class="form-check-label" for="Radio2">
			Movies
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="NewsType" id="Radio3" value="game">
		  <label class="form-check-label" for="Radio3">
			Games
		  </label>
        </div>
        <div class="form-check">
		  <input class="form-check-input" type="radio" name="NewsType" id="Radio4" value="All">
		  <label class="form-check-label" for="exampleRadio4">
			All above
		  </label>
        </div>   		
</div>
  <!-- ########## added hidden field which holds value of var x z JavaScript function showNewsletter()  ########-->
  <input type='hidden' name='display_letter' value ='1'>
  <button type="submit" class="btn btn-primary btn-lg" onclick="setCookie()" name="agree" id="agree">Agree</button>
  </form>
  </br>
  <p>if you are not interested to be informed just click Logout button.</p>
   <form method="POST" action ="../includes/logout.php">
    <button type="submit" class="btn btn-primary" name="but1">Logout</button>
	<!-- ########### this element p below displays value of var x = newscookie.valueOf just for test purpose ######## -->
	<p id="test"></p>
   </form> 
    <!--<a href="http://localhost/ecomm/includes/home.php" class="btn btn-info" id="but1" name="but1" role="button"style="color:white";>Logout</a>-->
</div>

<div class="row" id="header">
  <div class="col-sm-6">
     <h3 style="color:white";>eMediaShop</h3>
     <b> e-books , movies , games , books, entertainment...<b>
   </div>
   <div class="col-sm-3" id="two">
     <!-- button Logout below has 2functions: 1st onmouseover - displays banner and Newsletter, 
	      2nd if there is a JavaScriptCookie set "removenews = xxx" then user can logout strightaway without displaying newsletter banner.-->
     <a href="http://localhost/ecomm/includes/home.php" class="btn btn-info" id="but1" onmouseover="showNewsletter()" role="button"style="color:white";>Logout</a>
   </div>
</div>
<!-- inserted CALL $_COOKIE inline as a CSS style to overwrite existing css inlcuded file
wstawilem style=" caly kod php " i zamknalem domykajacym nawiasem/dziubek od nav class > 
jesli nie zadziala usun az do <div class="container" bez jedngo dziubka -->
<nav class="navbar navbar-light" id="customizecolor" style= "
	<?php 
	if(isset($_COOKIE['shopcolor'])){	
	   echo "background-color: #".($_COOKIE['shopcolor']).";\n";
	}else{
		echo "background-color: brown;";
	}  
	?> ">
  <div class="container">
    <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-hand-right"></span>  <b style="color:white;">Menu...</b>
	<small style="color:white";>choose a category</small></a>
	</div>
	<form class="form-inline">
	  <div class="col-md-6" id="headertwo">
	    <a href="http://localhost/ecomm/includes/eshop.php" class="btn btn-warning" role="button" > Home page</a>
	    <a href="http://localhost/ecomm/includes/catalogue1.php" class="btn btn-info" role="button" > Books</a>
	    <a href="http://localhost/ecomm/includes/catalogue2.php" class="btn btn-info" role="button"> Movies </a>
	    <a href="http://localhost/ecomm/includes/catalogue3.php" class="btn btn-info" role="button">VideoGames</a>
		<a href='http://localhost/ecomm/php/cart.php' class='btn btn-warning' role='button' name='headerbutshoppingcart' > Shopping cart</a>
		</form>
	  </div>
	  <!-- form to set/customize header color-->
	  <form action="../css/eshop.header.php" method="GET">
	  <div class="col-md-4">
	    <label for="select" id="selectbut">Select your own shop colours,first choose a colour,then click "set a colour" and go shopping!</label>  
		 <select class="form-control" name="shopcolor">
		    <option value="dd5260"> Original </option>
			<option value="c61d1d"> Bloody Horror </option>
			<option value="09c7f2"> Laguna beach </option>
			<option value="767d7f">Science space</option>
			<option value="f98d00"> Adrenaline Action </option>
		 </select>
		 <button type="submit" class="btn btn-primary">Set a colour</button>
	  </div>
	  </form>
	  <div class="col-md-6" id="headerone">
		<form method="POST" action="../includes/catalogue4search.php"><!-- here is form which search gatunki -->
		Search: <input type="text" name="search" id="search1" placeholder="by genre: action,travel,technology,western,history,science-fiction"/>
		<input type="submit" name="submit" value="Search" id="search2"/> 
		</form>
	  </div>
	</form>
</nav>	
  
  </div>
</nav>
  <script>
      //if someone click a button "agree",then setcookie and to not display newsletter for next period of time- set in cookie
      // function sets a cookie which is fired onclick button id "one" 
	    function setCookie(){
		document.cookie = "removenews = xxx; expires= Fri,16 Aug 2019 20:33 UTC;path=/";
        }// end of function removeNewsletter
  </script>
  <script>
   
	//funtion is fired out when user mouseover button LOGOUT. 
	//if user mouseover button- want to log out- display popup window with newsletter and offers

	document.getElementById("but1").onmouseover = function() {showNewsletter()};

	function showNewsletter(){
	
     	 //function to extract cookie value
    var newscookie = document.cookie.replace(/(?:(?:^|.*;\s*)removenews\s*\=\s*([^;]*).*$)|^.*$/, "$1");  
	
		//if SB clicked button agree and signed up for newsletter dont'display it for next 1year or user delete all cookies in browser
		if(newscookie === "xxx" ){
			
			var x = newscookie.valueOf();
			document.getElementById("test").innerHTML = x;
			//set that div element with newsletter is hide as long as cookie are active/set
			document.getElementById("newsletter").style.display = "none";
		} else {
			document.getElementById("newsletter").style.display = "block";
		}// end of if(newscookie) 
		 

	}// end of function newsletter1()

  </script>

</body>
</html>