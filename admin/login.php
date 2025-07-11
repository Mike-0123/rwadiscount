<?php
 session_start();
 include('../server/connection.php');

 if(isset($_SESSION['admin_logged_in'])) {
     header("Location: index.php");
     exit();
 }
 
 if(isset($_POST['login_btn'])) {


     $email = $_POST['email'];
     $password = md5($_POST['password']);
     
     // Check if the user exists
    
     $stmt=$conn ->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ?  AND admin_password =?
      LIMIT 1");
     $stmt->bind_param('ss', $email, $password);

     if($stmt->execute()){
      $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
      $stmt->store_result();
   

  if($stmt->num_rows()==1){
    $stmt->fetch();
    $_SESSION['admin_id'] = $admin_id;
    $_SESSION['admin_name'] = $admin_name;
    $_SESSION['admin_email'] = $admin_email;
    $_SESSION['admin_logged_in'] = true;



    header("Location: index.php?login_success=You are successfully logged in");

  }}
  else{
       header("Location: login.php?error=could not verfying your account at the moment  ");
	
  }
 }
 

 

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">

	<link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page sidebar-mini">

<div class="login-box">
	<div class="login-logo">
		<b>Admin Panel</b>
	</div>
  	<div class="login-box-body">
    	<p class="login-box-msg">Log in to start your session</p>
		<form action="login.php" method="POST">
			<p style="color: red;"><?php  if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
			<div class="form-group has-feedback">
				<input class="form-control" placeholder="Email address" name="email" type="email" autocomplete="off" autofocus>
			</div>
			<div class="form-group has-feedback">
				<input class="form-control" placeholder="Password" name="password" type="password" autocomplete="off" value="">
			</div>
			<div class="row">
				<div class="col-xs-8"></div>
				<div class="col-xs-4">
					<input type="submit" class="btn btn-success btn-block btn-flat login-button" name="login_btn" value="Log In">
				</div>
			</div>
		</form>
	</div>
</div>


<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/select2.full.min.js"></script>
<script src="js/jquery.inputmask.js"></script>
<script src="js/jquery.inputmask.date.extensions.js"></script>
<script src="js/jquery.inputmask.extensions.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/icheck.min.js"></script>
<script src="js/fastclick.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>

</body>
</html>