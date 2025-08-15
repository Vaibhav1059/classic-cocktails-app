<?php include('include/header.php'); ?>

<div class="container my-5 text-center">
    <div class="py-5">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 6rem;"></i>
        <h1 class="display-4 fw-bold mt-4" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Thank You!</h1>
        <p class="lead text-white-50 col-lg-6 mx-auto">Your order has been placed successfully. Our team will begin preparing it shortly.</p>
        <hr class="my-4" style="color: #D4AF37;">
        <p class="text-white-50">You can view your order history in your profile.</p>
        <a href="my_profile.php#reservations" class="btn btn-outline-warning me-2">View My Orders</a>
        <a href="index.php" class="btn btn-warning">Back to Home</a>
    </div>
</div>

<?php include('include/footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Clear the cart from local storage
        localStorage.removeItem('cart');

        // This is a failsafe to also update the cart icon in the header immediately
        const cartIcon = document.querySelector('.cart-icon .badge');
        if (cartIcon) {
            cartIcon.textContent = '0';
            cartIcon.style.display = 'none';
        }
    });
</script>