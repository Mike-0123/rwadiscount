<!-- footer -->
<footer class="mt-5 py-5"> 
  <div class="row container mx-auto pt-5">
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <img src="assets/imgs/4.png" alt="" class="logo">
      <h2 class="brand">RwaDiscounts</h2>
      <p class="pt-3">We Provide the best deals and discounts daily</p>
    </div>
    
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Featured</h5>
      <ul class="text-uppercase list-unstyled">
        <li><a href="#">Men</a></li>
        <li><a href="#">Women</a></li>
        <li><a href="#">Boys</a></li>
        <li><a href="#">Girls</a></li>
        <li><a href="#">New Arrival</a></li>
        <li><a href="#">Clothes</a></li>
      </ul>
    </div>

    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Contact Us</h5>
      <div>
        <h6 class="text-uppercase">Address</h6>
        <p>123 Street Gisozi, Kigali</p>
      </div>
      <div>
        <h6 class="text-uppercase">Phone</h6>
        <p>+250735113459</p>
      </div>
      <div>
        <h6 class="text-uppercase">Email</h6>
        <p>rwandadiscount@gmail.com</p>
      </div>
    </div>

    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Instagram</h5>
      <div class="row">
        <img src="assets/imgs/4.png" alt="" class="img-fluid w-25 h-1 m-2">
        <img src="assets/imgs/4.png" alt="" class="img-fluid w-25 h-1 m-2">
        <img src="assets/imgs/4.png" alt="" class="img-fluid w-25 h-1 m-2">
        <img src="assets/imgs/4.png" alt="" class="img-fluid w-25 h-1 m-2">
        <img src="assets/imgs/4.png" alt="" class="img-fluid w-25 h-1 m-2">
      </div>
    </div>
  </div>

  <div class="copyright mt-5">
    <div class="row container mx-auto">
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <!-- <img src="assets/img/payment" alt=""> -->
         <P>WE ARE NO LONGER ACCEPT AN TERMS OF PAYMENT</P>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap">
        <p>Designed by RwaDiscounts @2025</p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <!-- WhatsApp Floating Button -->
  <a href="https://wa.me/250735113459" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i> <span class="twandikire-text">Twandikire</span>
  </a>
  <!-- New WhatsApp icon: Join Group -->
<!-- WhatsApp Floating Join Button -->
<a href="#" onclick="redirectUser()" class="whatsapp-join" target="_blank">
  <i class="fab fa-whatsapp"></i> <span class="join-text">Join</span>
</a>

</footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script>
    const images = [
      "assets/imgs/back.jpg",
      "assets/imgs/4.png",
      "assets/imgs/brand1.jpg",
      "assets/imgs/brand2.jpg",
      "assets/imgs/michel.png"
    ];
  let currentSlide = 0;
  const slideImg = document.getElementById("slide-img");
  const dots = document.querySelectorAll(".dot");

  function showSlide(index) {
    slideImg.src = images[index];
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
  }

  function setSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
  }

  function nextSlide() {
    currentSlide = (currentSlide + 1) % images.length;
    showSlide(currentSlide);
  }

  function prevSlide() {
    currentSlide = (currentSlide - 1 + images.length) % images.length;
    showSlide(currentSlide);
  }

  // Auto-slide every 3 seconds
  setInterval(nextSlide, 3000);



  function redirectUser() {
  const userType = localStorage.getItem('userType'); // Get user type from local storage

 
}
</script> -->
<script>
const images = <?php echo json_encode(array_map(function($slide) {
    return 'assets/imgs/' . $slide['photo'];
}, $slides)); ?>;

const whatsappNumbers = <?php echo json_encode(array_map(function($slide) {
    return $slide['whatsapp_number'];
}, $slides)); ?>;

let currentSlide = 0;
const slideImg = document.getElementById("slide-img");
const dots = document.querySelectorAll(".dot");

// Ubutumwa default bushyizwe muri variable
const defaultMessage = "I want this discount please twavugana byihuse";

function showSlide(index) {
    slideImg.src = images[index];
    dots.forEach(dot => dot.classList.remove("active"));
    if (dots[index]) dots[index].classList.add("active");

    // Redirect on click with default message
    slideImg.onclick = () => {
        window.location.href = `https://wa.me/${whatsappNumbers[index]}?text=${encodeURIComponent(defaultMessage)}`;
    };
}

function setSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % images.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + images.length) % images.length;
    showSlide(currentSlide);
}

setInterval(nextSlide, 4000);
showSlide(currentSlide);
</script>



<script>
function redirectUser() {
  const userType = localStorage.getItem('userType'); // Example: 'merchant' or 'general'

  if (userType === 'merchant') {
    window.open('https://chat.whatsapp.com/LyQubzOfM8q72f4VxrKYgF?mode=ac_t', '_blank');
  } else {
    window.open('https://chat.whatsapp.com/K8bf4nHkZZX1F72IeEpMIR?mode=ac_t', '_blank');
  }
}
</script>


</body>
</html>

