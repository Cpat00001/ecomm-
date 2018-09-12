<form>
  <div class="form-group">
    <label for="your email">
	<input type="email" class="form-control" id="newsletterForm" aria-describedby="emailHelp" placeholder="Enter you email">
	<small id="emailHelp" class="form-text text-muted"> be informed about our latest deals,discounts and events </small>
  </div>
  <div class="form-check">
			<div class="form-check">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
		  <label class="form-check-label" for="exampleRadios1">
			Books
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
		  <label class="form-check-label" for="exampleRadios2">
			Movies
		  </label>
		</div>
		<div class="form-check disabled">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
		  <label class="form-check-label" for="exampleRadios3">
			VideoGames
		  </label>
        </div>
        <div class="form-check disabled">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
		  <label class="form-check-label" for="exampleRadios3">
			All above
		  </label>
        </div>   		
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
/*

user loguje sie,php sprawdza po emailu co ten user ma w hobby(jesli cos ma)
jesli ma 1 z 3 opcji wtedy przypisuje Cookie i wyswietla dalej odpowiednie reklamy na stronie product.

1 pobierz z SESSION jaki jest email usera - masz juz taka sesje zrobione np eshop.body.php $_SESSION['email']

//bez tego wyszukiwania po emailu i podpiecie prawidlowego cookie nie bedzie efektu unikalnego wyswietlania reklamy na tym samym kompie i przegladarce.
raz zapisany przy rejestracji np travel wyswietli sie takze temu ktory zarejestrowal sie z action.wywali mu travel i action
a powinno tylko action.stad szukanie po unikatowym emailu i nadanie ciasteczek i wtedy ich wyswietlenie isset(cookie['odpowiedni typ'])
2 SQL query SELECT hobby
			FROM users
			WHERE email = "zmienna z vartoscia session" - przypisz session zmienna jakas
3 wynik z SQL query przypisz do zmiennej - powinien byc tylko jeden 1 user 1 kolumna hobby z 1 slowem
4 wynikiem bedzie 1 z 6 slow,ktore sa porzielone na 3 grupy (patrz plik hobbycookie.php) = travel,science,other
5 if wynik == 'travel' wyswietl cookie travel ustowrzone w hobbycookie.php
  elseif wynik === science wyswietl cookie science
  else  wyswietl 3 cookie,przygotowane w hobbycookie.php
6 w punkt 5 musisz wstawic w zrobione juz ciasteczka w hobbycookie.php i wysylac je na podstronach- zadziala mechanizm cookie


// kolejne cookie zrob na stronie logowania z terminem 7dni i if cookie set then display discount 3% 
if not set czyli ktos nie odwiedzla dluzej niz 7dni lub 1raz sie loguje wyswietl inny komunikat











*/


//######################## na bazie hobby rekomendacja z genre travel/action/SFiction ######################*/

//jesli input z registration form jest rowny 1 z 3 gatunkow przypisz category i wyswietlaj rand limit 2
// uzyj if ( travel) / elseif( science-fiction) / else 
// w kazdeym if przypisz categorie zrob SELECT z LIMIT 2
// przypisz do cookie i wyswietl na porzadanej stronie - mysle,ze product.wyglad podobny jak CWBT1
// wklej do checkregistration.php linia 109. wyswietlaj na home.php i product.php


//declare variables
$hobby = $_POST['hobby'];

