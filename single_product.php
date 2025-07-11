 <?php
include('server/connection.php');
if(isset($_GET['product_id'])){
  $product_id= $_GET['product_id'];

$stmt= $conn->prepare("SELECT *FROM products wHERE product_id = ? ");
$stmt->bind_param("i",$product_id);
$stmt->execute();
$product = $stmt->get_result();//[]


  //no product id way given 

}
else{
  header("Location: index.php");

}



?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RwaDiscounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
 
 
 
 
 
 
<?php include('layout/header.php'); ?>







<!-- single product -->
<section class=" container single-product my-5 pt-5">
     <div class="row mt-5">

      <?php while($row = $product->fetch_assoc()){ ?>

        
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image'];?>" alt="" srcset="" id="mainImg">
            <div  class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image'];?>" width="100%" class="small-img" alt="" >
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image2'];?>" width="100%" class="small-img" alt="" >
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image3'];?>" width="100%" class="small-img" alt="" >
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image4'];?>" width="100%" class="small-img" alt="" >
                </div>
            </div>


          

        </div>
        <div class="col-lg-6 col-md-12 col-12 pt-5">
            <h6 class="text-uppercase font-weight-bold">Restaurant Deal</h6>
            <h3 class="py-4"><?php echo $row['product_name'];?></h3>
            <h2><?php echo $row['product_price'];?></h2>
            <form  method="POST" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>">
          <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>">
          <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>">
          <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>">

            <input type="number" name="product_quantity" value="1">
            <button class="buy-btn" type="submit" name="add_to_cart">Add to favorite</button>

             </form>
            <h4 class="mt-5 mb-5">Deals Details </h4>
            <span><?php echo $row['product_description'];?></span>
            <h4 class=""></h4>

        </div>
       
  <?php } ?>
         </div>
</section>



<!-- related product -->
   <section id="featured" class="my-5 ">
      <div class="container text-center mt-5 py-5">
        <h3>Related Product</h3>
        <hr class="mx-auto">
      </div>
      <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img  class="img-fluid mb-3" src="assets/imgs/brand1.jpg" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Sport Shoes</h5>
          <h4 class="p-price">$199.8</h4>
          <button  class="buy-btn">Buy Now</button>
        </div>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img  class="img-fluid mb-3" src="assets/imgs/brand1.jpg" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Sport Shoes</h5>
          <h4 class="p-price">$199.8</h4>
          <button  class="buy-btn">Buy Now</button>
        </div>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img  class="img-fluid mb-3" src="assets/imgs/brand1.jpg" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Sport Shoes</h5>
          <h4 class="p-price">$199.8</h4>
          <button  class="buy-btn">Buy Now</button>
        </div>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img  class="img-fluid mb-3" src="assets/imgs/brand1.jpg" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Sport Shoes</h5>
          <h4 class="p-price">$199.8</h4>
          <button  class="buy-btn">Buy Now</button>
        </div>
      </div>
      
    </section>









 <!-- footer -->














   <?php include('layout/footer.php');?>

    
    
    <script>
        var  mainImg =document.getElementById("mainImg");
         var smallImg= documet.getElementByClassName("small-img");
         
         for(let i=0;i<4;i++){
            smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src;
         }
         }

    </script>
   


