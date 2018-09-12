<?php //baseratingbanner.php
// I blocked a session line below,already is started in catalogue2.php - no need to repeat it,but kepp if include baseratingbanner to file without DB connection 
//session_start();
//jesli podepniesz ten plik do innego majacego juz polaczenie z DB zablokuj linie ponizej,inaczej bedzie blad = double connection with DB
//include'../includes/mysql.inc.php';
// this file does: if SB rated product_id 4 or above, 
//then check if this person is logedin again
//and display div banner onload event with thematically related.
//on the banner SB need to scroll-down to get whole valueable message - measure it scrolldown.event
//at the bottom is input field - email on tickets for event- movie related to book etc for 2people/couple
// you can measure ration displayed/to registered on event with "great price"
//you can measure two JavaScript events onload and scroll down//market site: you know who watech banner,and how reacted on it
//madditionaly you can increase sale and display related content,increase awereness of user about events.
/*

3 sprawdz id,type produktu i kategorie
4 wyswietl mu inne type produktu,ale z tej samej kategorii
*/
//step 1 select who is logined in
$email = $_SESSION['email'];
//if(isset($_SESSION['email'])){ $email = $_SESSION['email'];}
var_dump($email);

//step 2 check what product_id,product_type,category this user commented (if any above 4,means like it) 
//and if there are >= 4 (Greater than or equal to)

$sql_above4  = "SELECT product_id,product_type,category 
                FROM rating
				WHERE USER_EMAIL = '$email'
				AND grade >= 4
				AND product_type = 'movie'";
//run query
$result_sql_above4 = mysqli_query($dbc,$sql_above4);

//check results
if(mysqli_num_rows($result_sql_above4)>0){
	
		while($row = mysqli_fetch_array($result_sql_above4,MYSQLI_ASSOC)){
			
			//echo "</br> RESULT FROM while loop</br> ";
			//echo "product_id: ".$row['product_id']. " product_type: ".$row['product_type']. " product_category: " .$row['category'];
			
			//assign result to variables
			$category = $row['category'];
			$_SESSION['category'] = $category;
			$type = $row['product_type'];
			//echo "</br>results form assigned variables</br>";
			//var_dump($category);
			//var_dump($type);
		
		}// end of while($row = mysqli_fetch_array($result_sql_above4,MYSQLI_ASSOC))
		
			//###################### pocatek przeklejonego kodu ############################
			// select items related to action what logged in user rated
			// and choose complementary goods related to the same category ( in this case more engangind than movies >> games)
			// code below will select all games related to rated by loggedin user category/genre - 
			//purpose increase SALE basing on user's taste 
			
			//if($type = 'movie' && $category = 'action'){
				if(($type = 'movie') && ($category = $_SESSION['category'])){
				
				//select product form type: game and category : action related to movies. SB likes action.
				$sql_realted = "SELECT id,name,image
								FROM products
								WHERE type = 'game'
								AND category = '$category'";
				
				//echo "PODAJ KATEGORIE </br>";
				//var_dump($category);
				//run query				
				$result_sql_realted = mysqli_query($dbc,$sql_realted);
				
					//check results
					if(mysqli_num_rows($result_sql_realted)>0){

                      while($row = mysqli_fetch_array($result_sql_realted,MYSQLI_ASSOC)){
						  
						  //echo "</br>RESULT for related to game and category = $category</br>";
						  //echo "product_id from action : ".$row['id']. " product_name : ".$row['name'];
						  //echo "product_image: ".$row['image'];
						 
                        //assign reults of while loop to variables and after you can pass to html div element
						// jesli chesz podac te dane w innym pliku INCLUDE plik na poczatku wiekszego pliku przed any html element or blank space
						//in other case you will get an error - header already sent
						$product_id = $row['id'];
						$product_name = $row['name'];
						$product_image = $row['image'];
						//echo "wynik z petli while,wynik zalezny od RATINGU USERA</br>";
						//var_dump($product_image);
						//var_dump($product_id);
						
						//#########################################################################################################
						//here I created a scenario IF user rated movie above 4, then display an AD/recommendation with a game
						
							echo '<div class="alert alert-success" id="ratingbanner">
							  <strong>Check our offers...</strong>';
							echo '<p> This time we suggest : '.$row['name'].'</p>';
							echo '</br></br>
							  <a href="http://localhost/ecomm/products/product.php" class="btn btn-info" role="button" id="bannerbutt" onclick="aa()"><img src="'.$row['image'].'" alt="products_votes" id="image1" style="width:100%;height:250px";></a>
							  </br></br>
							  <p>Extend your experience.</br>Collect products from category you like</br>Create unforgetable moments</p>
							  </br>
							  <button type= "button" class="btn btn-info" id="bannerbutton">No, thank you</button>
							</div>';
					    
						//########## end of div element displaying personalised banner with game #############################
						
						
						
						 
					  }// end of while($row = mysqli_fetch_array($result_sql_realted,MYSQLI_ASSOC))  
					
					
					}// end of if(mysqli_num_rows($result_sql_realted)>0)
				
				
			}// end of if($type = 'movie' && $category = $_SESSION['category'])
				
			//###################### koniec przeklejonego kodu ############################
			
}else{
	
	 //#########################################################################################################
	//here I created a scenario IF user hasnt rated any movie above 4, then display banner to enhance to rate products:image products_votes.jpg
	
	echo "<div class='alert alert-success' id='ratingbanner'>
	  <strong>Create a community of active shoppers.Decide about products</strong>
	  </br></br>
	  <img src='../images/products_votes.jpg' alt='products_votes' id='image1' style='width:70%;height:250px';>
	  </br></br>
	  <p>Feel free to rate our products.</br>Let others know what you think, </br> what is your experience.</p>
	  </br>
	  <button type= 'button' class='btn btn-info' id='bannerbutton'>OK,next time</button>
	</div>";
	//########## end of else IF statement to display other text if not rated products #############################
	
	
	
}// end of if(mysqli_num_rows($result_sql_above4)>1)
					
?>

