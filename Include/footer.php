<!-- FOOTER -->
<footer class="text-light pt-5 pb-4" style="background-color: #0f0f0f; font-family: 'Poppins', sans-serif;">
  <div class="container">
    <div class="row gy-5">

      <!-- About -->
      <div class="col-md-4">
        <h5 class="fw-semibold mb-3" style="color: #d4a857;">About Us</h5>
        <p class="small text-secondary">
          Classic Cocktails Café is where gourmet dining meets signature drinks. Our ambiance and flavors are curated to craft unforgettable moments.
        </p>
        <a href="about-us.php" class="text-decoration-none" style="color: #d4a857; font-size: 0.9rem;">Read more</a>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4">
        <h5 class="fw-semibold mb-3" style="color: #d4a857;">Contact Info</h5>
        <ul class="list-unstyled small lh-lg">
          <li><strong>Call:</strong> <span class="text-light ms-2">0141-2657653</span></li>
          <li><strong>Email:</strong> <a href="mailto:cocktailscafe@gmail.com" class="text-light ms-2 text-decoration-none">cocktailscafe@gmail.com</a></li>
          <li><strong>Address:</strong> <span class="text-light ms-2">123 Mixology Street, Jaipur</span></li>
        </ul>
        <a href="Contact_Us.php" class="text-decoration-none" style="color: #d4a857; font-size: 0.9rem;">Get in Touch</a>
      </div>

      <!-- Subscribe -->
      <div class="col-md-4">
        <h5 class="fw-semibold mb-3" style="color: #d4a857;">Stay Updated</h5>
        <p class="small text-secondary">Get alerts on new dishes, events & exclusive offers. No spam, we promise.</p>
        <form class="d-flex mt-2" action="#" method="post">
          <input type="email" class="form-control bg-dark text-light border-0 rounded-0 me-2" placeholder="Your Email" required>
          <button type="submit" class="btn rounded-0" style="background-color: #d4a857; color: #111;">Send</button>
        </form>
      </div>

    </div>

    <!-- Scroll Button -->
<div id="scrollToTopInFooter" class="d-flex justify-content-center mt-4" data-aos="fade-up">
  <a href="#top" class="footer-scroll-btn d-flex align-items-center justify-content-center">
    <i class="bi bi-chevron-up"></i>
  </a>
</div>

    <hr class="border-secondary">
    <!-- Footer Bottom -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
      <div>© 2025 <span class="text-warning">Classic Cocktails Café</span>. All rights reserved.</div>
      <div class="d-flex gap-3 mt-3 mt-md-0">
        <a href="#" class="text-light"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
        <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- PRE-FOOTER -->
<div id="preFooter" class="pre-footer d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 text-center text-md-start py-2 px-3 bg-dark border-top border-secondary-subtle shadow-sm sticky-bottom z-3">
  <div class="left-links d-flex gap-3 flex-wrap justify-content-center justify-content-md-start">
    <a href="about-us.php" class="text-light fw-medium text-decoration-none">ABOUT US</a>
    <a href="maincourse.php" class="text-light fw-medium text-decoration-none">MENU 🍸</a>
  </div>

  <div class="announcement text-warning fw-semibold small">
    Happy Hours 5PM–7PM Daily!
  </div>

  <div class="action-btn">
    <a href="Reservation.php" class="btn btn-warning btn-sm rounded-pill fw-medium px-3">Book a Table</a>
  </div>
</div>

<!-- Cart Offcanvas cart in footer -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
  <div class="offcanvas-header border-bottom border-warning">
    <h5 class="offcanvas-title text-warning" id="offcanvasCartLabel">Your Cart</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="cart-items-container">
        <p class="text-center text-white-50">Your cart is empty.</p>
    </div>
    <div id="cart-footer">
        <!-- Cart total and buttons will be dynamically inserted here -->
    </div>
  </div>
</div>
<!-- Share karne ka button -->
<div class="modal fade" id="shareModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Share this Page</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Share this link via</p>
        <div class="d-flex justify-content-around mb-3">
            <a id="shareFacebook" href="#" target="_blank" class="fs-2 text-primary"><i class="fab fa-facebook-square"></i></a>
            <a id="shareTwitter" href="#" target="_blank" class="fs-2 text-info"><i class="fab fa-twitter-square"></i></a>
            <a id="shareWhatsApp" href="#" target="_blank" class="fs-2 text-success"><i class="fab fa-whatsapp-square"></i></a>
            <a id="shareEmail" href="#" class="fs-2 text-secondary"><i class="fas fa-envelope-square"></i></a>
        </div>
        <div class="input-group">
            <input type="text" class="form-control" value="<?php echo $sitURL . $_SERVER['REQUEST_URI']; ?>" id="shareLinkInput" readonly>
            <button class="btn btn-outline-secondary" type="button" id="copyLinkBtn">Copy</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!--Particle.js --><script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script type="text/javascript" src="Public/JS/style.js"></script>
  <script type="text/javascript" src="Public/JS/cart.js"></script>

</body>
</html>