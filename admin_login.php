<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Iloilo Fleuriste</title>
	<link rel="icon" href="img/zaira.jpg">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<form class="col-md-5" method="post">
  <div class="form-group">
    <label for="email">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="password">
  </div>
  <button type="submit" name="login" class="btn btn-default">Submit</button>
</form>	
</div>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') or die('Connection Failed: ' . mysqli_error()); // connection

	if (isset($_POST['login'])) {


		//Define login variables
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		//SQL Injection Protection
		$frmUser = stripslashes($username);
		$frmPass = stripslashes($password);
		$frmUser = mysqli_real_escape_string($conn, $frmUser);
		$frmPass = mysqli_real_escape_string($conn, $frmPass);

		$log_sql = "SELECT * FROM admin WHERE Username = '$username'";
		$log_res = mysqli_query($conn, $log_sql);
		$log_count = mysqli_num_rows($log_res);
		$log_row = mysqli_fetch_assoc($log_res);

		$res_name = $log_row['FirstName'] . ' ' . $log_row['LastName'];
		$res_user = $log_row['Username'];
		$res_pass = $log_row['Password'];

		if ($log_count > 0) {
			if ($res_pass == $frmPass) {
				$_SESSION['name'] = $res_name;
				$_SESSION['username'] == $res_user;
				$_SESSION['password'] == $res_pass;
				header("location: admin_dashboard.php");
			} else {
				echo "<h2>Incorrect Password</h2>";
			}
		} else {
			echo "<h2>Invalid Username</h2>";
		}
	}
?>
</body>
</html>