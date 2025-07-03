<?php
// Start session to check if user is logged in
session_start();

// Check if user is logged in - if not, redirect to login
if (!isset($_SESSION['user']) || !isset($_SESSION['registration'])) {
    // Store the checkout URL to redirect back after login
    $_SESSION['redirect_after_login'] = 'checkout.php';
    header('Location: login.php?message=Please log in to proceed with checkout');
    exit();
}

// Product data for order summary reference
$products = [
    1 => ['id' => 1, 'name' => 'Iced Americano', 'price' => 90, 'image' => 'coffee/americano.jpg'],
    2 => ['id' => 2, 'name' => 'Black Forest', 'price' => 160, 'image' => 'coffee/Black Forest.jpg'],
    3 => ['id' => 3, 'name' => 'Citrus Black', 'price' => 5.00, 'image' => 'coffee/Circuits Black.png'],
    4 => ['id' => 4, 'name' => 'Dirty Matcha', 'price' => 120, 'image' => 'coffee/Dirty Matcha.jpg'],
    5 => ['id' => 5, 'name' => 'Iced Latte', 'price' => 100, 'image' => 'coffee/Iced Latte.jpg'],
    6 => ['id' => 6, 'name' => 'Matcha', 'price' => 100, 'image' => 'coffee/matcha.jpg'],
    7 => ['id' => 7, 'name' => 'Sea Salt Latte', 'price' => 120, 'image' => 'coffee/Sea Salt Latte.jpg'],
    8 => ['id' => 8, 'name' => 'Strawberry Matcha', 'price' => 120, 'image' => 'coffee/strawberry matcha.jpg'],
    9 => ['id' => 9, 'name' => 'Spanich Latte', 'price' => 2.50, 'image' => 'coffee/Spanich latte.jpg'],
    10 => ['id' => 10, 'name' => 'Black Curant', 'price' => 2.25, 'image' => 'coffee/Black Curant.jpg'],
    11 => ['id' => 11, 'name' => 'Iced Biscoff Latte', 'price' => 3.00, 'image' => 'coffee/Iced Biscoff Latte.jpg'],
    12 => ['id' => 12, 'name' => 'Latte', 'price' => 2.75, 'image' => 'coffee/Latte.jpg'],
    13 => ['id' => 13, 'name' => 'Lemon', 'price' => 1.75, 'image' => 'coffee/Lemon.jpg'],
    14 => ['id' => 14, 'name' => 'Banana Bread Slice', 'price' => 2.00, 'image' => 'pastry/Banana Bread.jpg'],
    15 => ['id' => 15, 'name' => 'Brownies', 'price' => 12.99, 'image' => 'pastry/Brownies.jpg'],
    16 => ['id' => 16, 'name' => 'Cake', 'price' => 15.99, 'image' => 'pastry/cake.jpg'],
    17 => ['id' => 17, 'name' => 'Cookies', 'price' => 14.50, 'image' => 'pastry/cookies.jpg'],
    18 => ['id' => 18, 'name' => 'Salted Cream Cheese', 'price' => 11.99, 'image' => 'pastry/Salted Cream Cheese.jpg']
];

// Get user information from session
$user_data = $_SESSION['registration'] ?? [];
$user_name = $user_data['fullname'] ?? 'Guest';
$user_email = $user_data['email'] ?? '';

