<?php
$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);
if(isset($id)) {setcookie("ide",$id,time()+3600,'/');}

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
include'../includes/mysql.inc.php';
include'../css/eshop.header.php';
?>
<?php
//check if form was submited, and what access the page was used - POST
if($_SERVER['REQUEST_METHOD']==='POST'){
	
	//check if button "moreinfo" was clicked
	if(isset($_POST['moreinfo'])){
		
		if(isset($_POST['product_id'])){
		$id = $_POST['product_id'];
		var_dump($id);
		$_SESSION["product_id"]=$id;
		//set cookie,take dynamically generated product_id numer and send to cart.php
		//setcookie("ide",$id,time()+3600,'/');
		
				$sql_info = "SELECT id,name,category,description,image,price,type FROM products WHERE id = $id";
				
				//execute query against DB
				$result_sql_info = mysqli_query($dbc,$sql_info);
				//var_dump($result_sql_info);
				//var_dump($dbc);
				
				
				if(mysqli_num_rows($result_sql_info)>0){
			
					//output data each row
					while($row = mysqli_fetch_assoc($result_sql_info)){
						
					    echo "<div class='container'>
						      <div class='row'>
						       <div class='col-md-8' id='prodone'>
							     <h4>Here is a product element</h4>";
						echo '<li id="item-list">';
						echo '<h4>Name: '.$row['name'].'</h4>';
						$_SESSION['product_name'] = $row['name'];
						echo '<p> This is catalogue-product nr: '.$row['id'].'</p>';
						$_SESSION['product_id'] = $row['id'];
						//assign product_id to $row['id'],a then send it in COOKIE to productrating.php,
                        //where SQL query takes this value and COUNT(AVG))for product with this/selected product_id
						//$cookie_productid = $row['id'];
						//setcookie('product_id',$cookie_productid,time()+3600);
						echo '<img src="'.$row['image'].'" width="60%" height="350px"/>'; //PRAWIDLOWY KOD DO IMAGE DISPLAY
						echo '<p>Product type: '.$row['type'].'</p>';
						$_SESSION['product_type'] = $row['type'];
						$type = $row['type'];// assign $row['type'] to $type which will be sent by POST to productrating.php and put into table rating
						echo '<p>Product category: '.$row['category'].'</p>';
						$category = $row['category']; // assign $row['category'] to $category will be sent to productrating.php, then put to table rating
						echo  '<p></br>Description: </p>'.$row['description'].'</br>';
						echo '</li>';
						echo	"<h4>Share your products with your friends</h4>";

								
						//social buttons
						echo    "<div class ='container'>
								  <div class= 'row'>
									<div class='col-md-2'>
									</div>		
									<div class='col-md-6'>
									<!-- social media sharing form - send to sharingmedia.php-->
									<!--Facebook-->
									  <form action='sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='product_category' value ='$category'>
									  <input type='hidden' name='socialmedia' value='facebook'>
									  <button type='submit' class='fa fa-facebook' name='sharesocial'></button>
									  </form>
									  <!--Twitter-->
									  <form action='sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='product_category' value ='$category'>
									  <input type='hidden' name='socialmedia' value='twitter'>
									  <button type='submit' class='fa fa-twitter' name='sharesocial'></button>
									  </form>
									  <!--Google +-->
									  <form action='sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='product_category' value ='$category'>
									  <input type='hidden' name='socialmedia' value='G+'>
									  <button type='submit' class='fa fa-google' name='sharesocial'></button>
									  </form>
									</div>	
									<div class='col-md-2'>
									</div>
								  </div>
								</div>";//end of social button div		
								
						echo	"<h3>Rating</h3>
						
								  <!-- form to send product rating-->
								  <form action='productrating.php' method='POST'>
								  <div class='col-md-4'>
									<label for='select' id='ratingbut'>Rate this product</label>  
									 <select class='form-control' name='ratingproduct'>
										<option name = '1' value='1'> 1 </option>
										<option name = '2' value='2'> 2 </option>
										<option name = '3' value='3'> 3 </option>
										<option name = '4' value='4'> 4 </option>
										<option name = '5' value='5'> 5 </option>
									 </select>
									 </br>
									 <input type='hidden' name='product_id' value ='$id'>
									 <input type='hidden' name='product_type' value ='$type'>
									 <input type='hidden' name='product_category' value ='$category'> 
									 <button type='submit' class='btn btn-primary name='ratingbutt'>Send your rating</button>
								  </div>
								  </form>";
						echo	"</br></br></br></br>";
						
						
						echo	"<h4>Leave a comment.Tell others what is your feeling about this product</h4>";
								 
								//input field user an opinion about product
						echo	"<form action='comment.php' method='POST'>
								 <div class='form-group'>
									<label for='exampleFormControlTextarea1'>Share with others what you think about this product</label>
									<textarea class='form-control' id='opinion' name='comment' rows='5'></textarea>
									</br>
									<input type='hidden' name='product_id' value ='$id'>
									<input type='hidden' name='product_type' value ='$type'>
									<button type='submit' class='btn btn-primary' name='productOpinion'>Send your opinion</button>
								  </div>
								</form> 
								</br></br>";
								
						//display div elements with average grade and comments other users. pomiedzy <strong>include plik ratingaverage.php
						echo "<div class='container'>
								<div class='row'>
								  <div class='col-md-5'id='ratingone'>
									<h3> Users' rating:</h3>
								  </div>	
									<div class='col-md-1' id='ratingtwo'>
									<h3><strong>";
									  //wklejam caly kod az do linii echo "</strong></h3>
									  // byla petla w petli zatem w kazdym projekcji wyswietlalo 3x ID i 3x ocena srednia do kazdego producktu_id
									  //w innym wariancie wyswietlalo 1x ROUND(AVG) dla kazdego ID TO SAMO,bo bylo przypisane
									  //w zewnetrzym pliku w zapytaniu SELECT warunek WHERE = id - co ograniczalo elastycznosc petli,kazdemu wklejala ten sam wynik z ID
									  // z zewnetrzengo pliku productrating.php
									  //rozwiazaniem jest wstawic do petli z pliku product.php (aktualny plik) z podpieta petle ale w zapytaniu SELECT do DB 
									  //musi byc okreslony jeden product_ID.dodatkowo mysali_num_rows przypisalem ===1.
									  //WARUNKIEM JEST ze to zapytanie jest w TYM SAMYM PLIKU W PETLI. AUTOMETYCZNIE GENEROWANA PETLA 
									  //z pliku product.php dobiera sobie element z $id = $_POST['product_id'] i dynamicznie odpowiedni wyrzuca wynik 
									  
									  $id = $_POST['product_id'];
									
									//query to DB to COUNT(AVR()) on collected in DB values
									$sql_average = "SELECT product_id,ROUND(AVG(grade),1) AS AverageRating
													FROM rating
													WHERE product_id = $id";
													
									$result_sql_average = mysqli_query($dbc,$sql_average);
									//var_dump($result_sql_average);

									if(mysqli_num_rows($result_sql_average) > 0){
										
											while($row = mysqli_fetch_assoc($result_sql_average)){
												
												//echo "ponizej wynik z ROUND(AVG())</br>";
												
												echo $row['AverageRating'].   "</br>";
												
												//assign result of $row[''AverageRating'] to cookie i display on product.php in place with rating
												//$cookie_rating = $row['AverageRating'];
												//echo "wynik z cookie_rating</br>";
												//var_dump($cookie_rating);
												//setcookie("AverageRating",$cookie_rating,time()+3600);
												
												//header('Location: http://localhost/ecomm/products/product.php');
												
											}// end of while($row = mysqli_fetch_assoc($result_sql_average))
										
									}//end of if(mysqli_num_rows($result_sql_average) > 0)
															  
									  
						echo "</strong></h3>
								   </div>
								</div>
							</div>
							</br>
							<div class='col-md-8' id='ratintoggle'>
                            <h3> Check others' opinion here: hoverover</h3>
							</div>
							<div class='container'>
								<div class='row' id='ratingthree'>
								  <div class='col-md-12'>";
									
									//insert code from ne1.php/testowy plik do lini </div></div></div> //button to come back
								$id = $_POST['product_id'];
								//echo "nizej wyswietli product_id </br>";
								//var_dump($id);
									
									//query to DB to COUNT(AVR()) on collected in DB values
									$sql_comment = "SELECT product_id,comment,user,user_email,date_created
													FROM comment
													WHERE product_id = $id";
																				
													$result_comment = mysqli_query($dbc,$sql_comment);
													//var_dump($result_comment);
													//var_dump($dbc);

												if(mysqli_num_rows($result_comment) > 0){
																	
														while($row = mysqli_fetch_assoc($result_comment)){
																				
														//echo "ponizej wynik z comments</br>";
														//I did table for better displaying
														//table head section
														echo "<table class='table table-striped'>
															  <thead>
																<tr>
																<th scope='col'>Product nr.</th>
																<th scope='col'>Comment</th>
																<th scope='col'> User </th>
																<th scope='col'>Date created</th>
																</tr>
																</thead>";
													// table body section				
													echo	"<tbody>
														 <tr>";
														echo "<td>".$row['product_id']. "</td><td> ". $row['comment']. "</td><td> ".$row['user']. "</td><td>".$row['date_created'].  "</td><td></tr></br>";
										
														}// end of while($row = mysqli_fetch_assoc($result_comment))
												echo "<tbody></table>";//end of table
											
						                        } // end of if(mysqli_num_rows($result_comment) > 0)
									//koniec wklejania
									
							echo	"</div>	
									
								</div>
							</div>";
								 
						//button to come back to products' list
						echo "</br>
						      <div class='container'>
								 <div class='row'>
								   <div class='col-md-2'> 
								   </div>
									<div class='col-md-4' id='backbutton'> 
                                    <a class='btn btn-primary btn-lg' href='http://localhost/ecomm/includes/catalogue3.php' role='button'>Back to product list</a>									
									</div>
									<div class='col-md-2'>
                                    </br>									
								   </div>
								   </div>	
								 </div>
								</div>		 
								 
							   </div>";
							   
							   //here will be recommendation displayed - nope will be displayed in separete div elements below = plain html/bootsrap
						echo  "<div class='col-md-4' id='prodtwo'>";
										
						// closing elements main grit structure stareted at the top
						echo   "</div>
							   </div>
							  </div>";
							  	  	  
						}// end of while($row = mysqli_fetch_assoc($result_sql_info))
							
                }//if(mysqli_num_rows($result_sql_info)>0)	
			
		}//end of if(isset($_POST['id']))
		
	}//if(isset($_POST['moreinfo']))
	
	
	
}//if($_SERVER['REQUEST_METHOD']==='POST')

