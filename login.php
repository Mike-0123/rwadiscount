<?php
 session_start();
 include('server/connection.php');
 if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
     header("Location: account.php");
     exit();
 }
 
 if(isset($_POST['login_btn'])) {
     $email = $_POST['email'];
     $password = md5($_POST['password']);
     $hashed_password = md5($password);

     // Check if the user exists
     $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? AND user_password = ?");
     $stmt->bind_param('ss', $email, $hashed_password);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt=$conn ->prepare("SELECT user_id,user_name,user_email, user_password FROM users WHERE user_email = ? 
     AND user_password = ? LIMIT 1");
     $stmt->bind_param('ss', $email, $password);
     if($stmt->execute()){
      $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
      $stmt->store_result();
     };
  if($stmt->num_rows()==1){
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['logged_in'] = true;



    header("Location: account.php?login_success=You are successfully logged in");

  }
  else{
       header("Location: login.php?error=could not verfying your account at the moment  ");

  }
 }



?>






<?php include('layout/header.php') ?>

<!-- Login -->
<section class="my-5 py-5">
    <div  class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">LogIn</h2>
        <hr class="mx-auto">
    </div>
    <div  class="mx-auto container">
        <form  id="login-form" action="login.php" method="post">
          <p style="color: red;" class="text-center"><?php  if(isset($_GET['register_success'])){echo $_GET['register_Success'];} ?></p>
          <p style="color: green;" class="text-center"><?php  if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>

            <div class="form-group" >
                <label for="login-email">Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email">
            </div>
            <div class="form-group" >
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
            </div>
            <div class="form-group" >
                <input type="submit" name="login_btn" class="btn" id="login-btn"  value="Login">
            </div>
            <div class="form-group" >
               <a    href="register.php" id="register-url" class="btn">Don't have account? register</a>
            </div>
        </form>
    </div>
</section>




<?php  include('layout/footer.php');?>

