<?php // cookieOftenVisitor.php
//include to home.php - remembers commingBackVisitor.
//displays info about 3%discount on books for often visitors


if(isset($_COOKIE['Often'])){
	
	echo '<h4 style="color:rgb(232,121,25);">'.$_COOKIE['Often'].'</h4>';
	echo '<img src="../images/Deals.png" width="100%" height="165px"/>';
	
}else{
	
	echo '<h4 style="color:rgb(55,188,229)">For frequent visistor we offer great discounts.'; 
	echo '<img src="../images/Deals2.png" width="100%" height="170px"/>';
	echo '<h4 style="color:rgb(55,188,229)">Visit us more often to check our offers!</h4>';
	
}// end of if(isset($_COOKIE['Often']))

?>