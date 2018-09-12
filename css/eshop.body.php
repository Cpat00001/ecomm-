<?php
include'../includes/mysql.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- button -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.eshop.css">

</head>
<body>
<?php
//include file tracker3.php - created separately can't be in the same table where catalogue1/2/3 are, because it were the most viewed page
// then link would be lead to eshop.body.php not any catalogue1/2/3 with viewed products
include 'tracker3.php';
?>
<div class ="container">
  <div class= "row">
    <div class="col-md-3">
	</div>
	<div class="col-md-12">
	  <!-- social media sharing form - send to sharingmedia.php-->
									<!--Facebook-->
									  <div class="inline">
									  <form action='../products/sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='socialmedia' value='facebook'>
									  <button type='submit' class='fa fa-facebook' name='sharesocial'></button>
									  </form>
									  </div>
									  
									  <!--Twitter-->
									  <div id="incline">
									  <form action='../products/sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='socialmedia' value='twitter'>
									  <button type='submit' class='fa fa-twitter' name='sharesocial'></button>
									  </form>
									  </div>
									  
									  <!--Google +-->
									  <div id="incline">
									  <form action='../products/sharingmedia.php' method='POST'>
									  <input type='hidden' name='product_id' value ='$id'>
									  <input type='hidden' name='product_type' value ='$type'>
									  <input type='hidden' name='socialmedia' value='G+'>
									  <button type='submit' class='fa fa-google' name='sharesocial'></button>
									  </form>
									  </div>
									  
	</div>
	<div class="col-md-3">
	</div>
  </div>
