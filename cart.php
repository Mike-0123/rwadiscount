<?php
 session_start();
 if(isset($_POST['add_to_cart'])) {
 
    if(isset($_SESSION['cart'])) {
      //user has already has added product to cat the cart is not empyt 
        
   $products_array_ids = array_column($_SESSION['cart'], 'product_id');
   // if product has already added to cart or not 
    if(!in_array($_POST['product_id'], $products_array_ids)) {
              $product_id =$_POST['product_id'];
        
       
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_image' => $_POST['product_image'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$product_id] = $product_array;



        //when is the first product 
    } 
    else{

      echo "<script>
    alert('Product already in cart. Quantity updated!');
</script>";



    }
  }
    else {
        $product_id =$_POST['product_id'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];


        $product_array = array(
            'product_id' => $product_id,
            'product_image' => $product_image,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_quantity' => $product_quantity
        );
          $_SESSION['cart'][$product_id] = $product_array;
    }
 //calculate total
  calculateTotalCart();
 }
 //remove prodduct

 else if(isset($_POST['remove_product'])) {
     $product_id = $_POST['product_id'];
     unset($_SESSION['cart'][$product_id]);
     //calcutate total
     calculateTotalCart();
  
  


 }
 //we get id and quntity from the form
 else if(isset($_POST['edit_quantity'])) {
     $product_id = $_POST['product_id'];
     $product_quantity = $_POST['product_quantity'];
     //get    the product array from the session
      $product_array = $_SESSION['cart'][$product_id];

      //update the quantity in the product array
     $product_array['product_quantity'] = $product_quantity;

     //return the array to uts place
     $_SESSION['cart'][$product_id] = $product_array;
     //calculate total
     calculateTotalCart();

 }




 else {
   //header("Location: index.php");
    
 }




 function calculateTotalCart(){
    $total = 0;
 foreach ($_SESSION['cart'] as $key => $value) {
      $product = $_SESSION['cart'][$key];
      $price = $product['product_price'];
      $quantity = $product['product_quantity'];
      $total += $price * $quantity;

   }
   $_SESSION['total'] = $total;
 }
 if (!isset($_SESSION['total'])) {
    calculateTotalCart();
}
?>



<?php include('layout/header.php') ?>

 <!-- table easy esiest to use for the well design the cart  -->
  <!-- Cart -->
   <section class="cart container my-5 py-5">
    <div class="container  mt-5">
        <h2 class="font-weight-bolde">Your Cart</h2> 
        <hr>
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
             <th>Quantity</th>
              <th>SubTotal</th>
        </tr>
        <?php foreach($_SESSION['cart'] as $key => $value){ ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php  echo $value['product_image']; ?>" alt="" >
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>$</span><?php  echo $value['product_price']; ?></small>
                        <br>
                        <form  method="POST"  action="cart.php">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                        <input type="submit" name="remove_product" class="remove-btn" value=remove></input>
                        </form>
                    </div>
                </div> 
            </td>
            <td>
            <form action="cart.php" method="POST"> 
              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
              <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
              <input  type="submit" class="edit-btn"  value="Edit" name="edit_quantity"></input>
            
            </form>
              
            </td> 
            <td>
                <span>$</span>
                <span class="product-price"><?php  echo $value['product_quantity']* $value['product_price'];?></span>
            </td>
        </tr>  
        <?php } ?>
    </table>
    <div class="cart-total">
         <table >
            <!-- <tr>
                <td>SubTotal</td>
                <td>$155</td>
            </tr> -->
            <tr>
                <td>Total </td>
                <td>$<?php echo $_SESSION['total']; ?></td>
            </tr>
         </table>
    </div>
    <div class="checkout-container">
      <form action="checkout.php" method="post">
        <input  type="submit"  class="btn checkout-btn" value="Checkout" name="checkout"></input>
        </form>
    </div>
   
   </section>


 <!-- footer -->
<?php include('layout/footer.php') ?>