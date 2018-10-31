<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="IE=edge">
<title>Iloilo Fleuriste</title>
<link rel="icon" href="img/zaira.jpg">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
</head>
<body>
<div class="container">
  <ul class="nav nav-tabs md-tabs nav-justified bg-danger">
    <li class="nav-item">
      <a class="nav-link text-dark active" href="#userLogin" data-toggle="tab" role="tab"><span class="fa fa-user"></span> User Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="#adminLogin" data-toggle="tab" role="tab"><span class="fa fa-user-secret"></span> Admin Login</a>
    </li>
  </ul>
  <div class="tab-content card">
      <div class="tab-pane fade in show active" id="userLogin" role="tabpanel">
        <br>
        <div class="col-md-8">
          <h3>User</h3>
            <form method="post">
                <div class="md-form">
                    <div class="col-lg-7">
                      <i class="fa fa-envelope prefix"></i>
                      <input type="text" name="email" required>
                      <label>&nbsp;Email</label>
                    </div>
                </div>
                <div class="md-form">
                    <div class="col-lg-7">
                      <i class="fa fa-lock prefix"></i>
                      <input type="password" name="u_password" required>
                      <label>Password</label>
                    </div>
                </div>
                <div class="md-form">
                    <button class="btn btn-success" name="userLogin"><span class="fa fa-sign-in"></span> Login</button>
                </div>
            </form>
        </div>
      </div>
      <div class="tab-pane fade" id="adminLogin" role="tabpanel">
        <br>
        <div class="col-md-8">
          <h3>Admin</h3>
            <form method="post">
                <div class="md-form">
                    <div class="col-lg-7">
                      <i class="fa fa-user prefix"></i>
                      <input type="text" name="username" required>
                      <label>Username</label>
                    </div>
                </div>
                <div class="md-form">
                    <div class="col-lg-7">
                      <i class="fa fa-lock prefix"></i>
                      <input type="password" name="a_password" required>
                      <label>Password</label>
                    </div>
                </div>
                <div class="md-form">
                    <button class="btn btn-success" name="adminLogin"><span class="fa fa-sign-in"></span> Login</button>
                </div>
            </form>
        </div>
      </div>
  </div>
</div>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') 
  or die('Connection Failed: '. mysqli_error());
  
  session_start();
  
  if (isset($_POST['userLogin'])) {
      
      //user login variables
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['u_password']);

      //query start
      $user_sql = "SELECT * FROM users WHERE EmailAddress = '$email' AND Password = '$password'";
      $user_res = mysqli_query($conn, $user_sql);
      $user_count = mysqli_num_rows($user_res);

      if ($user_count == 1) {
          $data = mysqli_fetch_assoc($user_res);
          
          //session variables
          $_SESSION['u_id'] = $data['UsersID'];
          $_SESSION['u_email'] = $data['EmailAddress'];
          $_SESSION['u_firstname'] = $data['FirstName'];
          $_SESSION['u_middlename'] = $data['MiddleName'];
          $_SESSION['u_lastname'] = $data['LastName'];
          $_SESSION['u_birthday'] = $data['Birthdate'];
          $_SESSION['u_contact_number'] = $data['ContactNumber'];
          $_SESSION['u_name'] = $data['FirstName'] . ' ' . $data['LastName'];
          $_SESSION['u_fullname'] = $data['FirstName'] . ' ' . $data['MiddleName'] . ' ' . $data['LastName'];
          header("location: user_dashboard.php"); 
      } else {
        echo "<script>
          alert('Wrong email or password');
        </script>";
      }

     //Admin Logged In 
  } else if (isset($_POST['adminLogin'])) {
      
      //admin login variables
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['a_password']);

      //query start
      $admin_sql = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
      $admin_res = mysqli_query($conn, $admin_sql);
      $admin_count = mysqli_num_rows($admin_res);

      if ($admin_count == 1) {
          $row = mysqli_fetch_assoc($admin_res);
          
          //session variables
          $_SESSION['a_id'] = $row['AdminID'];
          $_SESSION['a_username'] = $row['Username'];
          $_SESSION['a_lastname'] = $row['LastName'];
          $_SESSION['a_firstname'] = $row['FirstName'];
          $_SESSION['a_midname'] = $row['MiddleName'];
          $_SESSION['a_name'] = $row['FirstName'] . ' ' . $row['LastName'];
          $_SESSION['a_fullname'] = $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'];
          header("location: admin_dashboard.php");
      } else {
          echo "<script>
            alert('Wrong username or password');
          </script>";
      }
  }
?>
<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>
