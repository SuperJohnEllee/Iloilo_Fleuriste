<!DOCTYPE html>
<?php
	session_start();
	
	$name = htmlspecialchars($_SESSION['a_name']);
	$username = htmlspecialchars($_SESSION['a_username']);

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste');
	
	if (!isset($_SESSION['a_username'])) {
		header("location: index.php");
	}

	$prod_sql = "SELECT ProductID FROM products";
	$prod_res = mysqli_query($conn, $prod_sql);
	$prod_count = mysqli_num_rows($prod_res);

  $user_sql = "SELECT UsersID FROM users";
  $user_res = mysqli_query($conn, $user_sql);
  $user_count = mysqli_num_rows($user_res);
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
  <link rel="stylesheet" href="css/mdb.min.css">
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
    		<ul class="navbar-nav ml-auto">
    			<li class="nav-item">
    				<a class="nav-link text-white" href="admin-profile.php?<?php echo $username; ?>"><span class="fa fa-user-secret"></span> <?php echo $username; ?></a>
    			</li>
    			<li class="nav-item">
    				<a class="nav-link text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
    			</li>
    		</ul>
    	</div>
    </nav><br><br><br>
	<div class="container">
		<h1>Hello, <?php echo $name; ?></h1>
		<h5>This is your dashboard</h5>
		<hr>
		<h1 class="text-center">Administrator Dashboard</h1>
		<div class="row">
			 <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <a href="admin-manage-profiling.php"><img class="card-img-top" src="img/dashboard/products2.png" height="300" width="200"></a>
                <div class="card-body">
                  <h1 class="card-title">Manage Products&nbsp;&nbsp;<span><?php echo $prod_count; ?></span></h1>
                  <div class="d-flex justify-content-between align-items-center">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
              	<a href="admin-manage-checkout.php"><img class="card-img-top" src="img/dashboard/products2.png" height="300" width="200"></a>
                <div class="card-body">
                  <h1 class="card-title">Confirm Checkout Details&nbsp;&nbsp;<span><?php echo $prod_count; ?></span></h1>
                  <div class="d-flex justify-content-between align-items-center">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="img/dashboard/inventory.svg" height="300" width="200">
                <div class="card-body">
                  <h1 class="card-title">Manage Inventory&nbsp;&nbsp;<span><?php echo $prod_count; ?></span></h1>
                  <div class="d-flex justify-content-between align-items-center">
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <a href="admin-manage-user-accounts.php"><img class="card-img-top" src="img/dashboard/users.svg" height="300" width="200"></a>
                <div class="card-body">
                  <h1 class="card-title">Manage User Accounts&nbsp;&nbsp;<span><?php echo $user_count; ?></span></h1>
                  <div class="d-flex justify-content-between align-items-center">
                  </div>
                </div>
              </div>
            </div>
		  </div>
	</div>
</body>
</html>