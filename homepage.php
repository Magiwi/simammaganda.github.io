<?php
session_start();

// Check if user is logged in
$is_logged_in = isset($_SESSION['user']) && isset($_SESSION['registration']);
$user_name = '';
if ($is_logged_in) {
    $user_name = $_SESSION['registration']['fullname'] ?? 'Guest';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Momento Coffee Shop</title>
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

  label {
    font-weight: 600;
    color: #4b2e2e;
  }

  .form-section {
    background: #fffaf3;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
  }

  h2, h5 {
    color: #5c4033;
  }

  .form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #d3c1b0;
    padding: 10px 14px;
  }

  .form-control:focus, .form-select:focus {
    border-color: #a57c5b;
    box-shadow: 0 0 0 0.15rem rgba(165, 124, 91, 0.25);
  }

  .btn-dark {
    background-color: #6f4e37;
    border: none;
  }

  .btn-dark:hover {
    background-color: #543828;
  }

  .btn-outline-dark {
    border-color: #6f4e37;
    color: #6f4e37;
  }

  .btn-outline-dark:hover {
    background-color: #6f4e37;
    color: #fff;
  }

  footer {
    background-color: #4b2e2e;
  }

  footer p {
    margin: 0;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
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

  .contact-section {
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
  }

  .contact-card, .hours-card {
    padding: 30px 20px;
    border-radius: 10px;
    background: #fffaf3;
    border: 1px solid #e8dcd3;
    transition: transform 0.3s ease;
    height: 100%;
  }

  .contact-card:hover, .hours-card:hover {
    transform: translateY(-5px);
  }

  .contact-icon {
    font-size: 2.5rem;
    color: #6f4e37;
    margin-bottom: 15px;
  }

  .contact-card h5, .hours-card h5 {
    color: #4b2e2e;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .contact-card p, .hours-card p {
    color: #5c4033;
    margin: 0;
  }

  .contact-card a, .hours-card a {
    color: #6f4e37;
    text-decoration: none;
    font-weight: 600;
  }

  .contact-card a:hover, .hours-card a:hover {
    color: #4b2e2e;
    text-decoration: underline;
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
          <li class="nav-item"><a class="nav-link active" href="homepage.php">Home</a></li>
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

  <!-- Main Content Area -->
  <main class="container my-5 flex-grow-1">
    
    <?php if ($is_logged_in): ?>
      <!-- Welcome Banner -->
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; background: linear-gradient(135deg, #d4edda, #c3e6cb); border: none; margin-bottom: 30px;">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h5 class="alert-heading mb-1">
              <i class="fas fa-user-circle me-2"></i>Welcome back, <?php echo htmlspecialchars($user_name); ?>!
            </h5>
            <p class="mb-0">Ready to explore our delicious coffee menu?</p>
          </div>
          <div class="col-md-4 text-end">
            <a href="account.php" class="btn btn-outline-success btn-sm me-2">
              <i class="fas fa-user me-1"></i>My Account
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="row justify-content-center text-center">
      <div class="col-md-8">
        <h2>Welcome to Momento</h2>
        <p>
          Our coffee bar is the perfect spot for students and young professionals who want to enjoy a cup of coffee in a comfortable atmosphere.
          Our goal is to provide total satisfaction to our customers by ensuring they have a great experience every time.
        </p>
        <p>
          Stop by and savor our handcrafted drinks and freshly baked pastries, made with love every day.
        </p>
        <div class="mt-4">
          <a href="offerings.php" class="btn btn-dark btn-lg me-3">View Our Menu</a>
          <a href="about.php" class="btn btn-outline-dark btn-lg">Learn More</a>
        </div>
      </div>
    </div>

    <!-- Featured Products Section -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-12">
        <div class="featured-section">
          <h3 class="text-center mb-4">Today's Specials</h3>
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="featured-card">
                <div class="promotion-badge">20% OFF</div>
                <img src="coffee/Dirty Matcha.jpg" alt="Premium Espresso" class="featured-image" width="300" height="300">
                <div class="featured-content">
                  <h5>Dirty Matcha</h5>
                  <p class="featured-price">
                    <span class="original-price">$3.50</span>
                    <span class="sale-price">$2.80</span>
                  </p>
                  <p class="featured-description">Rich, bold espresso made from our finest beans</p>
                  <button class="btn-add-featured" onclick="addToCart('1', 'Dirty Matcha', 2.80)">
                    <i class="fas fa-plus"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="featured-card">
                <div class="new-badge">NEW</div>
                <img src="coffee/Black Forest.jpg" alt="Black Forest" class="featured-image" width="300" height="300">
                <div class="featured-content">
                  <h5>Caramel Cloud Latte</h5>
                  <p class="featured-price">
                    <span class="sale-price">$5.25</span>
                  </p>
                  <p class="featured-description">Our newest creation with fluffy cloud foam</p>
                  <button class="btn-add-featured" onclick="addToCart('13', 'Black Forest', 5.25)">
                    <i class="fas fa-plus"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="featured-card">
                <div class="popular-badge">POPULAR</div>
                <img src="coffee/Circuits Black.png" alt="Citrus Black" class="featured-image">
                <div class="featured-content">
                  <h5>Citrus Black</h5>
                  <p class="featured-price">
                    <span class="sale-price">$4.75</span>
                  </p>
                  <p class="featured-description">Customer favorite with smooth vanilla layers</p>
                  <button class="btn-add-featured" onclick="addToCart('8', 'Citrus Black', 4.75)">
                    <i class="fas fa-plus"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <a href="offerings.php" class="btn btn-outline-dark btn-lg">View All Products</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Daily Promotion Banner -->
    <div class="row justify-content-center mt-4">
      <div class="col-md-10">
        <div class="promo-banner">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h4><i class="fas fa-star"></i> Limited Time Offer!</h4>
              <p>Buy any large coffee and get a pastry for just $1.99. Available until 2 PM daily!</p>
            </div>
            <div class="col-md-4 text-center">
              <a href="offerings.php" class="btn btn-warning btn-lg">
                <i class="fas fa-clock"></i> Order Now
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Information Section -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-10">
        <div class="contact-section">
          <div class="row text-center">
            <div class="col-md-4 mb-4">
              <div class="contact-card">
                <i class="fas fa-map-marker-alt contact-icon"></i>
                <h5>Visit Us</h5>
                <p>123 Coffee Street<br>Downtown District, NY 10001</p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="contact-card">
                <i class="fas fa-phone contact-icon"></i>
                <h5>Call Us</h5>
                <p><a href="tel:+15551232233">(555) 123-CAFE (2233)</a></p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="contact-card">
                <i class="fas fa-envelope contact-icon"></i>
                <h5>Email Us</h5>
                <p><a href="mailto:hello@momentocoffee.com">hello@momentocoffee.com</a></p>
              </div>
            </div>
          </div>
          <div class="row text-center mt-4">
            <div class="col-12">
              <div class="hours-card">
                <i class="fas fa-clock contact-icon"></i>
                <h5>Opening Hours</h5>
                <p>Monday - Friday: 6:00 AM - 8:00 PM<br>Saturday - Sunday: 7:00 AM - 9:00 PM</p>
              </div>
            </div>
          </div>
        </div>
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
    function updateCartBadge() {
      const cart = localStorage.getItem('cart');
      const cartItems = cart ? JSON.parse(cart) : [];
      const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
      document.getElementById('cartBadge').textContent = totalItems;
    }

    document.addEventListener('DOMContentLoaded', function() {
      updateCartBadge();
    });
  </script>
</body>
</html>