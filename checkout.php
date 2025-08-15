<?php
// Include your main configuration file (it starts the session)
require_once 'Config/config.php';

// --- SECURITY CHECK ---
// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // We can also store the page they wanted to visit
    $_SESSION['redirect_url'] = 'checkout.php';
    header("location: login.php?notice=loginrequired");
    exit;
}
?>

<?php include('include/header.php'); ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Checkout</h1>
        <p class="lead text-white-50">Please confirm your order details below.</p>
    </div>

    <div class="row g-5">
        <!-- Left Column: Order Form -->
        <div class="col-lg-7">
            <div class="card text-bg-dark border-secondary">
                <div class="card-header">
                    <h4>Your Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="controller/controller.php">
                        <!-- Hidden input to carry cart data -->
                        <input type="hidden" name="cart_data" id="cart_data_input">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_fullname']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tableNumber" class="form-label">Table Number (if dining in)</label>
                            <input type="text" class="form-control" id="tableNumber" name="table_number" placeholder="e.g., 12">
                        </div>
                        <div class="mb-3">
                            <label for="specialInstructions" class="form-label">Special Instructions</label>
                            <textarea class="form-control " id="specialInstructions" name="special_instructions" rows="3" placeholder="e.g., less spicy, no nuts..." ></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="place_order" class="btn btn-lg btn-warning w-100 fw-bold">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="col-lg-5">
            <div class="card text-bg-dark border-secondary">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body" id="order-summary-items">
                    <!-- Summary items will be loaded here -->
                </div>
                <div class="card-footer" id="order-summary-total">
                    <!-- Summary total will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const summaryItemsContainer = document.getElementById('order-summary-items');
    const summaryTotalContainer = document.getElementById('order-summary-total');
    const cartDataInput = document.getElementById('cart_data_input');

    if (cart.length === 0) {
        // If cart is empty, redirect to home
        window.location.href = 'index.php';
        return;
    }

    // Put cart data into the hidden form field
    cartDataInput.value = JSON.stringify(cart);

    let summaryHTML = '<ul class="list-group list-group-flush">';
    let subtotal = 0;

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        summaryHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-light border-secondary px-0">
                <div>
                    ${item.name} <small class="text-white-50">x ${item.quantity}</small>
                </div>
                <span>₹${itemTotal.toFixed(2)}</span>
            </li>
        `;
    });
    summaryHTML += '</ul>';
    summaryItemsContainer.innerHTML = summaryHTML;

    // Calculate totals
    const tax = subtotal * 0.05;
    const total = subtotal + tax;

    summaryTotalContainer.innerHTML = `
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary px-0">
                <span>Subtotal</span>
                <span>₹${subtotal.toFixed(2)}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary px-0">
                <span>GST (5%)</span>
                <span>₹${tax.toFixed(2)}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary fs-5 fw-bold px-0">
                <span class="text-warning">Grand Total</span>
                <span class="text-warning">₹${total.toFixed(2)}</span>
            </li>
        </ul>
    `;
});
</script>