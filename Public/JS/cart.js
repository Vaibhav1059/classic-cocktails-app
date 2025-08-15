document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // --- Element Selectors ---
    const offcanvasElement = document.getElementById('offcanvasCart');
    if (!offcanvasElement) return;
    const cartOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartFooterContainer = document.getElementById('cart-footer');
    const cartIcon = document.querySelector('.cart-icon');

    // --- Main Functions ---
    const saveCart = () => {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartIcon();
    };

    const updateCartIcon = () => {
        if (!cartIcon) return;
        const countBadge = cartIcon.querySelector('.badge');
        if (!countBadge) return;
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        countBadge.textContent = totalItems;
        countBadge.style.display = totalItems > 0 ? 'block' : 'none';
    };

    // --- NEW AND IMPROVED RENDER FUNCTION ---
    const renderCart = () => {
        if (!cartItemsContainer || !cartFooterContainer) return;

        cartItemsContainer.innerHTML = '';
        cartFooterContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p class="text-center text-white-50 mt-4">Your cart is empty.</p>';
            updateCartIcon();
            return;
        }

        let total = 0;
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            // Create a more professional-looking cart item card
            const cartItemHTML = `
                <div class="card text-bg-dark mb-2">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 text-warning">${item.name}</h6>
                            <small class="text-white-50">Price: ₹${item.price.toFixed(2)}</small>
                        </div>
                        
                        <div class="input-group" style="width: 120px;">
                            <button class="btn btn-sm btn-outline-secondary quantity-change" data-name="${item.name}" data-change="-1">-</button>
                            <input type="text" class="form-control form-control-sm text-center" value="${item.quantity}" readonly>
                            <button class="btn btn-sm btn-outline-secondary quantity-change" data-name="${item.name}" data-change="1">+</button>
                        </div>

                        <div style="width: 80px;" class="text-end">
                            <span class="fw-bold">₹${itemTotal.toFixed(2)}</span>
                        </div>
                        
                        <button class="btn btn-sm btn-outline-danger remove-from-cart" data-name="${item.name}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            cartItemsContainer.innerHTML += cartItemHTML;
        });

        cartFooterContainer.innerHTML = `
                <div class="d-flex justify-content-between fw-bold mb-3 fs-5 border-top border-warning pt-3">
                    <span class="text-warning">Subtotal:</span>
                    <span>₹${total.toFixed(2)}</span>
                </div>
                <div class="d-grid gap-2">
                    <a href="cart.php" class="btn btn-outline-light">
                        <i class="bi bi-cart-check me-2"></i>View Full Cart
                    </a>
                    <a href="checkout.php" class="btn btn-warning fw-bold">
                        <i class="bi bi-shield-check me-2"></i>Proceed to Checkout
                    </a>
                </div>
                `;
        updateCartIcon();
    };

    // --- Event Handlers ---
    const handleAddToCart = (button) => {
        const name = button.dataset.name;
        const price = parseInt(button.dataset.price, 10);
        if (!name || isNaN(price)) return;

        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        saveCart();
        renderCart();
        cartOffcanvas.show();
    };
    
    // NEW function to handle + and - buttons
    const handleQuantityChange = (name, change) => {
        const item = cart.find(item => item.name === name);
        if (!item) return;

        item.quantity += change; // change is +1 or -1

        if (item.quantity <= 0) {
            // If quantity is 0 or less, remove the item
            handleRemoveFromCart(name);
        } else {
            saveCart();
            renderCart();
        }
    };

    const handleRemoveFromCart = (name) => {
        cart = cart.filter(item => item.name !== name);
        saveCart();
        renderCart();
    };

    // --- Main Event Listener ---
    document.body.addEventListener('click', (e) => {
        const addToCartBtn = e.target.closest('.add-to-cart');
        if (addToCartBtn) {
            handleAddToCart(addToCartBtn);
        }

        const removeBtn = e.target.closest('.remove-from-cart');
        if (removeBtn) {
            handleRemoveFromCart(removeBtn.dataset.name);
        }
        
        // Listener for the new quantity buttons
        const quantityBtn = e.target.closest('.quantity-change');
        if (quantityBtn) {
            const name = quantityBtn.dataset.name;
            const change = parseInt(quantityBtn.dataset.change, 10);
            handleQuantityChange(name, change);
        }
    });

    // Initial render on page load
    renderCart();
});