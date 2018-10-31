<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['a_username'])) {
		header("location: index.php");
	}

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste')
	or die('Connection Failed: ' . mysqli_error());
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
    		<h1 class="text-center"><span class="fa fa-user-secret"></span> Admin Profile Account</h1>
    		<hr>
    	</div>
    	<div class="col-md-6 mb-4">
    		<h4>Name: <?php echo $_SESSION['a_fullname']; ?> </h4>
    	</div>
    	<div class="col-md-6 mb-4">
    		<h4>Username: <?php echo $_SESSION['a_username']; ?> </h4>
    	</div>
    	<div class="row">
    		<div class="col-md-6">
    			<a class="btn btn-primary" href=""><span class="fa fa-edit"></span> Edit Profile</a>
    			<a class="btn btn-teal" href=""><span class="fa fa-lock"></span> Change Password</a>
    		</div>
    	</div>
    </div>
</body>
</html>