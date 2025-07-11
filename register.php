<?php

 include('server/connection.php');
 session_start();

if(isset($_POST['register'])){
 $name=$_POST['name'];
  $email=$_POST['email'];
   $password=$_POST['password'];
   $confirm_password =$_POST['confirmpassword'];
//if password not match 
   if($password !== $confirm_password){
    header("Location: register.php?error=Passwords do not match");

}
// if password is less than 6 characters
else if(strlen($password) < 6){
    header("Location: register.php?error=Password must be at least 6 characters long");
}
//if there is no error 
else{
//check wheter there is a user with this email or not 
$stmt1= $conn->prepare("SELECT  count(*) FROM users WHERE user_email = ?");
$stmt1->bind_param('s', $email);
$stmt1->execute();
$stmt1->bind_result($num_rows);
$stmt1->store_result();
$stmt1->fetch();
//if there is the user with already with this email
if($num_rows != 0){
    header("Location: register.php?error= user of this Email already exists");
   
}

//if no user registered with this email before then create a 
else{
  //create a new user 
$stmt= $conn->prepare("INSERT INTO users (user_name,user_email, user_password) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, md5($password));

//account was  created sucessfully
if($stmt->execute()){
  $user_id = $stmt->insert_id; // Get the last inserted user ID
$_SESSION['user_id'] = $user_id;
$_SESSION['user_email'] = $email;
$_SESSION['user_name'] = $name;
$_SESSION['logged_in'] = true;
header("location:account.php?register_success=you are successfully registered);");

}
else{
  header("Location: register.php?error=could not create account at the moments ");

}
}
}
}
//if user has already register then take user to acoount page

else if (isset($_SESSION['logged_in'])){
  header("Location: account.php");
  exit();

}
else{
  //if user is not logged in then redirect to login page
  header("Location: login.php");
  exit();
}


?>


<?php include('layout/header.php');?>





<!-- Register -->
<section class="my-5 py-5">
    <div  class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div  class="mx-auto container">
        <form  id="register-form" method="POST" action="register.php">
          <p style="color: red;"><?php  if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group" >
                <label for="register-name">Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group" >
                <label for="login-email">Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group" >
                <label for="register">Password</label>
                <input type="password" class="form-control" id="register" name="password" placeholder="Password">
            </div>
            <div class="form-group" >
                <label for="register">Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="Confirm Password">
            </div>
            <div class="form-group" >
                <input type="submit" class="btn" id="register-btn"  name="register" value="Register">
            </div>
            <div class="form-group" >
               <a  href="login.php" id="login-url" class="btn">Don't you have account? Login</a>
            </div>
        </form>
    </div>
</section>













 <?php include('layout/footer.php');?>