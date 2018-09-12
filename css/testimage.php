<html>
<head>
<title>PHP & MySQL: Upload an image</title>
</head>
<body>
<form action="testimage.php" method="POST" enctype="multipart/form-data">
File: <input type="file" name="image" /><input type="submit" value="Upload" />
</form>

<?php
$czas = "time";
//setcookie('CZAS',$czas,0,'/');
include '../includes/mysql.inc.php';
if(!isset($_FILES['image']))
{
echo 'Please select an image.';
}
else {
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
echo $_FILES['image']['tmp_name'];
$image_name = addslashes($_FILES['image']['name']);
$image_size = getimagesize($_FILES['image']['tmp_name']);

if($image_size==FALSE){
echo "That's not an image.";
} else {
if(!$insert = mysqli_query($dbc,"INSERT INTO products VALUES ('','Forgotten','science-fiction','blablabla','$image','13',8,NOW())"))
     {
 echo "Problem uploading image.";
 } else {
  //$lastid = mysql_insert_id();
  //echo "Image uploaded.<p />Your image:<p /><img src=get.php?id=$lastid>";
  }
}

  }
?>
</body>
</html>