<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['a_username'])) {
		header("location: index.php");
	}


	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') or 
	die('Connection Failed: ' . mysqli_error());
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
    	</div>
    </nav><br><br><br>
    <div class="container">
    	<div class="page-header">
    		<h1 class="text-center"><span class="fa fa-users"></span> User Account Information</h1>
    		<hr>
    		<h3>List of Users</h3>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-hover">
    			<thead class="bg-danger text-white">
    				<tr>
    					<th style="font-size: 20px;"><span class="fa fa-user"></span> Name</th>
    					<th style="font-size: 20px;"><span class="fa fa-envelope"></span> Email</th>
    					<th style="font-size: 20px;"><span class="fa fa-phone"></span> Contact Number</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
    					$disp_user = "SELECT * FROM users ORDER BY UsersID DESC";
    					$disp_res = mysqli_query($conn, $disp_user);

    					if (mysqli_num_rows($disp_res) > 0) {
    						while ($disp_row = mysqli_fetch_assoc($disp_res)) {
    							echo "<tr>
    								<td style='font-size:20px;'>".$disp_row['FirstName']. " " .$disp_row['MiddleName']. " ".$disp_row['LastName']."</td>
    								<td style='font-size:20px;'>".$disp_row['EmailAddress']."</td>
    								<td style='font-size:20px;'>".$disp_row['ContactNumber']."</td>
    							</tr>";
    						}
    					} else {
    						echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Users Found</h3></td></tr>";
    					}
    				?>
    			</tbody>
    		</table>
    	</div>
    </div>
</body>
</html>