//assign category to conditional user input
if($bobby == "Hikking" || $hobby == "Traveling"){
	//select and assign category travel
	$sql_travel = "SELECT name,image
	        FROM products
			WHERE category = 'travel'";
	$result_sql_travel = mysqli_query($dbc,$sql_travel);
	
	if(mysqli_num_rows($result_sql_travel ) > 0){
    // output data of each row
	  while($row = mysqli_fetch_assoc($result_sql_travel)){
		  
		  echo "WYNIK z travel </br>";
		  echo $row['name']. " " .$row['image']."</br>";
		  
	  } // end of  while($row = mysqli_fetch_assoc($result_sql_travel))
	
	}// end of if (mysqli_num_rows($result_sql_travel ) > 0)
	
}elseif($hobby == "Electronics" || $hobby == "Cars"){
	
	//select and assign to category science-fiction
	$sql_science = "SELECT name,image
					FROM products
					WHERE category = 'science-fiction'";
	$result_sql_science = mysqli_query($dbc,$sql_science);
	
	 if(mysqli_num_rows($result_sql_science) > 0){ 
	 
		// output data of each row
	    while($row = mysqli_fetch_assoc($result_sql_science)){
			
			echo "WYNIK z science </br>";
		    echo $row['name']. " " .$row['image']."</br>";
			
		} // end of while($row = mysqli_fetch_assoc($result_sql_science))
	 
	 }// end of if(mysqli_num_rows($result_sql_science)
	
	
}else {
	
	$sql_action = "SELECT name,image
				   FROM products
				   WHERE catergory = 'action'";
	$result_sql_action = mysqli_query($dbc,$sql_action);
	
	  if(mysqli_num_rows($result_sql_action) > 0){ 
	  
	    //output data of each row
	    while($row = mysqli_fetch_assoc($result_sql_action)){
			
			echo "WYNIK z action </br>";
		    echo $row['name']. " " .$row['image']."</br>";
			
		} //end of while($row = mysqli_fetch_assoc($result_sql_action)) 
	  
	  } // end of  if(mysqli_num_rows($result_sql_action)
	
	
}// end of IF($bobby) main IF 






//################################## CROSS-SELLIN  bazujacy na GENRE #############################################
//if user searche for word travel , next disply items related to travel.
// rekomendacja bazuje na order_cart tabeli tam ma email i product_id. amazon uzywa ci ktorzy widzeli to widzieli tez tamto
// podobnie moge zrobic na wish_list
// user X dodal X produkt  - pobierz ta informacje
  
   
// wyszukej kto jeszcze kupil- dodal ten produkt 
    /*
	SELECT user_email FROM order_cart
    WHERE product_id =17 LIMIT ???;
	
	*/
	//SELECT user_email WHERE product_id = "wybrany przez usera X" LIMIT 2; - sprawdz czy LIMIT moze byc wiecej niz 1 
	// wynik przypsiz do zmiennej
    /*
	
	SELECT user_email FROM order_cart
	WHERE product_id =17
	AND user_email <> 'baker@gmail.com' - this email jest rowny do osoby wyszukujacej
	LIMIT 1 , 2; lub inny zeby zwiekszyc prawdopodobienstwa ale nei wiem,czy pusci array jesli bedzie kilka osob ??? ; 

    */	
		
// jesli masz kto kupil jeszcze ten sam produkt poszukaj
   // SELECT product_id WHERE user_email = "wynik zmiennej z poprzedniego szukania"
   // powinno wyrzucic ID innych produktow. wybierz RANDOM zeby wyswietlic te produkty dla uzytkownik X  
   /*
   
        SELECT product_id FROM order_cart
		WHERE user_email = 'elakot@gmail.com'
		LIMIT 2;
		
		// dostaniesz liste produktow ktore obok produktow ktore kupil user X zostaly kupione przez user Y
		//przypisz wynik do zmiennej a zmienna przypisz do $_COOKIE[] i wyswietl w pasku poziomym userowi X
	*/

  






//* ###################### ci ktorzy kupili to kupili tez tamto / Customers who bought this item also bought ############################################## */
// Customers who viewed this item also viewed / Customers who bought this item also bought

<!-- ############################# BOOTSRAP RAW AND RECOMENDATION Customers who bought this item also bought ########################### -->
<div class="container">
  <div class="row">
    <div class="col-md">
	  <div style="background-color:orange">
		  <p style="color:white">Customers who bought this item also bought</p></br>
		  <p><?php echo $_COOKIE['CWBT1'];?></p>
	  </div>
	  <?php
	  // wyswietl tutaj COOKIE z cart.php
	  if(isset($_COOKIE["CWBT2"])){
		  //$image = $_COOKIE["CWBT2"];
		  //echo "WYNIK Z Simage: </br>";
		  //var_dump( $image);
		    //display image from cookie from wishlist.php
            echo '<img src = "'.$_COOKIE["CWBT2"].'" width="35%" height="250px"/></p>';														
	  }else{
	        echo "Do you like have what others have??.</br>";
       }
      ?>
    </div>
	<!-- drugie cookie z petli -->
	<div class="col-md">
	  <div style="background-color:orange">
		  <p style="color:white">Customers who bought this item also bought</p></br>
		  <p><?php echo $_COOKIE['CWBT1'];?></p>
	  </div>
	  <?php
	  // wyswietl tutaj COOKIE z cart.php
	  if(isset($_COOKIE["CWBT2"])){
		  //$image = $_COOKIE["CWBT2"];
		  //echo "WYNIK Z Simage: </br>";
		  //var_dump( $image);
		    //display image from cookie from wishlist.php
            echo '<img src = "'.$_COOKIE["CWBT2"].'" width="35%" height="250px"/></p>';														
	  }else{
	        echo "Do you like have what others have??.</br>";
       }
      ?>
    </div>
	
	
	
  </div>
