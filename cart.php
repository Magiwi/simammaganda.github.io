<?php

session_start();
$DBConnect = mysqli_connect("localhost", "root", "", "Momento");

if (!$DBConnect) {
    http_response_code(500);
    die("Database connection failed");
}

// Check if the action key exists in the POST request
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $sessionId = session_id();

    if ($action === 'add') {
        $productId = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);

        // Check if the item already exists in the cart
        $query = "SELECT * FROM cart_items WHERE session_id = '$sessionId' AND product_id = $productId";
        $result = mysqli_query($DBConnect, $query);

        if (mysqli_num_rows($result) > 0) {
            // Update quantity if item exists
            $query = "UPDATE cart_items SET quantity = quantity + $quantity WHERE session_id = '$sessionId' AND product_id = $productId";
        } else {
            // Insert new item
            $query = "INSERT INTO cart_items (session_id, product_id, quantity) VALUES ('$sessionId', $productId, $quantity)";
        }
        mysqli_query($DBConnect, $query);
    }

    if ($action === 'remove') {
        $productId = intval($_POST['product_id']);
        $query = "DELETE FROM cart_items WHERE session_id = '$sessionId' AND product_id = $productId";
        mysqli_query($DBConnect, $query);
    }

    if ($action === 'fetch') {
        $query = "SELECT * FROM cart_items WHERE session_id = '$sessionId'";
        $result = mysqli_query($DBConnect, $query);
        $cartItems = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;
        }
        echo json_encode($cartItems);
    }
} else {
    // If no action is specified, return an error message
    echo json_encode(['error' => 'No action specified']);
}






