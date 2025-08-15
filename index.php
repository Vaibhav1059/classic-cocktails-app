<?php 
include('include/header.php');
?>

<!-- Hero Banner -->
<section class="hero-section d-flex justify-content-center align-items-center text-white">
  <div class="container position-relative">
    <h1 class="display-5 fw-bold mb-3" data-aos="fade-down">
      Welcome to Classic Cocktails Café
    </h1>
    <p class="lead mb-4" data-aos="fade-up">
      Sip. Savor. Socialize. Experience mixology like never before.
    </p>
    <a href="Reservation.php" class="btn btn-warning btn-lg">Book a Table</a>
  </div>
</section>

<!-- About Section -->
  <section id="about" class="position-relative py-5">
    <div id="particles-js"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 px-4 py-4" data-aos="fade-right">
          <img src="Public/Images/about-cafe.jpg" class="img-fluid rounded shadow" alt="About Us">
        </div>
        <div class="col-md-6 px-4 " data-aos="fade-left">
          <div class="section-title mb-4">
            <h5 class="text-warning fst-italic">Our story</h5>
            <h2 class="fw-bold">Few words about us</h2>
            <div class="mb-3" style="width: 60px; height: 4px; background: #bfa26a;"></div>
          </div>
          <p>
            At <strong>Classic Cocktails Café</strong>, we blend the art of cocktails with a passion for gourmet flavors.
            Whether you're here to unwind or celebrate, our menu and ambiance create the perfect vibe.
          </p>
          <a href="about.php" class="btn btn-warning mt-3">Explore Our Menu <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </section>

<!-- Meet Our Chefs -->
<section>
  <div class="container">
    <h2 class="fw-bold text-warning text-center mb-5" data-aos="fade-up">Meet Our Chefs</h2>
    <div class="row g-4" data-aos="flip-down">

      <!-- Chef Card -->
      <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 chef-card ">
          <img src="Public/Images/special1.jpg" class="card-img-top rounded-top-4" alt="Chef Raj">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold mb-1">Chef Raj Verma</h5>
            <p class="card-subtitle text-muted mb-2 small">Executive Chef</p>
            <p class="card-text small">Specializes in fusion cuisine, blending traditional Indian flavors with modern twists.</p>
          </div>
        </div>
      </div>

      <!-- Chef Card -->
      <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 chef-card">
          <img src="Public/Images/special2.jpg" class="card-img-top rounded-top-4" alt="Chef Maria">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold mb-1">Chef Maria Lopez</h5>
            <p class="card-subtitle text-muted mb-2 small">Pastry Artist</p>
            <p class="card-text small">Crafts decadent desserts with a delicate touch of European patisserie excellence.</p>
          </div>
        </div>
      </div>

      <!-- Chef Card -->
      <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 chef-card ">
          <img src="Public/Images/special3.jpg" class="card-img-top rounded-top-4" alt="Chef Omar">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold mb-1">Chef Omar Sheikh</h5>
            <p class="card-subtitle text-muted mb-2 small">Mixologist</p>
            <p class="card-text small">Award-winning mixologist known for unique cocktail innovations and flavor balance.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- Slider Section -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="fw-bold text-warning mb-4" data-aos="fade-up">Chef's Highlights</h2>
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade shadow rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-inner" data-aos="fade-up">
          <div class="carousel-item active">
            <img src="Public/Images/slider3.jpg" class="d-block w-100 slider-img" alt="slider image">
          </div>
          <div class="carousel-item">
            <img src="Public/Images/slider4.jpg" class="d-block w-100 slider-img" alt="slider image">
          </div>
          <div class="carousel-item">
            <img src="Public/Images/slider5.jpg" class="d-block w-100 slider-img" alt="slider image">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </section>

<!-- Explore -->
<section class="py-5 text-white bg-dark" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="fw-bold text-warning mb-4" data-aos="fade-down" data-aos-delay="200">Explore Our Menu</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- Appetizers Card -->
      <div class="col">
        <div class="card card_explore h-100 border-0 shadow-sm">
          <img src="Public/Images/appetizers.jpg" class="card_explore-img-top mb-3" alt="Appetizers">
          <div class="card-body">
            <h5 class="card-title fw-semibold text-white">Appetizers</h5>
            <p class="card-text text-light">Start your journey with savory bites and creative small plates.</p>
            <span class="badge bg-danger mb-2">New</span>
            <div class="text-warning mb-1">★★★★☆ <span class="text-muted">(112 reviews)</span></div>
            <p class="text-muted mb-2">₹199 - ₹299</p>
            <a href="appetizers.php" class="btn btn-sm btn-warning">See More</a>
          </div>
        </div>
      </div>

      <!-- Main Course Card -->
      <div class="col">
        <div class="card card_explore h-100 border-0 shadow-sm">
          <img src="Public/Images/maincourse.jpg" class="card_explore-img-top mb-3" alt="Main Course">
          <div class="card-body">
            <h5 class="card-title fw-semibold text-white">Main Course</h5>
            <p class="card-text text-light">Indulge in gourmet main dishes made with passion and precision.</p>
            <span class="badge bg-success mb-2">Bestseller</span>
            <div class="text-warning mb-1">★★★★★ <span class="text-muted">(264 reviews)</span></div>
            <p class="text-muted mb-2">₹399 - ₹799</p>
            <a href="maincourse.php" class="btn btn-sm btn-warning">See More</a>
          </div>
        </div>
      </div>

      <!-- Signature Drinks Card -->
      <div class="col">
        <div class="card card_explore h-100 border-0 shadow-sm">
          <img src="Public/Images/drinks.jpg" class="card_explore-img-top mb-3" alt="Drinks">
          <div class="card-body">
            <h5 class="card-title fw-semibold text-white">Signature Drinks</h5>
            <p class="card-text text-light">Sip on our curated collection of cocktails, mocktails and beverages.</p>
            <span class="badge bg-info text-dark mb-2">Popular</span>
            <div class="text-warning mb-1">★★★★☆ <span class="text-muted">(85 reviews)</span></div>
            <p class="text-muted mb-2">₹149 - ₹299</p>
            <a href="cocktails.php" class="btn btn-sm btn-warning">See More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Reservation CTA Banner -->
  <section class="reservation-cta">
    <div class="container">
      <h3 data-aos="zoom-in">✨ Reserve Your Experience ✨</h3>
      <p data-aos="fade-up">Secure your spot and enjoy handcrafted flavors, curated ambiance, and unforgettable moments.</p>
      <a href="Reservation.php" class="glow-btn" data-aos="fade-up">Book a Table</a>
    </div>
  </section>

<!-- TOAST Notification -->
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast show text-bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="Public/Images/log.jpeg" class="rounded me-2" alt="Logo" width="20">
        <strong class="me-auto">Classic Cocktails Café</strong>
        <small>Just now</small>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        “Step into a world of timeless cocktails. Cheers to great taste!”
      </div>
    </div>
  </div>

	<?php
			include('include/footer.php');
		?>