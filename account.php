<?php
session_start();
include('server/connection.php');
 if(!isset($_SESSION['logged_in'])) {
     header("Location: account.php");
      exit();
 }
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header("Location: login.php");
    exit();
  }
  else{
  }
}


if(isset($_POST['change_password'])){

$password = $_POST['password'];
$confirm_password = $_POST['confirmpassword'];
$user_email = $_SESSION['user_email'];
//if password not match 
   if($password !== $confirm_password){
    header("Location: account.php?error=Passwords do not match");
    exit();

}
// if password is less than 6 characters
else if(strlen($password) < 6){
    header("Location: account.php?error=Password must be at least 6 characters long");
    exit();

    //no error
}
else{
  //update the password
  $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
  $stmt->bind_param('ss', md5($password), $user_email);
 if($stmt->execute()){
   header("Location: account.php?message=Password changed successfully");
   exit();
 }
}}


//get orders 
if(isset($_SESSION['logged_in'])){
 $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $orders = $stmt->get_result();
}

?>
<?php include('layout/header.php');?>
<!-- Account -->
<section class="my-5 py-5"> 
    <div  class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];}  ?></p>

        <h3 class="font-weight-bold">Account Info</h3>
         <hr class="max-auto">
         <div class="account-info">
            <p>Name<span><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];}?></span></p>
            <p>Email <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
            <p><a href="#orders" id="order-btn">Your Orders</a></p>
            <p><a href="account.php?logout=1" id="Logout-btn">Logout</a></p>
         </div>
         </div>
        


         <div class="col-lg-6 col-md-12 col-sm-12">
            <form  id="account-form" method="POST" action="account.php">
              <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}  ?></p>
              <p class="text-center" style="color: green;"><?php if(isset($_GET['message'])){echo $_GET['message'];}  ?></p>

                <h3>Change Password</h3>
                <hr class="max-auto">
                <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="account-password" name="password" required>
                </div>
                
                <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="account-password-confirm" name="confirmpassword" required>
                </div>
                <div class="form-group">
                <input type="submit" value="Change-password"  name="change_password" class="btn" id="change-pass-btn">
          
                
            </form>
           </div>
    </div>
  
    
 
</section>



 <!-- Orders -->
   <section  id="orders" class="orders container my-5 py-3">
    <div class="container  mt-2">
        <h2 class="font-weight-bolde text-center">Your orders</h2> 
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Order Id</th>
             <th>Order_Cost</th>
              <th>Order_status</th>
               <th>Order_date</th>
               <th>order detail</th>

               <?php   while($row =$orders->fetch_assoc()) {?>  
        </tr>
        <tr>
            <td>
               
            <span><?php  echo $row['order_id']  ?></span>

            </td>
            <td>
              <span><?php  echo $row['order_cost']  ?></span>
            </td>
              <td>
              <span><?php  echo $row['order_status']  ?></span>
            </td>
                        <td>
              <span><?php  echo $row['order_date']  ?></span>
            </td>
            <td>
              <form action="">
                <input type="submit" class="btn  orders-details-btn" value="View detail" name="view_order">
              </form>
            </td>
                     
        </tr>
<?php } ?>
            
      </table>
   
   
   </section>




 <!-- footer -->
<?php include('layout/footer.php');?>