// Handle order placement
$order_success = false;
if ($_POST && isset($_POST['place_order'])) {
    // Here you would normally process the order and save to database
    // For now, we'll just simulate a successful order
    $order_success = true;
    
    // Clear the cart after successful order
    echo "<script>localStorage.removeItem('cart');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checkout - Momento Coffee Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
  body {
    background-color: #fdf6f0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .navbar, footer {
    background-color: #4b2e2e;
  }

  .navbar-brand, .nav-link, footer p {
    color: #fff !important;
    font-weight: 600;
    letter-spacing: 0.5px;
  }

  .nav-link.btn {
    color: #fff !important;
    background-color: #7b4a2d;
    margin-left: 10px;
    padding: 8px 16px;
    border-radius: 20px;
  }

  .nav-link.btn:hover {
    background-color: #5c3522;
  }

  .nav-link.active {
    color: #f4c2a1 !important;
  }

  .cart-icon {
    position: relative;
    color: #fff !important;
    font-size: 1.2rem;
    text-decoration: none;
    display: inline-block;
    padding: 8px 12px;
  }

  .cart-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #dc3545;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.7rem;
    font-weight: 600;
    min-width: 18px;
    text-align: center;
  }

  .page-header {
    background: linear-gradient(135deg, #6f4e37, #4b2e2e);
    color: white;
    padding: 60px 0;
    margin-bottom: 40px;
  }

  .page-header h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 10px;
  }

  .user-welcome {
    background: #fffaf3;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid #e8dcd3;
  }

  .user-welcome h4 {
    color: #4b2e2e;
    margin-bottom: 10px;
  }

  .user-welcome p {
    color: #6f4e37;
    margin: 0;
  }

  .checkout-container {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #4b2e2e;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e8dcd3;
  }

  .form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #d3c1b0;
    padding: 12px 16px;
    margin-bottom: 15px;
  }

  .form-control:focus, .form-select:focus {
    border-color: #a57c5b;
    box-shadow: 0 0 0 0.15rem rgba(165, 124, 91, 0.25);
  }

  .form-label {
    font-weight: 600;
    color: #4b2e2e;
    margin-bottom: 8px;
  }

  .payment-method {
    border: 2px solid #e8dcd3;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .payment-method:hover {
    border-color: #a57c5b;
  }

  .payment-method.selected {
    border-color: #6f4e37;
    background-color: #fffaf3;
  }

  .payment-method input[type="radio"] {
    margin-right: 10px;
  }

  .payment-icon {
    font-size: 1.5rem;
    margin-right: 10px;
    color: #6f4e37;
  }

  .order-summary {
    background: #fffaf3;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    position: sticky;
    top: 20px;
  }

  .order-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #e8dcd3;
  }

  .order-item:last-child {
    border-bottom: none;
  }

  .order-item-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
  }

  .order-item-info {
    flex: 1;
  }

  .order-item-name {
    font-weight: 600;
    color: #4b2e2e;
    font-size: 0.9rem;
    margin-bottom: 3px;
  }

  .order-item-quantity {
    color: #6f4e37;
    font-size: 0.8rem;
  }

  .order-item-price {
    font-weight: 600;
    color: #6f4e37;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e8dcd3;
  }

  .summary-row:last-child {
    border-bottom: none;
    font-weight: 700;
    font-size: 1.2rem;
    color: #4b2e2e;
    margin-top: 10px;
    padding-top: 15px;
  }

  .btn-place-order {
    background-color: #6f4e37;
    border: none;
    color: white;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    width: 100%;
    margin-top: 20px;
    transition: all 0.3s ease;
  }

  .btn-place-order:hover {
    background-color: #543828;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
  }

  .btn-back-to-cart {
    background-color: transparent;
    border: 2px solid #6f4e37;
    color: #6f4e37;
    padding: 10px 30px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    margin-bottom: 20px;
  }

  .btn-back-to-cart:hover {
    background-color: #6f4e37;
    color: white;
  }

  .credit-card-fields {
    display: none;
  }

  .credit-card-fields.active {
    display: block;
  }

  .card-input-group {
    display: flex;
    gap: 15px;
  }

  .card-input-group .form-control {
    flex: 1;
  }

  .empty-cart {
    text-align: center;
    padding: 60px 20px;
    color: #6f4e37;
  }

  .empty-cart i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
  }

  .security-info {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-top: 20px;
    font-size: 0.9rem;
    color: #6c757d;
  }

  .order-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    color: #155724;
    margin-bottom: 30px;
  }

  .order-success i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #28a745;
  }

  footer {
    background-color: #4b2e2e;
    margin-top: 60px;
  }

  footer p {
    margin: 0;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
  }

  @media (max-width: 768px) {
    .page-header h1 {
      font-size: 2.2rem;
    }
    
    .card-input-group {
      flex-direction: column;
      gap: 0;
    }
    
    .order-summary {
      position: static;
      margin-top: 30px;
    }
  }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">☕ Momento</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon bg-light"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="offerings.php">What We Offer</a></li>
          <li class="nav-item">
            <a class="nav-link cart-icon" href="cart.php">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-badge" id="cartBadge">0</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="account.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <div class="page-header">
    <div class="container text-center">
      <h1>Checkout</h1>
      <p>Complete your order and enjoy our delicious coffee</p>
    </div>
  </div>

  <!-- Main Content Area -->
  <main class="container flex-grow-1">
    
    <?php if ($order_success): ?>
      <!-- Order Success Message -->
      <div class="order-success">
        <i class="fas fa-check-circle"></i>
        <h3>Order Placed Successfully!</h3>
        <p>Thank you for your order. We'll start preparing your delicious coffee right away!</p>
        <p><strong>Order Number:</strong> #MOM<?php echo rand(10000, 99999); ?></p>
        <p>You will receive an email confirmation shortly.</p>
        <div class="mt-4">
          <a href="offerings.php" class="btn-place-order" style="width: auto; padding: 10px 30px; margin-right: 15px;">
            <i class="fas fa-shopping-cart me-2"></i>Continue Shopping
          </a>
          <a href="account.php" class="btn-back-to-cart">
            <i class="fas fa-user me-2"></i>View Account
          </a>
        </div>
      </div>
    <?php else: ?>

      <!-- User Welcome -->
      <div class="user-welcome">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h4><i class="fas fa-user-circle me-2"></i>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h4>
            <p>You're logged in as: <?php echo htmlspecialchars($user_email); ?></p>
          </div>
          <div class="col-md-4 text-end">
            <a href="account.php" class="btn-back-to-cart">
              <i class="fas fa-user me-2"></i>My Account
            </a>
          </div>
        </div>
      </div>

      <!-- Empty Cart Message -->
      <div class="empty-cart d-none" id="emptyCheckout">
        <i class="fas fa-shopping-cart"></i>
        <h3>Your cart is empty</h3>
        <p>Add some items to your cart before proceeding to checkout.</p>
        <a href="offerings.php" class="btn-back-to-cart">
          <i class="fas fa-arrow-left me-2"></i>Continue Shopping
        </a>
      </div>

      <!-- Checkout Form -->
      <div class="row" id="checkoutForm">
        <div class="col-lg-8">
          <a href="cart.php" class="btn-back-to-cart">
            <i class="fas fa-arrow-left me-2"></i>Back to Cart
          </a>

          <form method="POST" action="">
            <input type="hidden" name="place_order" value="1">

            <!-- Shipping Information -->
            <div class="checkout-container">
              <h3 class="section-title">
                <i class="fas fa-truck me-2"></i>Shipping Information
              </h3>
              
              <div class="row">
                <div class="col-md-6">
                  <label for="shipping_first_name" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="shipping_first_name" name="shipping_first_name" 
                         value="<?php echo htmlspecialchars(explode(' ', $user_name)[0] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                  <label for="shipping_last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="shipping_last_name" name="shipping_last_name" 
                         value="<?php echo htmlspecialchars(explode(' ', $user_name, 2)[1] ?? ''); ?>" required>
                </div>
              </div>
              
              <div class="mb-3">
                <label for="shipping_address" class="form-label">Street Address</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address" 
                       value="<?php echo htmlspecialchars($user_data['street'] ?? ''); ?>" 
                       placeholder="123 Main Street" required>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <label for="shipping_city" class="form-label">City</label>
                  <input type="text" class="form-control" id="shipping_city" name="shipping_city" 
                         value="<?php echo htmlspecialchars($user_data['city'] ?? ''); ?>"
                         placeholder="New York" required>
                </div>
                <div class="col-md-3">
                  <label for="shipping_state" class="form-label">State</label>
                  <select class="form-select" id="shipping_state" name="shipping_state" required>
                    <option value="">Select State</option>
                    <option value="PH" <?php echo ($user_data['state'] ?? '') === 'PH' ? 'selected' : ''; ?>>Philippines</option>
                    <!-- Add more states as needed -->
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="shipping_zip" class="form-label">ZIP Code</label>
                  <input type="text" class="form-control" id="shipping_zip" name="shipping_zip" 
                         value="<?php echo htmlspecialchars($user_data['zipcode'] ?? ''); ?>"
                         placeholder="10001" required>
                </div>
              </div>
              
              <div class="mb-3">
                <label for="shipping_phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="shipping_phone" name="shipping_phone" 
                       value="<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>"
                       placeholder="(555) 123-4567" required>
              </div>
            </div>

            <!-- Payment Information -->
            <div class="checkout-container">
              <h3 class="section-title">
                <i class="fas fa-credit-card me-2"></i>Payment Information
              </h3>
              
              <!-- Payment Methods -->
              <div class="payment-methods">
                <div class="payment-method" onclick="selectPayment('credit')">
                  <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked>
                  <label for="credit_card">
                    <i class="fas fa-credit-card payment-icon"></i>
                    <strong>Credit/Debit Card</strong>
                    <div class="text-muted">Visa, MasterCard, American Express</div>
                  </label>
                </div>
                
                <div class="payment-method" onclick="selectPayment('paypal')">
                  <input type="radio" id="paypal" name="payment_method" value="paypal">
                  <label for="paypal">
                    <i class="fab fa-paypal payment-icon"></i>
                    <strong>PayPal</strong>
                    <div class="text-muted">Pay securely with your PayPal account</div>
                  </label>
                </div>
                
                <div class="payment-method" onclick="selectPayment('apple_pay')">
                  <input type="radio" id="apple_pay" name="payment_method" value="apple_pay">
                  <label for="apple_pay">
                    <i class="fab fa-apple payment-icon"></i>
                    <strong>Apple Pay</strong>
                    <div class="text-muted">Quick and secure payment with Touch ID</div>
                  </label>
                </div>
              </div>

              <!-- Credit Card Fields -->
              <div class="credit-card-fields active" id="creditCardFields">
                <div class="mb-3">
                  <label for="card_number" class="form-label">Card Number</label>
                  <input type="text" class="form-control" id="card_number" name="card_number" 
                         placeholder="1234 5678 9012 3456" maxlength="19">
                </div>
                
                <div class="card-input-group">
                  <div>
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" 
                           placeholder="MM/YY" maxlength="5">
                  </div>
                  <div>
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" 
                           placeholder="123" maxlength="4">
                  </div>
                </div>
                
                <div class="mb-3">
                  <label for="cardholder_name" class="form-label">Cardholder Name</label>
                  <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" 
                         value="<?php echo htmlspecialchars($user_name); ?>" placeholder="John Doe">
                </div>
              </div>

              <div class="security-info">
                <i class="fas fa-shield-alt me-2"></i>
                Your payment information is encrypted and secure. We never store your credit card details.
              </div>
            </div>

            <!-- Order Notes -->
            <div class="checkout-container">
              <h3 class="section-title">
                <i class="fas fa-sticky-note me-2"></i>Order Notes (Optional)
              </h3>
              <textarea class="form-control" name="order_notes" rows="3" 
                        placeholder="Special instructions for your order..."></textarea>
            </div>

        </div>

        <div class="col-lg-4">
          <!-- Order Summary -->
          <div class="order-summary">
            <h4 class="mb-3"><i class="fas fa-receipt me-2"></i>Order Summary</h4>
            
            <div id="orderItemsList">
              <!-- Cart items will be populated here by JavaScript -->
            </div>
            
            <hr>
            
            <div class="summary-row">
              <span>Subtotal:</span>
              <span id="subtotalAmount">$0.00</span>
            </div>
            <div class="summary-row">
              <span>Tax (8.25%):</span>
              <span id="taxAmount">$0.00</span>
            </div>
            <div class="summary-row">
              <span>Shipping:</span>
              <span id="shippingAmount">Free</span>
            </div>
            <div class="summary-row">
              <span><strong>Total:</strong></span>
              <span id="totalAmount"><strong>$0.00</strong></span>
            </div>
            
            <button type="submit" class="btn-place-order" id="placeOrderBtn">
              <i class="fas fa-check-circle me-2"></i>Place Order
            </button>
          </div>
        </div>
      </div>

      </form>

    <?php endif; ?>

  </main>

  <!-- Footer -->
  <footer class="text-white text-center py-2 mt-auto">
    <div class="container">
      <p class="mb-0">@Abarico Justinkim.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = <?php echo json_encode($products); ?>;
    
    function updateCartBadge() {
      const cart = localStorage.getItem('cart');
      const cartItems = cart ? JSON.parse(cart) : [];
      const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
      document.getElementById('cartBadge').textContent = totalItems;
    }

    function selectPayment(method) {
      // Remove selected class from all payment methods
      document.querySelectorAll('.payment-method').forEach(pm => {
        pm.classList.remove('selected');
      });
      
      // Add selected class to clicked method
      event.currentTarget.classList.add('selected');
      
      // Show/hide credit card fields
      const creditCardFields = document.getElementById('creditCardFields');
      if (method === 'credit') {
        creditCardFields.classList.add('active');
      } else {
        creditCardFields.classList.remove('active');
      }
    }

    function loadOrderSummary() {
      const cart = localStorage.getItem('cart');
      if (!cart) {
        document.getElementById('emptyCheckout').classList.remove('d-none');
        document.getElementById('checkoutForm').style.display = 'none';
        return;
      }

      const cartItems = JSON.parse(cart);
      if (cartItems.length === 0) {
        document.getElementById('emptyCheckout').classList.remove('d-none');
        document.getElementById('checkoutForm').style.display = 'none';
        return;
      }

      const orderItemsList = document.getElementById('orderItemsList');
      let subtotal = 0;
      
      orderItemsList.innerHTML = '';
      
      cartItems.forEach(item => {
        const product = products[item.id];
        if (product) {
          const itemTotal = product.price * item.quantity;
          subtotal += itemTotal;
          
          const orderItem = document.createElement('div');
          orderItem.className = 'order-item';
          orderItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="order-item-image">
            <div class="order-item-info">
              <div class="order-item-name">${product.name}</div>
              <div class="order-item-quantity">Quantity: ${item.quantity}</div>
            </div>
            <div class="order-item-price">$${itemTotal.toFixed(2)}</div>
          `;
          orderItemsList.appendChild(orderItem);
        }
      });
      
      const tax = subtotal * 0.0825; // 8.25% tax
      const shipping = 0; // Free shipping
      const total = subtotal + tax + shipping;
      
      document.getElementById('subtotalAmount').textContent = `$${subtotal.toFixed(2)}`;
      document.getElementById('taxAmount').textContent = `$${tax.toFixed(2)}`;
      document.getElementById('shippingAmount').textContent = shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`;
      document.getElementById('totalAmount').innerHTML = `<strong>$${total.toFixed(2)}</strong>`;
    }

    // Format credit card number
    document.getElementById('card_number').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
      let formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';
      if (formattedValue.length > 19) formattedValue = formattedValue.substring(0, 19);
      e.target.value = formattedValue;
    });

    // Format expiry date
    document.getElementById('expiry_date').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
      }
      e.target.value = value;
    });

    // Format CVV
    document.getElementById('cvv').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    document.addEventListener('DOMContentLoaded', function() {
      updateCartBadge();
      loadOrderSummary();
      
      // Set default payment method
      document.querySelector('.payment-method').classList.add('selected');
    });
  </script>
</body>
</html>