// Product data for cart reference
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shopping Cart - Momento Coffee Shop</title>
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

  .cart-container {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .cart-item {
    border-bottom: 1px solid #e8dcd3;
    padding: 20px 0;
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .cart-item:last-child {
    border-bottom: none;
  }

  .cart-item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
  }

  .cart-item-info {
    flex: 1;
  }

  .cart-item-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #4b2e2e;
    margin-bottom: 5px;
  }

  .cart-item-price {
    color: #6f4e37;
    font-weight: 600;
  }

  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .quantity-btn {
    background-color: #6f4e37;
    border: none;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .quantity-btn:hover {
    background-color: #543828;
  }

  .quantity-input {
    width: 50px;
    text-align: center;
    border: 1px solid #d3c1b0;
    border-radius: 5px;
    padding: 5px;
  }

  .remove-btn {
    background-color: #dc3545;
    border: none;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .remove-btn:hover {
    background-color: #c82333;
  }

  .cart-summary {
    background: #fffaf3;
    border-radius: 10px;
    padding: 25px;
    margin-top: 20px;
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
  }

  .btn-checkout {
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

  .btn-checkout:hover {
    background-color: #543828;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
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

  .btn-continue-shopping {
    background-color: transparent;
    border: 2px solid #6f4e37;
    color: #6f4e37;
    padding: 10px 30px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    margin-top: 20px;
  }

  .btn-continue-shopping:hover {
    background-color: #6f4e37;
    color: white;
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
    .cart-item {
      flex-direction: column;
      text-align: center;
      gap: 15px;
    }
    
    .page-header h1 {
      font-size: 2.2rem;
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
      <h1>Shopping Cart</h1>
      <p>Review your selected items and proceed to checkout</p>
    </div>
  </div>

  <!-- Main Content Area -->
  <main class="container flex-grow-1">
    
    <div class="cart-container">
      <!-- Cart Items Container -->
      <div id="cartItems">
        <!-- Cart items will be populated by JavaScript -->
      </div>

      <!-- Empty Cart Message -->
      <div class="empty-cart d-none" id="emptyCart">
        <i class="fas fa-shopping-cart"></i>
        <h3>Your cart is empty</h3>
        <p>Add some delicious items from our menu to get started!</p>
        <a href="offerings.php" class="btn-continue-shopping">
          <i class="fas fa-arrow-left me-2"></i>Continue Shopping
        </a>
      </div>

      <!-- Cart Summary -->
      <div class="cart-summary d-none" id="cartSummary">
        <div class="summary-row">
          <span>Subtotal:</span>
          <span id="subtotal">$0.00</span>
        </div>
        <div class="summary-row">
          <span>Tax (8.5%):</span>
          <span id="tax">$0.00</span>
        </div>
        <div class="summary-row">
          <span>Total:</span>
          <span id="total">$0.00</span>
        </div>
        <button class="btn-checkout" onclick="proceedToCheckout()">
          <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
        </button>
      </div>
    </div>

  </main>

  <!-- Footer -->
  <footer class="text-white text-center py-2 mt-auto">
    <div class="container">
      <p class="mb-0">@Abarico Justinkim.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Product data for JavaScript reference
    const products = <?php echo json_encode($products); ?>;

    // Cart management functions
    function getCart() {
      const cart = localStorage.getItem('cart');
      return cart ? JSON.parse(cart) : [];
    }

    function saveCart(cart) {
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartBadge();
    }

    function updateCartBadge() {
      const cart = getCart();
      const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
      document.getElementById('cartBadge').textContent = totalItems;
    }

    function updateQuantity(productId, newQuantity) {
      let cart = getCart();
      const itemIndex = cart.findIndex(item => item.id === productId);
      
      if (itemIndex !== -1) {
        if (newQuantity <= 0) {
          cart.splice(itemIndex, 1);
        } else if (newQuantity <= 10) {
          cart[itemIndex].quantity = newQuantity;
        }
        saveCart(cart);
        displayCart();
      }
    }

    function removeFromCart(productId) {
      let cart = getCart();
      cart = cart.filter(item => item.id !== productId);
      saveCart(cart);
      displayCart();
    }

    function displayCart() {
      const cart = getCart();
      const cartItemsContainer = document.getElementById('cartItems');
      const emptyCart = document.getElementById('emptyCart');
      const cartSummary = document.getElementById('cartSummary');

      if (cart.length === 0) {
        cartItemsContainer.innerHTML = '';
        emptyCart.classList.remove('d-none');
        cartSummary.classList.add('d-none');
        return;
      }

      emptyCart.classList.add('d-none');
      cartSummary.classList.remove('d-none');

      let html = '';
      let subtotal = 0;

      cart.forEach(item => {
        const product = products[item.id];
        if (product) {
          const itemTotal = product.price * item.quantity;
          subtotal += itemTotal;

          html += `
            <div class="cart-item">
              <img src="${product.image}" alt="${product.name}" class="cart-item-image">
              <div class="cart-item-info">
                <div class="cart-item-name">${product.name}</div>
                <div class="cart-item-price">$${product.price.toFixed(2)} each</div>
              </div>
              <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">
                  <i class="fas fa-minus"></i>
                </button>
                <input type="number" class="quantity-input" value="${item.quantity}" 
                       min="1" max="10" 
                       onchange="updateQuantity(${item.id}, parseInt(this.value))">
                <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div class="text-end">
                <div class="fw-bold mb-2">$${itemTotal.toFixed(2)}</div>
                <button class="remove-btn" onclick="removeFromCart(${item.id})">
                  <i class="fas fa-trash"></i> Remove
                </button>
              </div>
            </div>
          `;
        }
      });

      cartItemsContainer.innerHTML = html;

      // Update summary
      const tax = subtotal * 0.085;
      const total = subtotal + tax;

      document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
      document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
      document.getElementById('total').textContent = `$${total.toFixed(2)}`;
    }

    function proceedToCheckout() {
      const cart = getCart();
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }

      // Redirect to checkout page
      window.location.href = 'checkout.php';
    }

    // Initialize cart display when page loads
    document.addEventListener('DOMContentLoaded', function() {
      updateCartBadge();
      displayCart();
    });
  </script>
</body>
</html>