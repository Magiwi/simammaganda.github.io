<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user']) || !isset($_SESSION['registration'])) {
    header('Location: login.php');
    exit();
}

// Get user information from session
$user_data = $_SESSION['registration'];
$user_name = $user_data['fullname'] ?? 'Guest';
$user_email = $user_data['email'] ?? '';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Account - Momento Coffee Shop</title>
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

  .account-container {
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .user-info {
    background: #fffaf3;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    border: 1px solid #e8dcd3;
  }

  .user-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #6f4e37;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-right: 20px;
  }

  .btn-logout {
    background-color: #dc3545;
    border: none;
    color: white;
    padding: 8px 20px;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .btn-logout:hover {
    background-color: #c82333;
    color: white;
    text-decoration: none;
  }

  .btn-shop {
    background-color: #6f4e37;
    border: none;
    color: white;
    padding: 12px 30px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .btn-shop:hover {
    background-color: #543828;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
  }

  .stats-card {
    background: #fffaf3;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    border: 1px solid #e8dcd3;
    margin-bottom: 20px;
  }

  .stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #6f4e37;
  }

  .stats-label {
    color: #5c4033;
    font-weight: 600;
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
    
    .account-container {
      padding: 25px;
    }
    
    .user-info {
      text-align: center;
    }
    
    .user-avatar {
      margin: 0 auto 20px;
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
            <a class="nav-link active" href="account.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <div class="page-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1>My Account</h1>
          <p>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Area -->
  <main class="container flex-grow-1">
    
    <div class="row">
      <div class="col-md-8">
        <div class="account-container">
          <h3>Account Information</h3>
          <p>Manage your account details and preferences here.</p>
          
          <div class="mb-4">
            <h5>Profile Details</h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user_data['fullname']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($user_data['phone']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($user_data['gender']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user_data['dob']); ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Street Address:</strong> <?php echo htmlspecialchars($user_data['street']); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($user_data['city']); ?></p>
                <p><strong>State:</strong> <?php echo htmlspecialchars($user_data['state']); ?></p>
                <p><strong>ZIP Code:</strong> <?php echo htmlspecialchars($user_data['zipcode']); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($user_data['country']); ?></p>
                <p><strong>Member Since:</strong> <?php echo date('F Y'); ?></p>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <h5>Order History</h5>
            <div class="text-center py-4">
              <i class="fas fa-shopping-bag text-muted" style="font-size: 3rem; margin-bottom: 15px;"></i>
              <p class="text-muted">No orders yet</p>
              <p class="text-muted">Your order history will appear here once you make your first purchase.</p>
              <a href="offerings.php" class="btn-shop">
                <i class="fas fa-shopping-cart me-2"></i>Start Shopping
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <!-- User Info Card -->
        <div class="user-info">
          <div class="d-flex align-items-center">
            <div class="user-avatar">
              <?php echo strtoupper(substr($user_data['fullname'], 0, 1)); ?>
            </div>
            <div>
              <h5 class="mb-1"><?php echo htmlspecialchars($user_data['fullname']); ?></h5>
              <p class="text-muted mb-0"><?php echo htmlspecialchars($user_data['email']); ?></p>
              <small class="text-muted">@<?php echo htmlspecialchars($user_data['username']); ?></small><br>
              <small class="text-muted">Member since <?php echo date('M Y'); ?></small>
            </div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
          <div class="col-6">
            <div class="stats-card">
              <div class="stats-number">0</div>
              <div class="stats-label">Total Orders</div>
            </div>
          </div>
          <div class="col-6">
            <div class="stats-card">
              <div class="stats-number">$0.00</div>
              <div class="stats-label">Total Spent</div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="account-container">
          <h5>Quick Actions</h5>
          <div class="d-grid gap-2">
            <a href="offerings.php" class="btn-shop">
              <i class="fas fa-shopping-cart me-2"></i>Browse Menu
            </a>
            <a href="cart.php" class="btn-shop" style="background-color: #7b4a2d;">
              <i class="fas fa-shopping-bag me-2"></i>View Cart
            </a>
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