?>
<!-- ############################# row with recommendations  Customers who bought this item also bought ########################### -->
<div class="container">
  <div class="row">
    	<!-- drugie cookie z petli -->
   <div class="col-md-12">
	  <div id="recomm1">
	      </br>
		  <p>If you like to developing your hobby...</p></br>
	  </div>
<?php
	 // wyswietl tutaj COOKIE z hobbycookie.php
	  if(isset($_COOKIE['travel'])){
		     //$travelpic = $_COOKIE['travel'];
			//var_dump($travelpic);
		    //display image from cookie from wishlist.php
			// you must add conditional and user email which was used to register t odisplay properly cookie here
            echo '<img src = "'.$_COOKIE['travel'].'" width="40%" height="250px"/></p>';
	  }
	   if(isset($_COOKIE['science'])){
		   
	       
			echo '<img src = "'.$_COOKIE['science'].'" width="40%" height="250px"/></p>';
	   }
	    if(isset($_COOKIE['action'])){
	      
		    echo '<img src = "'.$_COOKIE['action'].'" width="40%" height="250px"/></p>';
		 }
		if(isset($_COOKIE['UFO'])){
	      
		    echo '<img src = "'.$_COOKIE['UFO'].'" width="40%" height="250px"/></p>';
		 } 
	  	 
		 
	 
