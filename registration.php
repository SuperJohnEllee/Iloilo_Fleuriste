<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Iloilo Fleuriste</title>
	<link rel="icon" href="img/zaira.jpg">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<style>
		h1 { background-color: white; }
	</style>
</head>
<body>
   <div class="container">
   		<h3 class="text-center">Create Account</h3>
   		<h6 class="text-center">Create an account for access to your address book, express checkout and order history.</h6>
   		
   		<form method="post">
   		<div class="row">
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="last_name" required>
   				<label>Last Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="first_name" required>
   				<label>First Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="mid_name" required>
   				<label>Midle Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-map-marker prefix"></i>
   				<input class="form-control" type="text" name="address" required>
   				<label>Address</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-phone prefix"></i>
   				<input class="form-control" type="text" name="contact_num" required>
   				<label>Contact Number</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-calendar prefix"></i>
   				<input class="form-control" type="date" name="bdate" required>
   			</div>

   			<div class="md-form col-md-6">
   				<i class="fa fa-envelope prefix"></i>
   				<input class="form-control" type="email" name="email" required>
   				<label>&nbsp;Email</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-lock prefix"></i>
   				<input class="form-control" type="password" name="password" required>
   				<label>Password</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-lock prefix"></i>
   				<input class="form-control" type="password" name="confirm_password" required>
   				<label>Confirm Password</label>
   			</div>
   		</div>
   			<div class="md-form">
   				<button class="btn btn-success" type="submit" name="register">CREATE ACCOUNT</button>
   			</div>
   	</form>
   </div>
    <?php
    	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste')
    	or die('Connection Failed ' . mysqli_error()); //include connection
    	if ($_SERVER['REQUEST_METHOD'] == "POST") {
    		
    		//define variables
    		$last_name = $_POST['last_name'];
    		$first_name = $_POST['first_name'];
    		$mid_name = $_POST['mid_name'];
    		$email = $_POST['email'];
    		$bdate = $_POST['bdate'];
    		$contact_num = $_POST['contact_num'];
    		$address = $_POST['address'];
    		$password = $_POST['password'];
    		$confirm_password = $_POST['confirm_password'];

    		//Prevent in same email and information duplication
    		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE EmailAddress = '$email'");
    		$count_email = mysqli_num_rows($check_email);
			
			if ($count_email > 0) {
    			echo "<script>
    				alert('Email is already existing');
    			</script>";
    		
    		}  
    		elseif ($password != $confirm_password) {
    			echo "<script>
    				alert('Password do not match');
    			</script>";
    		}  

    		else {
    			//query start
    			$insert_user = mysqli_query($conn, "INSERT INTO users(LastName, FirstName, MiddleName, EmailAddress, ContactNumber, Birthdate, Address, Password) 
    				VALUES('$last_name', '$first_name', '$mid_name', '$email', '$contact_num',
    				'$bdate', '$address', '$password');");

    			if ($insert_user) {
    				echo "<script>
    					alert('Successfully registered');
    				</script>
    				<meta http-equiv='refresh' content='0; url=index.php?success'>";
    			} else {
    				echo "<script>
    					alert('Failure in registration');
    				</script>";
    			}
    		}
    		mysqli_close($conn); //close connection
    	}
    ?>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src=js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>