<?php //productratingtest.php

foreach ($storeids as $storeid) {
  $result = mysql_query("SELECT AVG(rating) AS rating FROM reviews GROUP BY store_id WHERE store_id = '$storeid'");
  while ($row = mysql_fetch_assoc($result)) {
    echo $row['rating'];
  }
}

foreach ($row as $id => $rating ){
     echo '{$key} => {$value}';

}

?>