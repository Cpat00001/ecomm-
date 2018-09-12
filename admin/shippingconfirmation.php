<?php
session_start();
?>
<! DOCTYPE html>
<head>
<!-- set all required fields in heade section-->
<title> Shipping cart/form</title>
<meta charset = "UTF-8">
<meta name="keywords" content="shipping cart eMediaShop">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.eshop.css">
</head>
<body>
<?php
include'../includes/mysql.inc.php';
include'../css/eshop.header.php';
?>
<div id="confirm1">
<h4>Thank you for shopping. We have received your order and payment.</h4>
<h4>We will send you your stock as soon as possible.Thank you.</h4>
</div>


<?php
include'../css/eshop.footer.html';
?>
</body>
</html>