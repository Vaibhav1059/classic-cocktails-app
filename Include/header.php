<?php
include 'Config/config.php'
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Classic Cocktails With A Twist</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- AOS Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" href="Public/Images/log.jpeg" sizes="16x16" >
  <link rel="stylesheet" type="text/css" href="Public/CSS/style.css">
</head>
<body id="top">
<!-- Top Header -->
<div class="d-none d-lg-block bg-light border-bottom py-2">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="lang-wrap">
      <a href="#" class="text-dark fw-semibold">EN</a><span class="mx-1">/</span><a href="#" class="text-dark">FR</a>
    </div>
    <div class="contact-info">
      <a href="tel:8619521162" class="text-dark me-3"><strong>Call:</strong> 8619521162</a>
      <a href="mailto:cocktailscafe@gmail.com" class="text-dark"><strong>Email:</strong> cocktailscafe@gmail.com</a>
    </div>
  </div>
</div>

<!-- Main Header -->
<header class="header sticky-top shadow-sm">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile">
        <img src="Public/Images/images.jpeg" class="logo-img" alt="Logo">
        <span class="d-lg-none text-white fw-semibold">Cocktails</span>
      </a>

      <!-- Mobile Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse justify-content-between gap-2" id="navbarContent">
        <!-- Center Nav Links -->
        <ul class="navbar-nav mx-auto text-center gap-3">
          <li class="nav-item"><a href="index.php" class="nav-link text-white fw-semibold">Home</a></li>
          <li class="nav-item"><a href="about-us.php" class="nav-link text-white fw-semibold">About Us</a></li>

          <!-- Menu Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown">Menu</a>
            <ul class="dropdown-menu dropdown-animate">
              <li><a class="dropdown-item" href="appetizers.php">Appetizers</a></li>
              <li><a class="dropdown-item" href="maincourse.php">Main Course</a></li>
              <li><a class="dropdown-item" href="desserts.php">Desserts</a></li>
            </ul>
          </li>
          <!-- Drinks Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="drinksDropdown" role="button" data-bs-toggle="dropdown">Drinks</a>
            <ul class="dropdown-menu dropdown-animate">
              <li><a class="dropdown-item" href="cocktails.php">Cocktails</a></li>
              <li><a class="dropdown-item" href="mocktails.php">Mocktails</a></li>
              <li><a class="dropdown-item" href="familydrinks.php">Family Drinks</a></li>
              <li><a class="dropdown-item" href="breverages.php">Beverages</a></li>
            </ul>
          </li>

          <li class="nav-item"><a href="Reservation.php" class="nav-link text-white fw-semibold">Reservation</a></li>
          <li class="nav-item"><a href="Contact_Us.php" class="nav-link text-white fw-semibold">Contact Us</a></li>
        </ul>

        <!-- Right Icons -->
        <div class="d-flex align-items-center gap-2 buttons">
          <!-- Share -->
          <button class="btn btn-outline-light btn-sm" id="shareButton" title="Share">
            <i class="fa fa-bullhorn"></i>
          </button>

          <!-- Cart -->
          <button class="btn btn-outline-light btn-sm position-relative cart-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" title="View Cart">
            <i class="bi bi-cart-fill fs-4"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge" style="display: none;">0</span>
          </button>

          <!-- Profile Dropdown -->
          <div class="dropdown">
            <button class="btn btn-outline-light btn-sm dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-animate" aria-labelledby="profileDropdown">
              <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
              <li><h6 class="dropdown-header">Hello, <?php echo htmlspecialchars($_SESSION['user_fullname']); ?></h6></li>
              <li><a class="dropdown-item" href="my_profile.php">My Profile</a></li>
              <li><a class="dropdown-item" href="my_profile.php#reservations">My Reservations</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <?php else: ?>
              <li><a class="dropdown-item" href="login.php">Login</a></li>
              <li><a class="dropdown-item" href="register.php">Register</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- PROFILE LOGO OFFCANVAS  -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasProfile">
  <div class="offcanvas-header border-bottom border-secondary">
    <h5 class="offcanvas-title text-warning" style="font-family: 'Playfair Display', serif;">About Classic Cocktails</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <div class="text-center mb-4">
        <img src="Public/Images/images.jpeg" class="rounded-circle mb-3" width="100" alt="Founder Profile">
        <h5 class="mb-1">Vaibhav Soni</h5>
        <p class="text-white-50">Founder & Mixologist</p>
    </div>

    <p class="text-center fst-italic border-top border-bottom border-secondary py-3">
        "Our mission is to blend timeless techniques with a modern twist, creating an unforgettable experience in every glass."
    </p>

    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-transparent text-light border-0 d-flex gap-3">
            <i class="bi bi-clock fs-5 text-warning"></i>
            <div>
                <strong>Opening Hours</strong><br>
                <span class="text-white-50">Mon - Sun: 5:00 PM - 1:00 AM</span>
            </div>
        </li>
        <li class="list-group-item bg-transparent text-light border-0 d-flex gap-3">
            <i class="bi bi-telephone fs-5 text-warning"></i>
            <div>
                <strong>Contact Us</strong><br>
                <a href="tel:8619521162" class="text-white-50 text-decoration-none">8619521162</a>
            </div>
        </li>
        <li class="list-group-item bg-transparent text-light border-0 d-flex gap-3">
            <i class="bi bi-envelope fs-5 text-warning"></i>
            <div>
                <strong>Email</strong><br>
                <a href="mailto:vaibhavsoni1059@gmail.com" class="text-white-50 text-decoration-none">vaibhavsoni1059@gmail.com</a>
            </div>
        </li>
    </ul>

    <div class="text-center mt-4">
        <h6 class="text-uppercase text-white-50 mb-3">Follow Us</h6>
        <div class="d-flex justify-content-center gap-4">
          <a href="#" class="fs-4 text-light"><i class="fab fa-facebook"></i></a>
          <a href="#" class="fs-4 text-light"><i class="fab fa-twitter"></i></a>
          <a href="#" class="fs-4 text-light"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
  </div>

  <div class="offcanvas-footer p-3 text-center border-top border-secondary">
      <a href="about-us.php" class="btn btn-outline-warning">Learn More About Us</a>
  </div>
</div>


