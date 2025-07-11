<?php
include('server/connection.php');

 
// use the search session  
if (isset($_POST['search']) && isset($_POST['category']) && isset($_POST['price'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ?");
    $stmt->bind_param("si", $category, $price);
    $stmt->execute();
    $products = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->get_result();
}




?>



<?php include('layout/header.php') ;?>

<!-- Main Content (Search + Products Side by Side) -->
<section class="my-5 py-5">
  <div class="container">
    <div class="row">

      <!-- Left Column: Search -->
      <div class="col-lg-3 col-md-4">
        <section id="search" class="mt-5">
          <div class="ps-3">
            <p>Search Products</p>
            <hr>
          </div>
          <form action="shop.php"  method="POST">
            <div class="row ms-1">
              <div class="col-12">
                <p>Category</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="category" id="cat1" value="Restaurant Deals"><label class="form-check-label" for="cat1" >Restaurant Deals</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="category" id="cat2" value="Food & Drink"><label class="form-check-label" for="cat2" >Food & Drink</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="category" id="cat3" value="E-services"><label class="form-check-label" for="cat3" >E-services</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="category" id="cat4" value="Super Market Deals"><label class="form-check-label" for="cat4" >Super Market Deals</label></div>
              </div>
            </div>
            <div class="row mt-4 ms-1">
              <div class="col-12">
                <p>Price</p>
                <input type="range" class="form-range w-100"  value="1000" name="price" min="1" max="1000" id="customer">
                <div class="w-100">
                  <span style="float:left">1</span>
                  <span style="float:right">1000</span>
                </div>
              </div>
            </div>
            <div class="form-group my-3 ms-1">
              <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
          </form>
        </section>
      </div>

      <!-- Right Column: Products -->
      <div class="col-lg-9 col-md-8">
        <section id="featured">
          <div class="mt-5 py-2">
            <h3>Our Centralized RwaDiscounts</h3>
            <hr>
            <p>Here you can check out our new amazing deals</p>
          </div>

          <div class="row mx-auto container ">

          <?php  while($row=$products->fetch_assoc())  { ?>
            <!-- Product Cards Here -->
            <div  class="product text-center col-lg-4 col-md-6 col-sm-12">
              <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>" alt="">
              <div class="star"><i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
              <h5 class="p-name"><?php echo $row['product_name'];?></h5>
              <h4 class="p-price">FRW<?php echo  $row['product_price'];?></h4>
              <a class=" btn shop-buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Buy Now</a>
            </div>
           <?php } ?>
            <!-- Add more product cards here as needed -->
          </div>

          <!-- Pagination -->
          <nav aria-label="Page navigation example">
            <ul class="pagination mt-5">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </section>
      </div>

    </div>
  </div>
</section>

 <!-- footer -->
<?php include('layout/footer.php');?>