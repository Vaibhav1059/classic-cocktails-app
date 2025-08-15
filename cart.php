<?php include('include/header.php'); ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Your Shopping Cart</h1>
        <p class="lead text-white-50">Review your items before proceeding to checkout.</p>
    </div>

    <div class="card text-bg-dark border-secondary">
        <div class="card-body">
            <div id="full-cart-container" class="table-responsive">
                <!-- Cart items will be loaded here by JavaScript -->
            </div>
        </div>
        <div class="card-footer border-top border-secondary p-4" id="full-cart-summary">
            <!-- Cart summary (subtotal, tax, total) will be loaded here -->
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>

<!-- ============================================= -->
<!-- == JAVASCRIPT FOR THIS PAGE == -->
<!-- ============================================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartContainer = document.getElementById('full-cart-container');
    const cartSummaryContainer = document.getElementById('full-cart-summary');

    const saveCart = () => {
        localStorage.setItem('cart', JSON.stringify(cart));
        // We also need to update the main cart icon in the header
        // This assumes your main cart.js script is also loaded on this page
        // If not, you might need to duplicate the updateCartIcon function here.
    };

    const renderFullCart = () => {
        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-center p-5">Your cart is empty. <a href="index.php" class="text-warning">Continue Shopping</a></p>';
            cartSummaryContainer.style.display = 'none';
            return;
        }

        let subtotal = 0;
        let tableHTML = `
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 50%;">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
        `;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            tableHTML += `
                <tr>
                    <td>
                        <h6 class="mb-0 text-warning">${item.name}</h6>
                        <small class="text-white-50">Unit Price: ₹${item.price.toFixed(2)}</small>
                    </td>
                    <td class="text-center">
                        <div class="input-group justify-content-center" style="width: 120px; margin: auto;">
                            <button class="btn btn-sm btn-outline-secondary quantity-change" data-name="${item.name}" data-change="-1">-</button>
                            <input type="text" class="form-control form-control-sm text-center" value="${item.quantity}" readonly>
                            <button class="btn btn-sm btn-outline-secondary quantity-change" data-name="${item.name}" data-change="1">+</button>
                        </div>
                    </td>
                    <td class="text-end">₹${itemTotal.toFixed(2)}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-danger remove-from-cart" data-name="${item.name}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        tableHTML += `</tbody></table>`;
        cartContainer.innerHTML = tableHTML;

        // Calculate totals
        const tax = subtotal * 0.05; // 5% GST
        const total = subtotal + tax;

        cartSummaryContainer.innerHTML = `
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary">
                            <span>Subtotal</span>
                            <span>₹${subtotal.toFixed(2)}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary">
                            <span>GST (5%)</span>
                            <span>₹${tax.toFixed(2)}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-transparent text-light border-secondary fs-5 fw-bold">
                            <span class="text-warning">Grand Total</span>
                            <span class="text-warning">₹${total.toFixed(2)}</span>
                        </li>
                    </ul>
                    <div class="d-grid mt-4">
                        <a href="checkout.php" class="btn btn-lg btn-warning fw-bold">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        `;
        cartSummaryContainer.style.display = 'block';
    };

    // Event handlers for quantity change and remove
    const handleQuantityChange = (name, change) => {
        let item = cart.find(i => i.name === name);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                cart = cart.filter(i => i.name !== name);
            }
            saveCart();
            renderFullCart();
        }
    };

    const handleRemoveFromCart = (name) => {
        cart = cart.filter(i => i.name !== name);
        saveCart();
        renderFullCart();
    };

    document.body.addEventListener('click', (e) => {
        if (e.target.closest('.quantity-change')) {
            const btn = e.target.closest('.quantity-change');
            handleQuantityChange(btn.dataset.name, parseInt(btn.dataset.change));
        }
        if (e.target.closest('.remove-from-cart')) {
            handleRemoveFromCart(e.target.closest('.remove-from-cart').dataset.name);
        }
    });

    renderFullCart();
});
</script>