</div>
<!--################################## end of recommendation #######################################################-->

// 1 sprawdz,co ktos kupil
// 2 wybierz kto jeszcze to samo kupil
// sprawdz co jeszcze kupili inni  elakot koszyk id 20 i id 19

// 1 I need select products from DB table products. images,name where category = "searched word category"
// moge zrobic na podstawie jednego produktu. jedna osoba kupila cos kilka razy po 1 produkcie i mozna wyszukac te wlasnie zakupy.
// na bazie kilku pojedynczych wyborow dopasowac wyni ci ktoryz kupil to kupili tez tamto.
// rekomendacje wyswietlac w paskach poziomych - jako mobilna stona jest latwiej scrollowac
//rekomendacja jako algorytm/maszyna myslaca za kogos - sposob wypelniania rozrywki/czyjegos czasu wolnego. - jakby sterowanie ludzmi.




//################################### CROSSELLING ###################################################################

//CROSS - SELLING - do produktu z category np travel przypisuje komplementarny produkt. 
// np wybral ksiazke z travel, wyszukuje mu inny produkt z genre travel np film lub gre. cena nie gra roli, wyszukiwanie moze byc random
// kupil film za £20 podpowie mu gre za £30 lub ksiazke za £10.
// jesli dodam warunek wyzszej ceny wtedy uzyskam mix cross-sellingu i upsellingu.
//dopaswoanie moge zrobic na podstawie product_id ktory jest zarowno w WISH_LIST oraz ORDER_CART.
//order cart bedzie pokazywanie dobr komplementarnych, wish_list przypominanie o kupnie wybranego juz produktu. upominianie by domknac proces sprzedazy

//sugestia dobra kompementarnego na podstawie ORDER_CART, ALE po wcisnieciu button BUY ALL THIS STOCK 
//lub krok dalej po wcisnieciu CONFRIMATION w shippingform.php 
//product wybrany przez usera do ORDER_CART a nastepnie clicked CONFIRMATION button
// past code below into checkshipping.php


<?php
//jesli forma z shippingfrom.php jest submited 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	//check if button CONFIRMATION was clicked if yes then select chosen product by user_session_id
			 if(isset($_POST['confirmation'])){
			 //assign session to variable
             if(isset($_SESSION['user_session_id'])){			 
		     $usid = $_SESSION['user_session_id'];
			 var_dump($usid);
			 
			 // select data  from table order_cart && product. then display as order_cart content into table for a user,to show what has been chosen	  
		    $q_cartcontent = "SELECT products.name,order_cart.product_id,order_cart.quantity,products.price
			                  FROM order_cart
							  INNER JOIN products ON products.id = order_cart.product_id
							  WHERE user_session_id = $usid";
			
				$result_q = mysqli_query($dbc,$q_cartcontent);
				
				if(mysqli_num_rows($result_q)>0){
					
					//output data row
					while($row = mysqli_fetch_array($result_q,MYSQLI_ASSOC)){
						
						echo " product_id: ".$row['product_id'] ."</br>";
						
						//przypsiz product_id do zmiennej
						$product_id = $row['product_id'];
						echo "wartosc product_id: </br>";
						var_dump($product_id);
						
						//jesli ma produkt_id szukam SQL INNER JOIN or LEFT JOIN all product FORM category where product_id = "category"
						
						
					}// end of 	while($row = mysqli_fetch_array($result_q,MYSQLI_ASSOC))
						
				}// end of if(mysqli_num_rows($result_q)>0)
					
			 } // end of if(isset($_SESSION['user_session_id']))
			 
		     } // end of  if(isset($_POST['confirmation']))
	
}// end of if($_SERVER["REQUEST_METHOD"]=="POST")
?>


