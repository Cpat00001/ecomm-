<?php //hobbycookie.php
//tak user's email check in DB if any hobby assigned and select products related to this hobby.
// then use cookies to send data about users hobby and display products/images where needed/required.
//cookies which display products/images are deleted after close browser - cookie has alive during a user session.	  
//get email value from session from loginCheck.php
	  if(isset($_SESSION['email'])){
	  
	  $email = $_SESSION['email'];
	  echo "WYNIK Z Semail </br>";
	  var_dump($email);
	  
	  //select who hobby has registered user with specific email
	  $sql_hobby = "SELECT hobby 
					FROM users
					WHERE email = '$email'";
	 
		 //run query
		 $result_sql_hobby = mysqli_query($dbc,$sql_hobby);
		 
		  if(mysqli_num_rows($result_sql_hobby)>0){
			  
			  while($row = mysqli_fetch_assoc($result_sql_hobby)){
				  
				  echo "WYNIK Z SQL hobby ";
				  echo $row['hobby'];
				  //assign while loop output to variable,then use this variable to compare in IF statement
				  $hobby = $row['hobby'];
				  
				  //conditional checking and assign to specific groups og hobby.on this will base displaying ads
				  if($hobby === "Hiking" || $hobby === "Traveling"){
						//select and assign category travel
						$sql_travel = "SELECT name,image
								FROM products
								WHERE category = 'travel'
								ORDER BY RAND()
								LIMIT 1";
						$result_sql_travel = mysqli_query($dbc,$sql_travel);
						
						if(mysqli_num_rows($result_sql_travel ) > 0){
						// output data of each row
						  while($row = mysqli_fetch_assoc($result_sql_travel)){
							  
							  echo "WYNIK z travel </br>";
							  echo $row['name']. " " .$row['image']."</br>";
							  //echo "{$row['image']}";
							  
							  //assign variables to  while loop output
							  $travel = $row['image'];
							  
							  setcookie("travel",$travel,0,'/');
							  
						  } // end of  while($row = mysqli_fetch_assoc($result_sql_travel))
						
						}// end of if (mysqli_num_rows($result_sql_travel ) > 0)
						
					}elseif($hobby === "Electronics" || $hobby === "Cars"){
						
						//select and assign to category science-fiction
						$sql_science = "SELECT name,image
										FROM products
										WHERE category = 'technology'
										ORDER BY RAND()
										LIMIT 1";
						$result_sql_science = mysqli_query($dbc,$sql_science);
						
						 if(mysqli_num_rows($result_sql_science) > 0){ 
						 
							// output data of each row
							while($row = mysqli_fetch_assoc($result_sql_science)){
								
								echo "WYNIK z science </br>";
								echo $row['name']. " " .$row['image']."</br>";
								
								//assign variables to  while loop output
								$science = $row['image'];
								echo " WYNIK z Sscience wpisany do cookie </br>";
								var_dump($science);
								
								setcookie("science",$science,0,'/');
								
							} // end of while($row = mysqli_fetch_assoc($result_sql_science))
						 
						 }// end of if(mysqli_num_rows($result_sql_science)
						
						
					}elseif($hobby === "UFO" || $hobby === "Space"){
						 
						 //select and assign to category science-fiction
						$sql_UFO = "SELECT name,image
						            FROM products
									WHERE category = 'science-fiction'
									ORDER BY RAND()
									LIMIT 1";
						
                        $result_sql_UFO = mysqli_query($dbc,$sql_UFO);						
						
						if(mysqli_num_rows($result_sql_UFO) > 0){
							// output data of each row
							while($row = mysqli_fetch_assoc($result_sql_UFO)){
								
								echo "WYNIK z UFO </br>";
									echo $row['name']. " " .$row['image']."</br>";
									
									//assign variables to  while loop output
									$ufo = $row['image'];
									echo " WYNIK z SUFO wpisany do cookie </br>";
									var_dump($ufo);
									
									setcookie("UFO",$ufo,0,'/');
								
								
							}//end of while($row = mysqli_fetch_assoc($result_sql_UFO))
						
						}// end of if(mysqli_num_rows($result_sql_UFO) > 0)
							
					}else{
						
						$sql_action = "SELECT name,image
									  FROM products
									  WHERE category = 'action'
									  ORDER BY RAND()
									  LIMIT 1"; // two categories and RANDOM just to give user high probability to like any sugested product
						$result_sql_action = mysqli_query($dbc,$sql_action);
						
						  if(mysqli_num_rows($result_sql_action) > 0){ 
						  
							//output data of each row
							while($row = mysqli_fetch_assoc($result_sql_action)){
								
								echo "WYNIK z action </br>";
								echo $row['name']. " " .$row['image']."</br>";
								
								//assign variables to  while loop output
								$action = $row['image'];
								
								setcookie("action",$action,0,'/');
								
							} //end of while($row = mysqli_fetch_assoc($result_sql_action)) 
						  
						  } // end of  if(mysqli_num_rows($result_sql_action)
						
						
					}// end of IF($bobby) main IF 
				  
				  
			  
			  }// end of while($row = mysqli_fetch_assoc($result_sql_hobby))
		  
          }// end of if(mysqli_num_rows($result_sql_hobby)		  
			  
	  
	  }// end of if(isset($_SESSION['email'])
	  	  
?>