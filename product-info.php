<!DOCTYPE html>
<?php
	session_start(); //starts the session

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste');

	//if user is not logged in, automatically redirects in the index page
	if (!isset($_SESSION['u_email'])) {

		header("location: index.php");
	}

	//$trans_sql = mysqli_query($conn,"SELECT * FROM transaction");
	//$trans_row = mysqli_fetch_assoc($trans_sql);
    
    $total_price = 0;
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Iloilo Fleuriste</title>
	<link rel="icon" href="img/zaira.jpg">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<script src="js/mdb.min.js"></script>
	<script src="js/bootstrap.min.js""></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
</head>
<body>
	 <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
	 	<a class="navbar-brand" href="#"><img src="img/zaira.jpg" height="30" width="30"></a>
    	<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbar">
    		<ul class="navbar-nav mr-auto">
    			<li class="nav-item">
    				<a class="nav-link text-white" href="user_dashboard.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
    			</li>
    		</ul>
    	</div>
    </nav><br><br><br>
    <div class="container">
    	<div class="page-header">
    		<h3>Product Information</h3>
    	</div>
    	<div class="container-fluid well span6">
    		<hr>
    		<?php
    			$prod_id = $_GET['prod_id'];
    			$prod_sql = mysqli_query($conn, "SELECT * FROM products WHERE ProductID = '$prod_id'");
    			$prod_row = mysqli_fetch_assoc($prod_sql);
    		?>
    		<div class="row">
    			<div class="span2">
    				<h4>Product Image</h4>
    				<img height="350px" width="300px" src="<?php echo $prod_row['ProductImage']; ?>">
    			</div>
    			<div class="span8 mt-5 ml-5">
    				<h3 class="ml-5">Product Name: <?php echo $prod_row['ProductName']; ?></h3>
    				<h3 class="mt-5 ml-5">Product Price: <?php echo number_format($prod_row['ProductPrice'], '2'); ?></h3>
    				<form class="mt-5 ml-5" method="post">
    					<input class="form-control" type="number" min="0" name="prod_quantity">
    					<button type="submit" class="mt-5 btn btn-info" name="add_to_cart"><span class="fa fa-shopping-cart"></span> Add to Cart</button>
    				</form>
    				<h3 class="mt-5 ml-5">Total Price: <?php echo  $total_price; ?> </h3>
    			</div>
    		</div>
    	</div>
    </div>
    <?php

    	if (isset($_POST['add_to_cart'])) {
			
    		$prod_quantity = mysqli_real_escape_string($conn, $_POST['prod_quantity']);
    		$total_price = $prod_row['ProductPrice'] * $prod_quantity;
    		$prod_id = $prod_row['ProductID'];
    		$prod_price = $prod_row['ProductPrice'];
    		$user_id = $_SESSION['u_id'];

    		$insert_trans = "INSERT INTO transaction(ProductID, UsersID, TransPrice, TransQuantity, TransTotal)
    		VALUES('$prod_id', '$user_id', '$prod_price', '$prod_quantity', '$total_price')";

    		if (mysqli_query($conn, $insert_trans)) {

    			echo "<script>
    				alert('Added to cart sucessfully');
    			</script>
    			<meta http-equiv='refresh' content='0; url=product-info.php'>";
    		
    		} else {
    			echo "<script>
    				alert('Failuire in adding');
    			</script>";
    		}
    	}
    ?>
</body>
</html>