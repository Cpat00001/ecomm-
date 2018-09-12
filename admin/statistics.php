<?php //statistics.php 
//this file data retrived from DB and can be treat as a global stats hub,where you can see all stats parameters
// how many users login, how many times any website has been viewed etc

include '../includes/mysql.inc.php';

echo "<h2>This site can be a central statistics HUB - like google analitics.</h2>
          <h3>data in tables, meaningful numbers</h3>";

//select all email adresses viewed catalogue1.php
$sql = "SELECT email FROM tracker2 WHERE page = '/ecomm/includes/catalogue1.php' GROUP BY email";
//var_dump($sql);
echo "</br></br>";

$query = mysqli_query($dbc,$sql);
//var_dump($query);

echo "<table border='1'>
<tr>
<th>Catalogue1.php visitors</th>
</tr>";

while($row = mysqli_fetch_row($query)){
	
echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "</tr>";
	}
	echo "</table>";	
	
	//echo "Viewers who has seen catalogue1.php - books/comics ";
	//echo $row[0]."</br>";
//}

//select all email adresses viewed catalogue2.php - movies
$sql = "SELECT email FROM tracker2 WHERE page = '/ecomm/includes/catalogue2.php' GROUP BY email";
//var_dump($sql);
echo "</br></br>";

$query = mysqli_query($dbc,$sql);
//var_dump($query);

echo "<table border='1'>
<thead>
<tr>
<th>Catalogue2.php visitors</th>
</tr>";

while($row = mysqli_fetch_row($query)){
	
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "</tr>";
	}
	echo "</table>";
	
	
	//echo "Viewers who has seen catalogue2.php - movies ";
	//echo $row[0]."</br>";
//}


?>