</div>
</br>
<div class="container">
<div class="row">
  <div class="col-md-12" id="onebody">
    <h4>Labels, offers, most viewed</h4>
	  <div class="col-md-4" id="twobody">
	    <h4 id="hcolor">Your profil:</h4>
		<?php
		// echo values from session (user name from DB) a time of login from time()
			echo "<h4>Good to see you again ".$_SESSION['user']."</h4>";
			echo "<p>You have started your deals'hunting at: " . $_SESSION['time']."</p>";
			echo "<p>Your contact email is <span class='glyphicon glyphicon-envelope'></span> : ".$_SESSION['email']."</p>";
			echo "your SESSION NR: ".$_SESSION['user_session_id']."</p>";
		?>
	  </div>
	  <div class="col-md-4" id="threebody">
		<?php
		//display here COOKIE z sales.php - recommendation bases on last bought product by user
			 if(isset($_COOKIE["UPSELL1"])){
				 $recom_name = $_COOKIE['UPSELL1'];
				 //echo "WYNIK Z Srecom_name</br>";
				 //var_dump( $recom_name);
				 echo "<p>cross-selling marketing technic</p>";
				 echo "<h4 style='color:orange'>Base on your last purchase, we warmly recommend you: " .$recom_name."</h4>";
				 
			 $recom_image = $_COOKIE['UPSELL2'];
			 echo '<img src = "'.$recom_image.'" width="100%" height="200px"/></p>';
			 //echo "WYNIK Z Srecom_image</br>";
			 //var_dump($recom_image);
				 
			 }// endo of  if(isset($_COOKIE["ran1"]))
		
		?>
		<?php
	  // wyswietl tutaj COOKIE z wishlist
	  /*if(isset($_COOKIE["UPSELL"])){
		  $image = $_COOKIE["UPSELL"];
		  //echo "WYNIK Z Simage: </br>";
		  //var_dump( $image);
		    //display image from cookie from wishlist.php
            echo '<img src = "'.$image.'" width="100%" height="250px"/></p>';
			echo "others you may like";														
	  }else{
	        echo "At the moment you dont have any wishes.</br>";
       }*/
      ?>	
	  </div>
	  
	  <div class="col-md-4" id="fourbody">
	    <h4 id="hcolor">Most viewed category</h4>
		<?php
		  //SELECT dynamically changed the most viewed category from among catalogue 1 /2/ 3 and display as a sugestion/recomendation to users.
          // IF others viewed this means must be interesting,isn't it? modulate traffic on website,
          //display AD on main page and measure onclick event and convertion displayed/clicked
		  
          // this query lets dynamically selected pages according to the amount of views and change the most viewed - LIMIT 1
            $sql_viewed = "SELECT page, COUNT(*)
						   FROM tracker2
						   GROUP BY page
						   ORDER BY COUNT(*)
						   DESC
						   LIMIT 1";
            //run query
			$result_sql_viewed = mysqli_query($dbc,$sql_viewed);
            //var_dump($dbc);
            //var_dump($result_sql_viewed);	

            if(mysqli_num_rows($result_sql_viewed) > 0){
				
				while($row = mysqli_fetch_assoc($result_sql_viewed)){
					//echo "WYNIK Z while Srow assoc</br>";
					//echo  $row['page'];
					
					// assign result from while loop to variable and display picture
					 $most_viewed =  $row['page'];
					 //var_dump($most_viewed);
					 
				}// end of while($row = mysqli_fetch_assoc($result_sql_viewed))
					
			}//end of if(mysqli_num_rows($result)			
		?>
	    <!-- ############ add on image below onclick event which call function clickImage() function is on the bottom of code befroe </body>############ --> 
		<a href="<?php echo $most_viewed; ?> "><img src="../images/mostwanted.jpg" alt="Most wanted category" id="image1" style="width:100%;height:200px";></a>
	  
	  <script>
		//function assigned to element "image1" which is image with link to the most viewed category
		document.getElementById('image1').onclick = function(){
			
			//function set cookies and existing time for cookies only 1minut,which is necessary for proper collecting data.
			//every reload page would generate value of cookie
			function createCookie(name,value,minutes) {
			if (minutes) {
				var date = new Date();
				date.setTime(date.getTime()+(minutes*5*1000));
				var expires = "; expires="+date.toGMTString();
			} else {
				var expires = "";
			}
			document.cookie = name+"="+value+expires+"; path=/";
		}// end of function createCookie

		createCookie("ctr1","clicked",1)
		alert('clicked');
		} //end of .onclick function()

	  </script>
		<!-- ### copied from image link, just as a spare for a test purpose ## how dynamically php generate links  ###-->	  
	  <!--## <?php echo $most_viewed; ?> ##-->
	  </div>
  </div>
  </div>
  <div class="row" id="bodypicture">
   <div class="col-md-12">
        <div class="col-md-4" id="bodypic1">
		  <div class="thumbnail">
		   <a href="http://localhost/ecomm/includes/catalogue1.php">
		    <img src="../images/film_music_books.jpg" alt="eMediaShop.books.movies.games" style="width:100%;height:350px">
			</a>
		     <div class="caption">
		      <h3> Books</h3>
		     </div>
		   </a>
		 </div>  
		</div>
		<div class="col-md-4" id="bodypic2">
		  <div class="thumbnail">
		    <a href="http://localhost/ecomm/includes/catalogue3.php">
			<img src="../images/videogames.jpg" alt="eMediaShop.games.movies.books" style="width:100%;height:350px">
			</a>
			  <div class="caption">
			    <h3> Games</h3>
			  </div>
		  </div>	
		</div>
		<div class="col-md-4" >
		  <div class="thumbnail" id="bodypic3">
           <a href="http://localhost/ecomm/includes/catalogue2.php">		  
		   <img src="../images/mainmovies.jpg" alt="eMediaShop movies.cinema." style="width:100%;height:350px">
		   </a>
		     <div class="caption">
			   <h3> Movies</h3>
			 </div>
		  </div> 
		</div>
	</div>	
  </div>
</div>
<?php
include'../products/mostviewed_id.php';
include'../products/ratingbannerrecomm.php';
include'../admin/survey.php';
?>
</body>
</html>