// 1 potrzebuje product_id
// product_id jest wybrany z BD i podny jaki wynik w tabeli order_cart.zatem numer miamlbym 
// 2 jesli ma produkt_id szukam SQL INNER JOIN or LEFT JOIN all product FORM category where product_id = "category"
// 3 jesli wybiera mi produkty z category, wtedy RANDOM FROM category LIMIT 1 lub 2 dla bajeru moglby wstawic w caruzele. 








//######################################## REKOMENDACJE UPSELL ##############################################################

// KOD DO WYBIERANIA REKOMENDACJI UPSELL - do wybranego produkty przypisuje ten sam typ np ksiazka/film ale z WYZSZA CENA
//if user adds any product to wishlist put this info to COOKIE
//display this cookie on moinwebpage before login
//but reccomend other product from the same genre.

// PRODUCT_ID wybrany przez usera do wishlist
$id = $_POST['product_id'];
		$idint = (int)$id;
//product_type np 'book' wybrany przez usera. np lubi ksiazki podpowiedz mu ksiazke,ale drozsza		
$type = $_POST['product_type'];

//zapytanie do DB wybor innych towarow z tego samego typu ale inne ID

$sql1 = SELECT name,image FROM products WHERE product_type = $type AND product_id <> $id LIMIT = 1;
var_dump($sql1);

//run a query
$result_sql1 = mysqli_query($dbc,$sql1);

		//
		if(mysqli_num_rows($result_sql1) > 0){
										
							while($row = mysqli_fetch_assoc($result_sql1)){
								
								echo "{$row['image'] }";
								
								//assign output of loop to $variable and then $variable to COOKIE
								$cookie = $row['image'];
								
								setcookie = ("UPSELL", $cookie,time()+3600);
								
								
							}// end of while($row = mysqli_fetch_assoc($result_sql1))
		}//end of if(mysqli_num_rows($result_sql1)



/*
if( product ID add to wishlist){
	
	then $sql = "SELECT RANDOM FROM the same genre BUT NOT product id = do wybranego product_id w if LIMIT = 1" 
	
	pusc petla wynik z DB powinny byc 2 inne produkty
	przypsiz wynik do variable 
	przypisz variable do COOKIE - setcookie
}
*/



?>




<?php //new1.php
if(isset($_COOKIE['product_id'])){
			$product_id = $_COOKIE["product_id"];}
		//$product_id = $_COOKIE["product_id"];
		var_dump($product_id);
            
			//query to DB to COUNT(AVR()) on collected in DB values
			$sql_average = "SELECT product_id,ROUND(AVG(grade),1) AS AverageRating
							FROM rating
							GROUP BY product_id";
							
			$result_sql_average = mysqli_query($dbc,$sql_average);
			var_dump($result_sql_average);

foreach ($id as $id => $rating ){
     $sql_average = "SELECT product_id,ROUND(AVG(grade),1) AS AverageRating
							FROM rating
							GROUP BY product_id";
				 while ($row = mysql_fetch_assoc($sql_average)) {
                 echo $row['AverageRating'];

                }
}

?>
<?php

$id = $_POST['product_id'];
									
		//query to DB to COUNT(AVR()) on collected in DB values
		$sql_comment = "SELECT product_id,comment,data_created
						FROM comment
						WHERE product_id = $id";
													
						$result_comment = mysqli_query($dbc,$sql_comment);
						var_dump($result_comment);

						if(mysqli_num_rows($result_comment) > 0){
										
							while($row = mysqli_fetch_assoc($result_comment)){
													
							//echo "ponizej wynik z comments</br>";
													
							echo "id: ".$row['product_id']. " ". $row['comment']. "" .$row['data_created'].  "</br>";
							
							}// end of while($row = mysqli_fetch_assoc($result_comment))
						} // end of if(mysqli_num_rows($result_comment) > 0)	


?>