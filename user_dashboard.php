<!DOCTYPE html>
<?php
	session_start(); //starts the session

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste');
	$name = $_SESSION['u_name']; //define session name

	//if user is not logged in, automatically redirects in the index page
	if (!isset($_SESSION['u_email'])) {

		header("location: index.php");
	}

	$total_price = "";

	if (isset($_POST['add_to_cart'])) {

		$prod_sql = mysqli_query($conn, "SELECT * FROM products");
		$prod_row = mysqli_fetch_assoc($prod_sql);
		$prod_id = $prod_row['ProductID'];

		$product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
		$product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

		$product_price = $prod_row['ProductPrice'];
		
		$total_price = $product_price * $product_quantity;

		$u_id = $_SESSION['u_id'];

		$insert_price = "INSERT INTO transaction(ProductID, ID, Price, Quantity, TotalPrice)
		VALUES('$prod_id', '$u_id', '$product_price', '$product_quantity', '$total_price')";

		$insert_res = mysqli_query($conn, $insert_price);
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Iloilo Fleuriste</title>
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
    				<a class="nav-link text-white" href="admin_dashboard.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
    			</li>
    		</ul>
    		<ul class="navbar-nav ml-auto">
    			<li class="nav-item">
    				<a class="nav-link text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
    			</li>
    		</ul>
    	</div>
    </nav><br><br><br>
	<div class="container">
		<h1>Welcome, <?php echo $name; ?></h1>
		<hr>
		<a class="btn btn-info" href="checkout.php?checkout=<?php echo $_SESSION['u_id'] ?>">Check Out</a>
		<div class="row text-center text-lg-center">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') 
                    or die('Connection Failed:' . mysqli_error());

                    $disp_product = "SELECT * FROM products ORDER BY ProductDate DESC";
                    $product_res = mysqli_query($conn, $disp_product);
                    if (mysqli_num_rows($product_res) > 0) {
                        while ($product_row = mysqli_fetch_assoc($product_res)) {
                            $image = $product_row['ProductImage'];
                ?>
               <div class="col-lg-3 col-md-4 col-xs-6"> 
                <a class="d-block h-100 mb-3" href="product-info.php?prod_id=<?php echo $product_row['ProductID']; ?>"><img height="200" width="200" src="<?php echo $image; ?>" alt="Image">
                	<h3><?php echo $product_row['ProductName']; ?></h3></a>
                </div>
            <?php } ?>
               <?php } else {
                    echo "No Image Found";
                }
                ?>
        </div>
	</div>
</body>
</html>