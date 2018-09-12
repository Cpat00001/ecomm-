<?php // SBrecommends.php
  
//search for SB who bought as well a product_id which current user is buying
				  $sql_emails = " SELECT user_email
				  FROM order_cart
				  WHERE product_id = '$idint' AND user_email <> '$email' ";
		
					//run a query
					$result_sql_email = mysqli_query($dbc,$sql_emails);
					echo " WYNIK result_sql_email";
					var_dump($result_sql_email);
					//var_dump($dbc);
					
					 if(mysqli_num_rows($result_sql_email)>0){
						 
						 while($row = mysqli_fetch_assoc($result_sql_email)){
						 
						 //returns list of users' email who bought the same product_id
                         echo "WYNIK z petli WHILE Srow user_email </br>";						 
						 echo  $row['user_email']. "</br>";
						 
						 //assign output to variable
						 $foundusers = $row['user_email'];
						 echo "WYNIK Z $foundusers"
						 var_dump($foundusers);
						    
							 //########################### select what had bought people who bought the same product_id as current user
							 $sql_ids = "SELECT product_id
							             FROM order_cart
										 WHERE user_email = '$foundusers'";
										 AND product_id <> '$idint'";
								
								//run query
								$result_sql_ids = mysqli_query($dbc,$sql_ids);
								var_dump($sql_ids);
								echo "WYNIK z Sresult_sql_ids </br>";
								var_dump($result_sql_ids);
								
								  
								    if(mysqli_num_rows($result_sql_ids)>0){ 
									
									  while($row = mysqli_fetch_assoc($result_sql_ids)){
										  
										  //returns list of products' IDs who bought other users - which bought current user ID product as well
										 echo "WYNIK z petli WHILE Srow user_IDs </br>";						 
										 echo  $row['product_id']. "</br>";
										 
										 //################# if you have product_IDs find their images and names
										 
										    //asign output value to variable and put into DB query
											 $productids = $row['product_id'];
											 
											   $sql_images = "SELECT name,image
															  FROM products
															  WHERE id = '$productids'";
												
												//run query
												$result_sql_images = mysqli_query($dbc,$sql_images);
												echo "WYNIK sql_images";
												var_dump($result_sql_images);
												
												  if(mysqli_num_rows($result_sql_images)>0){

													while($row = mysqli_fetch_assoc($result_sql_images)){
														
														echo "WYNIK Z PETLI name,image </br>";
														echo $row['name']. " ".$row['image']."</p>";

                                                        //assign output of loop while to variable and COOKIE
                                                        $final_name = $row['name'];
                                                        $final_image = $row['image'];
                                                        
                                                        //set COOKIE
                                                        setcookie("CWBT1",$final_name, time()+3600,'/' );
                                                        setcookie("CWBT2",$final_image, time()+3600,'/');														
													
													} // end of while($row = mysqli_fetch_assoc($result_sql_images))  											  
												  
												  }// end of if(mysqli_num_rows($result_sql_images)>0)
										 
										 //########################## assign output to variable and COOKIE
										 
										 
										  	  
									  } // end of  while($row = mysqli_fetch_assoc($result_sql_email))  
									
									
									} //end of if(mysqli_num_rows($result_sql_email)>0)
							 
							 
						 
						 } // end of while($row = mysqli_fetch_assoc($result_sql_email))
						 
					 } //end of if(mysqli_num_rows($result_sql_email)



?>




















