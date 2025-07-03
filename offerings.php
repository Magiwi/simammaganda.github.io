<?php
session_start();
$DBConnect = mysqli_connect("localhost", "root", "", "Momento");
if (!$DBConnect) {
    http_response_code(500);
    die("Database connection failed");
}
// Handle form submission to add a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($DBConnect, $_POST['name']);
    $price = floatval($_POST['price']);
    $category = mysqli_real_escape_string($DBConnect, $_POST['category']);
    $image = mysqli_real_escape_string($DBConnect, $_POST['image']);
    $date_added = date('Y-m-d');
    $recommended = intval($_POST['recommended']);
    $query = "INSERT INTO products (name, price, category, image, date_added, recommended) VALUES ('$name', $price, '$category', '$image', '$date_added', $recommended)";
    mysqli_query($DBConnect, $query);
}
// Fetch products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($DBConnect, $query);
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
// Product data with real stock photos
$products = [
  ['id' => 1, 'name' => 'Iced Americano', 'price' => 90, 'category' => 'beverages', 'image' => 'coffee/americano.jpg', 'date_added' => '2024-06-20', 'recommended' => 9],
  ['id' => 2, 'name' => 'Black Forest', 'price' => 150, 'category' => 'beverages', 'image' => 'coffee/Black Forest.jpg', 'date_added' => '2024-06-18', 'recommended' => 8],
  ['id' => 3, 'name' => 'Citrus Black', 'price' => 100, 'category' => 'beverages', 'image' => 'coffee/Circuits Black.png', 'date_added' => '2024-06-22', 'recommended' => 7],
  ['id' => 4, 'name' => 'Dirty Matcha', 'price' => 120, 'category' => 'beverages', 'image' => 'coffee/Dirty Matcha.jpg', 'date_added' => '2024-06-15', 'recommended' => 6],
  ['id' => 5, 'name' => 'Iced Latte', 'price' => 100, 'category' => 'beverages', 'image' => 'coffee/Iced Latte.jpg', 'date_added' => '2024-06-25', 'recommended' => 9],
  ['id' => 6, 'name' => 'Matcha', 'price' => 150, 'category' => 'beverages', 'image' => 'coffee/matcha.jpg', 'date_added' => '2024-06-12', 'recommended' => 8],
  ['id' => 7, 'name' => 'Sea Salt Latte', 'price' => 120, 'category' => 'beverages', 'image' => 'coffee/Sea Salt Latte.jpg', 'date_added' => '2024-06-10', 'recommended' => 7],
  ['id' => 8, 'name' => 'Strawberry Matcha', 'price' => 120, 'category' => 'beverages', 'image' => 'coffee/strawberry matcha.jpg', 'date_added' => '2024-06-08', 'recommended' => 6],
  ['id' => 9, 'name' => 'Spanich Latte', 'price' => 90, 'category' => 'beverages', 'image' => 'coffee/Spanich latte.jpg', 'date_added' => '2024-06-23', 'recommended' => 8],
  ['id' => 10, 'name' => 'Black Curant', 'price' => 85, 'category' => 'beverages', 'image' => 'coffee/Black Curant.jpg', 'date_added' => '2024-06-21', 'recommended' => 7],
  ['id' => 11, 'name' => 'Cappucinno', 'price' => 95, 'category' => 'beverages', 'image' => 'coffee/Iced Biscoff Latte.jpg', 'date_added' => '2024-06-19', 'recommended' => 9],
  ['id' => 12, 'name' => 'Latte', 'price' => 90, 'category' => 'beverages', 'image' => 'coffee/Latte.jpg', 'date_added' => '2024-06-17', 'recommended' => 6],
  ['id' => 13, 'name' => 'Lemon', 'price' => 75, 'category' => 'beverages', 'image' => 'coffee/Lemon.jpg', 'date_added' => '2024-06-14', 'recommended' => 8],
  ['id' => 14, 'name' => 'Banana Bread Slice', 'price' => 70, 'category' => 'pastries', 'image' => 'pastry/Banana Bread.jpg', 'date_added' => '2024-06-11', 'recommended' => 7],
  ['id' => 15, 'name' => 'Brownies', 'price' => 60, 'category' => 'pastries', 'image' => 'pastry/Brownies.jpg', 'date_added' => '2024-06-24', 'recommended' => 9],
  ['id' => 16, 'name' => 'Cake', 'price' => 80, 'category' => 'pastries', 'image' => 'pastry/cake.jpg', 'date_added' => '2024-06-16', 'recommended' => 8],
  ['id' => 17, 'name' => 'Cookies', 'price' => 55, 'category' => 'pastries', 'image' => 'pastry/cookies.jpg', 'date_added' => '2024-06-13', 'recommended' => 7],
  ['id' => 18, 'name' => 'Salted Cream Cheese', 'price' => 65, 'category' => 'pastries', 'image' => 'pastry/Salted Cream Cheese.jpg', 'date_added' => '2024-06-09', 'recommended' => 6],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>What We Offer - Momento Coffee Shop</title>
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

  label {
    font-weight: 600;
    color: #4b2e2e;
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

  .page-header p {
    font-size: 1.2rem;
    opacity: 0.9;
  }

  .controls-section {
    background: #fffaf3;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(111, 78, 55, 0.1);
    margin-bottom: 30px;
    border: 1px solid #e8dcd3;
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
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 600;
  }

  .btn-dark:hover {
    background-color: #543828;
  }

  .btn-outline-dark {
    border-color: #6f4e37;
    color: #6f4e37;
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 600;
  }

  .btn-outline-dark:hover {
    background-color: #6f4e37;
    color: #fff;
  }

  .btn-outline-dark.active {
    background-color: #6f4e37;
    color: #fff;
    border-color: #6f4e37;
  }

  .product-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e8dcd3;
    height: 100%;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(111, 78, 55, 0.2);
  }

  .product-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .product-card:hover .product-image {
    transform: scale(1.05);
  }

  .product-info {
    padding: 20px;
  }

  .product-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #4b2e2e;
    margin-bottom: 8px;
    line-height: 1.3;
  }

  .product-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #6f4e37;
    margin-bottom: 0;
  }

  .category-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .badge-beverages {
    background-color: #6f4e37;
    color: white;
  }

  .badge-pastries {
    background-color: #d4850c;
    color: white;
  }

  .badge-beans {
    background-color: #8b4513;
    color: white;
  }

  .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 20px;
  }

  @media (max-width: 768px) {
    .products-grid {
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }
    
    .page-header h1 {
      font-size: 2.2rem;
    }
    
    .page-header p {
      font-size: 1rem;
    }
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

  .no-products {
    text-align: center;
    padding: 60px 20px;
    color: #6f4e37;
  }

  .no-products i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
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
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <img src="picture/pic1.png" alt="Momento Logo" style="float:center;width:60px;height:40px; margin-left: 10px;">
      <a class="navbar-brand" href="#">Momento</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon bg-light"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link active" href="offerings.php">What We Offer</a></li>
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
      <h1>What We Offer</h1>
      <p>Discover our handcrafted beverages, freshly baked pastries, and premium coffee beans</p>
    </div>
  </div>

  <!-- Main Content Area -->
  <main class="container flex-grow-1">
    
    <!-- Controls Section -->
    <div class="controls-section">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-3 mb-lg-0">
          <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-outline-dark category-filter active" data-category="all">
              <i class="fas fa-th-large me-2"></i>All Products
            </button>
            <button class="btn btn-outline-dark category-filter" data-category="beverages">
              <i class="fas fa-coffee me-2"></i>Beverages
            </button>
            <button class="btn btn-outline-dark category-filter" data-category="pastries">
              <i class="fas fa-bread-slice me-2"></i>Pastries
            </button>
            <button class="btn btn-outline-dark category-filter" data-category="beans">
              <i class="fas fa-seedling me-2"></i>Coffee Beans
            </button>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row">
            <div class="col-sm-6 mb-2 mb-sm-0">
              <select class="form-select" id="sortSelect">
                <option value="recommended">Most Recommended</option>
                <option value="newest">Newest First</option>
                <option value="cheapest">Price: Low to High</option>
                <option value="expensive">Price: High to Low</option>
              </select>
            </div>
            <div class="col-sm-6">
              <div class="text-end">
                <span class="text-muted">
                  <span id="productCount"><?php echo count($products); ?></span> products found
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="products-grid" id="productsGrid">
      <?php foreach ($products as $product): ?>
        <a href="product-details.php?id=<?php echo $product['id']; ?>" class="text-decoration-none">
          <div class="product-card" 
               data-category="<?php echo $product['category']; ?>"
               data-price="<?php echo $product['price']; ?>"
               data-date="<?php echo $product['date_added']; ?>"
               data-recommended="<?php echo $product['recommended']; ?>">
            <div class="position-relative">
              <img src="<?php echo $product['image']; ?>" 
                   alt="<?php echo htmlspecialchars($product['name']); ?>" 
                   class="product-image">
              <div class="category-badge badge-<?php echo $product['category']; ?>">
                <?php 
                  $categoryNames = [
                    'beverages' => 'Beverage',
                    'pastries' => 'Pastry', 
                    'beans' => 'Coffee Beans'
                  ];
                  echo $categoryNames[$product['category']];
                ?>
              </div>
            </div>
            <div class="product-info">
              <h5 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h5>
              <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- No Products Found Message -->
    <div class="no-products d-none" id="noProducts">
      <i class="fas fa-search"></i>
      <h3>No products found</h3>
      <p>Try adjusting your filters to see more products.</p>
    </div>

  </main>

  <!-- Footer -->
  <footer class="text-white text-center py-3 mt-auto">
    <div class="container">
      <p class="mb-0">@Abarico Justinkim.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const categoryFilters = document.querySelectorAll('.category-filter');
      const sortSelect = document.getElementById('sortSelect');
      const productsGrid = document.getElementById('productsGrid');
      const productCount = document.getElementById('productCount');
      const noProducts = document.getElementById('noProducts');
      
      let currentCategory = 'all';
      let currentSort = 'recommended';

      // Category filtering
      categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
          // Update active state
          categoryFilters.forEach(f => f.classList.remove('active'));
          this.classList.add('active');
          
          currentCategory = this.dataset.category;
          filterAndSort();
        });
      });

      // Sort functionality
      sortSelect.addEventListener('change', function() {
        currentSort = this.value;
        filterAndSort();
      });

      function filterAndSort() {
        const products = Array.from(productsGrid.children);
        let visibleProducts = [];

        // Filter products
        products.forEach(product => {
          const productCategory = product.dataset.category;
          const shouldShow = currentCategory === 'all' || productCategory === currentCategory;
          
          if (shouldShow) {
            product.style.display = 'block';
            visibleProducts.push(product);
          } else {
            product.style.display = 'none';
          }
        });

        // Sort visible products
        visibleProducts.sort((a, b) => {
          switch (currentSort) {
            case 'newest':
              return new Date(b.dataset.date) - new Date(a.dataset.date);
            case 'cheapest':
              return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'expensive':
              return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            case 'recommended':
            default:
              return parseInt(b.dataset.recommended) - parseInt(a.dataset.recommended);
          }
        });

        // Reorder products in the DOM
        visibleProducts.forEach(product => {
          productsGrid.appendChild(product);
        });

        // Update product count
        productCount.textContent = visibleProducts.length;

        // Show/hide no products message
        if (visibleProducts.length === 0) {
          noProducts.classList.remove('d-none');
          productsGrid.classList.add('d-none');
        } else {
          noProducts.classList.add('d-none');
          productsGrid.classList.remove('d-none');
        }
      }

      // Initialize with default sorting
      filterAndSort();
    });
  </script>
</body>
</html>
