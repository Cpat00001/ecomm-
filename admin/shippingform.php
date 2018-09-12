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
<div id="ship1">
<h3>You are now in shipping section</h3>
<div id="ship2">
<h4>Please fill in all fields, which are required to successful shippment</h4></br>
<h4>Add payment details to proceed with shipment</h4>
</div>
<div id="ship3">
	<form method= "POST" action = "checkshipping.php">
	  <div class="alert alert-info">
		  <h3><strong>Delivery section</strong><h3>
		 </div>
	  <div class="row">
		<div class="col-md-6">
		  <input type="text" id="ship4" value="<?php echo ($_SESSION['email']); ?>" class="form-control"  name="email">
		  </br>
		</div>
		<div class="col-md-6">
		  <input type="text" class="form-control" placeholder="country" name="country">
		  </br>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-6">
		  <input type="text" class="form-control" placeholder="city" name="city">
		  </br>
		</div>
		<div class="col-md-6">
		  <input type="text" class="form-control" placeholder="postcode" name= "postcode">
		  </br>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-8">
		  <input type="text" class="form-control" placeholder="street" name="street">
		  </br>
		</div>
		<div class="col-md-3">
		  <input type="text" class="form-control" placeholder="House number" name="house_number">
		  </br>
		</div>
	  </div>
	  <div><!-- removed here class="row"-->
		<div class="col-md-5">
		<label for="delivery_time">Select delivery time</label>
		<select class="form-control" id="delivery_time" name="delivery_time">
		 <option> Morning 8-12 </option>
		 <option> Afternoon 12-18</option>
		 <option> Evening 18-21 </option>
		</select> 
		  <!--<input type="text" class="form-control" placeholder="delivery time">-->
		  </br>
		</div>
		</br>
		</br></br></br>
		 <div class="alert alert-info" >
		  <h3><strong>Payment section</strong></h3>
		 </div>
		<div class="col-md-5">
		  <!--<input type="text" class="form-control" placeholder="payment option">-->
		  <label for="payment_option"> Payment option</label>
		    <select class="form-control" id="payment_option" name="payment_option">
			  <option> Debit card </option>
			  <option> Credit card </option>
			  <option> Bank Transfer </option>
		</select> 
		  </br>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-5">
		  <input type="text" class="form-control" placeholder="card number" name="card_number">
		  </br>
		</div>
		<div class="col-md-5">
		  <input type="text" class="form-control" placeholder="sort code" name="sort_code">
		  </br>
		</div>
	  </div>
	  
	  <input type="submit" class="btn btn-success btn-lg" value="Confirmation" name="confirmation">
	  </form>
	  
	
</div>
</div>

<?php
include'../css/eshop.footer.html';
?>
</body>
</html>