<!DOCTYPE html>
<?php
	session_start(); //starts the session

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste');
	$name = $_SESSION['u_name']; //define session name

	//if user is not logged in, automatically redirects in the index page
	if (!isset($_SESSION['u_email'])) {
		header("location: index.php");
	}

	$checkout = $_GET['checkout'];
	$checkout_sql = mysqli_query($conn, "SELECT * FROM users WHERE UsersID = '$checkout'");
	$checkout_row = mysqli_fetch_assoc($checkout_sql);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Flower Chimp</title>
	<link rel="icon" href="img/zaira.jpg">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<script src="js/mdb.min.js"></script>
	<script src="js/bootstrap.min.js""></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand navbar-dark bg-danger fixed-top">
	 	<a class="navbar-brand" href="#"><img src="img/zaira.jpg" height="30" width="30"></a>
    	<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbar">
    		<ul class="navbar-nav mr-auto">
    			<li class="nav-item">
    				<a class="nav-link text-white" href="admin_dashboard.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
    			</li>
    		</ul>
    	</div>
    </nav><br><br><br>
    <div class="container">
    	<div class="page-header">
    		<h1 class="text-center"><span class="fa fa-info-circle"></span> Checkout Information Details</h1>
    		<hr>
    		<h4>List of Products<span class="pull-right"><?php echo $name; ?></span></h4>
    	</div>
    	<div class="row">
    		<div class="col-md-6">
    			<div class="md-form mb-5">
                    <?php
                        $disp_trans = "SELECT * FROM transaction INNER JOIN products USING(ProductID) INNER JOIN users USING(UsersID) WHERE UsersID = '$checkout'";
                        $trans_res = mysqli_query($conn, $disp_trans);

                        while ($trans_row = mysqli_fetch_assoc($trans_res)){
                    ?>
                    <img src="<?php echo $trans_row['ProductImage'] ?>" height="200" width="200">
    				<h3>Product Name: <span class="font-weight-bold"><?php echo $trans_row['ProductName'];  ?></span> </h3>
    				<h3>Price: <span class="font-weight-bold"><?php echo $trans_row['TransPrice'];  ?></span> </h3>
    				<h3>Quantity: <span class="font-weight-bold"><?php echo $trans_row['TransQuantity']; ?></span></h3>
    			</div>
    			<div class="md-form">
    				<h3>Total Price:<span class="font-weight-bold"> <?php echo $trans_row['TransTotal']; ?></span></h3>
    			</div>
            <?php } ?>
            <div class="md-form">
                <button type="submit" class="btn btn-success" name="process"><span class="fa fa-cog"></span> Process</button>
            </div>
    		</div>
    	</div>
    </div>
</body>
</html>