?>  
    </div>
  
  <!-- druga rekomendacja z petli -->
    <div class="col-md-12">
	  <div id="recomm1">
	      </br>
		  <p>Customers who bought this item also bought</p></br>
	  </div>
	  <?php
	  //echo '<p>'.$_COOKIE['CWBT1'].'</p>';
	  // wyswietl tutaj COOKIE z cart.php
	  if(isset($_COOKIE["CWBT2"])){
		  //$image = $_COOKIE["CWBT2"];
		  //echo "WYNIK Z Simage: </br>";
		  //var_dump( $image);
		    //display image from cookie from wishlist.php
            echo '<img src = "'.$_COOKIE["CWBT2"].'" width="40%" height="250px"/></p>';														
	  }else{
	        echo "If only recommended...</br>";
       }
      ?>
    </div>

  </div>
</div>
<!--################################## end of recommendation #######################################################-->
<script>
//################### hide / shode JS function to display other users comments about product
//display hide element div = ratingthree

document.getElementById("ratintoggle").onmouseover = function() {mouseOver()};
document.getElementById("ratintoggle").onmouseout = function() {mouseOut()};


function mouseOver(){
   document.getElementById("ratingthree").style.display = 'block';
   
   //set expires date = 0, which is session,cookie will overwrite and every time send data to PHP and then to DB
   document.cookie = "mo=displayed; expires=0;path=/";
   document.cookie = "mo2=<?php echo $id; ?>; expires=0;path=/";
   
   //below set cookie and expires date of cookie = 180sec, its not good solution,
   //after expires data will display that cookie has no value on pages category1/2/3.
      //var date = new Date();
	  //date.setTime(date.getTime()+ 180*1000);
	  //var expires = "; expires="+date.toGMTString();
      //document.cookie = "mo=displayed; expires=" + date.toGMTString() + ";path=/";
   
}// end of function mouseOver()
function mouseOut(){
   document.getElementById("ratingthree").style.display = 'none';
     
} // end of function mouseOut()

</script>
<?php

     // section where onclick.event JS fires cookie,then PHP capture if isset cookie banner3 and INSERT data to rating_banner
    // #####################  aditional condition if clicked image then insert interested
	if(isset($_COOKIE['banner3'])){
	
	$email= $_SESSION['email'];
	
	$into_banner2 = "INSERT INTO rating_banner(id,displayed,user_email,interested)
				     VALUES('','','$email','interested')";
	//run query
	$result_into_banner2 = mysqli_query($dbc,$into_banner2);
	//echo "RESULTS from INTO_BANNER2 </br>";
	//var_dump($result_into_banner2);
	//var_dump($dbc);
	
	//############################# end of if(isset($_COOKIE['banner3'])) 
	
}else{
	
	echo "<div id='banner3' display:inline;>Speak,write,share your opinions about products.Be opinion-forming</div>";
}

?>
<?php
include'../includes/tracker4.php';
include'../products/recommonmouseover.php';
include'trackonmedia.php';
include'../css/eshop.footer.html';
?>
</body>
</html>