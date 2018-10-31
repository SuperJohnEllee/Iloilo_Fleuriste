<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['a_username'])) {
		header("location: index.php");
	}


	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') or 
	die('Connection Failed: ' . mysqli_error());

	$prod_sql = "SELECT ProductID from products";
	$prod_res = mysqli_query($conn, $prod_sql);
	$prod_count = mysqli_num_rows($prod_res);	
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iloilo Fleurriste</title>
	<link rel="icon" href="img/zaira.jpg">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
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
    				<a class="nav-link text-white" href="admin_dashboard.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
    			</li>
    		</ul>
    	</div>
    </nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-tag"></span> Product Profiling</h1>
		</div>
		<div class="row">
			<div class="col-md-6">
			<form method="post" enctype="multipart/form-data">
				<div class="md-form">
					<i class="fa fa-image prefix"></i>
					<input class="form-control" type="file" name="image">
				</div>
				<div class="md-form">
					<i class="fa fa-tag prefix"></i>
					<input class="form-control" type="text" name="prod_name">
					<label>Product Name</label>
				</div>
				<div class="md-form">
					<i class="fa fa-money prefix"></i>
					<input class="form-control" type="text" name="prod_price">
					<label>Product Price</label>
				</div>
				<div class="md-form">
					<i class="fa fa-at prefix"></i>
					<input class="form-control" type="text" name="prod_quantity">
					<label>Stocks</label>
				</div>
				<div class="md-form">
					<button type="submit" class="btn btn-primary" name="product_add"><span class="fa fa-plus"></span> Add Product</button>
				</div>
			</form>
			</div>
		</div>
		<div class="table-responsive">
			<h1 class="text-center"><span class="fa fa-info-circle"></span> Product Information(<?php echo $prod_count; ?>)</h1>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Image</th>
						<th>Product Name</th>
						<th>Product Price</th>
						<th>Stocks</th>
						<th>Product Date Posted</th>
						<th class="text-center" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Displays product information in tables
						$disp_prod = mysqli_query($conn, "SELECT * FROM products ORDER BY ProductDate DESC");
						if (mysqli_num_rows($disp_prod) > 0) {
							while ($row = mysqli_fetch_assoc($disp_prod)) {
								echo "<tr>
									<td><img src='".$row['ProductImage']."' height=200 width=200></td>
									<td>".$row['ProductName']."</td>
									<td>".number_format($row['ProductPrice'], '2')."</td>
									<td>".$row['ProductStocks']."</td>
									<td>".$row['ProductDate']."</td>
									<td><a class='btn btn-info'><span class='fa fa-edit'></span> Edit</a></td>
									<td><a class='btn btn-danger' href='delete.php?prod_del=".$row['ProductID']."'><span class='fa fa-trash'></span> Delete</a></td>
								</tr>";
							}
						} else {
							echo "<tr><td colspan='11'><h3 class='text-center alert alert-warning'><span class='fa fa-warning'></span> No Products Found</h3></td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/mdb.min.js"></script>
<?php

	if (isset($_POST['product_add'])) {

		//define product information
		$prod_image = mysqli_real_escape_string($conn, 'product_image/'.$_FILES['image']['name']);
		$prod_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
		$prod_price = mysqli_real_escape_string($conn, $_POST['prod_price']);
		$prod_quantity = mysqli_real_escape_string($conn, $_POST['prod_quantity']);

		//Match the file tpye
		if (preg_match("!image!", $_FILES['image']['type'])) {
			//Folder
			if (copy($_FILES['image']['tmp_name'], $prod_image)) {

				//query start
				$product_sql = "INSERT INTO products(ProductImage, ProductName, ProductPrice, ProductStocks, ProductDate) 
				VALUES ('$prod_image', '$prod_name', '$prod_price', '$prod_quantity', NOW())";
				$product_res = mysqli_query($conn, $product_sql);

				//check if success or not
				if ($product_res) {
					echo "<script>
						alert('Product added sucessfully');
					</script>
					<meta http-equiv='refresh' content='0; url=admin-manage-profiling.php'>";
				} else {
					echo "<script>
						alert('Product upload failed');
					</script>";
				}

			} else {
				echo "<script>
					alert('Image upload failed');
				</script>";
			}
		} else {
			echo "<script>
				alert('Invalid file type');
			</script>";
		}
	}
?>
</body>
</html>