<?php // tracker2.php - file counts how many times a page has been viewed. can provide stats about the most popular subwebsite

// na stronach gdzie jest juz polaczenie z DB include this file without connection, if the product's subwebsite is not connected
//then uncomment line below include 'mysql.inc.php' 
//include 'mysql.inc.php'; 

 //set a variables
 $page = $_SERVER['PHP_SELF'];
 $user_ip = $_SERVER['REMOTE_ADDR'];
 $access_time = date("Y-m-d H:i:s");
 $email = $_SESSION['email'];
 
 //insert values to table tracker2
 $sql = "INSERT INTO tracker2(id,page,session_id,user_ip,access_time,email)
        VALUES('','$page','','$user_ip','$access_time','$email')";
	
	// run a query against a DB
	$run_query =  mysqli_query($dbc,$sql);
	
	//this query checks(count) how many rows are assigned to PHP_SELF page.
    $query2 = "SELECT count(id) FROM tracker2 WHERE page = '$page'";
	//var_dump($query2);
	
	// run a query against a DB and display sum of rows from table where page = PHP_SELF // czyli strona gdzie dodalem ten plik z kodem
	// include this file with code to every subwebsite with products, then you know which one is the most visited/viewed/popular
	if($run_query2 =  mysqli_query($dbc,$query2)){
		$views = mysqli_fetch_row($run_query2);
		//var_dump($run_query2);
		
		//display this message in div element is you want or just keep it hidden only for stats and recommendation engine
		echo "this website has been seen ". $views[0]. " times... ";
		
		//echo "a to jest wynik z var_dump";
		//var_dump($views);
		
	}else{
		
		echo "it's not working $run_query2 z pliku tracker2.php";
	}
	
?>
