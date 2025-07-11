<?php
session_start();

if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){
 //let user in 





 //sende user to home page
}
else{
  header('location:index.php');
}



?>




<?php  include('layout/header.php')?>


<!-- Checkout -->
<section class="my-5 py-5">
    <div  class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>
    <div  class="mx-auto container">
        <form  id="checkout-form" action="server/place_order.php" method="post">
            <div class="form-group checkout-small-element" >
                <label for="register-name">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group checkout-small-element" >
                <label for="login-email">Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group checkout-small-element" >
                <label for="register">Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone">
            </div>
            <div class="form-group checkout-small-element" >
                <label for="register">City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Confirm Password">
            </div>
            <div class="form-group checkout-large-element" >
                <label for="register">Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address">
            </div>
            <div class="form-group checkout-btn-container" >
              <p>Total Amout:FRW <?php echo $_SESSION['total'] ?></p>
                <input type="submit" class="btn" id="checkout-btn"   name="place_order" value="place_order">
            </div>
        </form>
    </div>
</section>






<?php  include('layout/footer.php') ;?>
