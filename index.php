<?php
include('server/connection.php');
$slides = [];
$query = "SELECT * FROM slides ORDER BY slide_id ASC";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $slides[] = $row;
}
?>
<?php
// Connect to the database
require_once('server/connection.php');

// Fetch all active subscribers/cards
$stmt = $conn->prepare("SELECT * FROM cards WHERE status = 'active' ORDER BY card_id DESC");
$stmt->execute();
$cards = $stmt->get_result();
?>

<?php include('layout/header.php');?>
<!-- Home -->
<section id="home">
  <div class="home-container">
    <!-- Left: Slideshow -->
    <div class="home-left">
      <div class="slideshow">
      <button class="arrow left" onclick="prevSlide()">&#10094;</button>
        <img src="" alt="slide" id="slide-img" />
      <button class="arrow right" onclick="nextSlide()">&#10095;</button>
      </div>
      <div class="dots">
        <span class="dot active" onclick="setSlide(0)"></span>
        <span class="dot" onclick="setSlide(1)"></span>
        <span class="dot" onclick="setSlide(2)"></span>
        <span class="dot" onclick="setSlide(3)"></span>
        <span class="dot" onclick="setSlide(4)"></span>
      </div>
    </div>
    <!-- Right: Cards -->
   <!-- Right: Cards -->
<div class="home-right">
  <div class="card-grid">
    <?php while ($card = $cards->fetch_assoc()): ?>
      <a href="https://wa.me/<?php echo htmlspecialchars($card['whatsapp_number']); ?>" class="card">
        <img src="assets/imgs/<?php echo htmlspecialchars($card['image_url']); ?>" alt="Subscriber Image" />
      </a>
    <?php endwhile; ?>
  </div>
</div>
</div>
</section>

<!-- Brand -->
<section id="brand" class="container py-3">
  <div class="row justify-content-center align-items-center text-center">
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <img src="assets/imgs/brand1.jpg" alt="Brand Logo" class="img-fluid" style="max-height: 60px;">
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <img src="assets/imgs/brand1.jpg" alt="Brand Logo" class="img-fluid" style="max-height: 60px;">
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <img src="assets/imgs/brand1.jpg" alt="Brand Logo" class="img-fluid" style="max-height: 60px;">
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <img src="assets/imgs/brand1.jpg" alt="Brand Logo" class="img-fluid" style="max-height: 60px;">
    </div>
  </div>
</section>
<!-- Today deals -->
<section id="new" class="w-100 py-4">
  <div class="container-fluid px-2">
    <div class="row gx-2 gy-2 justify-content-center">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="one">
          <img src="assets/imgs/pizza.jpeg" class="img-fluid" alt="Pizza">
          <div class="details">
            <h5>Awesome Shoes</h5>
            <button class="btn btn-dark text-uppercase">Shop Now</button>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="one">
          <img src="assets/imgs/brand1.jpg" class="img-fluid" alt="Jacket">
          <div class="details">
            <h5>Awesome Jacket</h5>
            <button class="btn btn-dark text-uppercase">Shop Now</button>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="one">
          <img src="assets/imgs/brand1.jpg" class="img-fluid" alt="Watch">
          <div class="details">
            <h5>50% Off Watches</h5>
            <button class="btn btn-dark text-uppercase">Shop Now</button>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="one">
          <img src="assets/imgs/pizza.jpeg" class="img-fluid" alt="Pizza Deal">
          <div class="details">
            <h5>Hot Pizza Deal</h5>
            <button class="btn btn-dark text-uppercase">Shop Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Restaurant and Alimentation and Supermarket -->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Restaurant||Alimentation|SuperMarket|Bakery</h3>
    <hr class="mx-auto">
    <p>Here you can check out our new features products </p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('server/get_featured_products.php'); ?>
    <?php while($row = $featured_products->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
          <button class="buy-btn">Reserve Now</button>
        </a>
      </div>
    <?php } ?>
  </div>
</section>
<!-- Banner -->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4 style="color: coral;font-size:30px;">MID SEASONS Sales</h4>
    <h1>Automn Collection <br>UP to 30% Off</h1>
    <button class="text-uppercase">shop now</button>
  </div>
</section>
<!-- Kigali Beaut -->
<section id="kigali_beaut" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Restaurant||Alimentation|SuperMarket|Bakery</h3>
    <hr class="mx-auto">
    <p>Here you can check out our new features products </p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('server/get_featured_products.php'); ?>
    <?php while($row = $featured_products->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
          <button class="buy-btn">Reserve Now</button>
        </a>
      </div>
    <?php } ?>
  </div>
</section>
<!-- E-services -->
<section id="e-services" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>E-Services</h3>
    <hr class="mx-auto">
    <p>Here you can check out our new amazing restaurant deals </p>
  </div>
  <div class="row mx-auto container-fluid">
    <!-- Static Products Here -->
  </div>
</section>
<!-- Drugs and Drink -->
<section id="foodrink" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>Best Discounts on Drink and Drugs</h3>
    <hr class="mx-auto">
    <p>Here you can check out our new amazing on Drugs and Drink deals </p>
  </div>
  <div class="row mx-auto container-fluid">
    <!-- Static Products Here -->
  </div>
</section>
<?php include('layout/footer.php'); ?>
