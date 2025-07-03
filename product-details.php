<?php
// Product data with real stock photos
$products = [
    // Coffee Drinks and Beverages (8 items)
    [
        'id' => 1,
        'name' => 'Iced Americano',
        'price' => 90,
        'category' => 'beverages',
        'image' => 'coffee/americano.jpg',
        'date_added' => '2024-06-20',
        'recommended' => 9,
        'description' => 'A rich and intense double shot of espresso made from our premium coffee beans. This traditional Italian coffee delivers a bold flavor with a perfect crema layer on top.',
        'size' => '2 oz',
        'features' => ['Premium coffee beans', 'Perfect crema', 'Bold flavor', 'Traditional preparation'],
        'ingredients' => ['100% Arabica coffee beans', 'Filtered water']
    ],
    [
        'id' => 2,
        'name' => 'Black Forest',
        'price' => 150,
        'category' => 'beverages',
        'image' => 'coffee/Black Forest.jpg',
        'date_added' => '2024-06-18',
        'recommended' => 8,
        'description' => 'A perfectly balanced cappuccino with equal parts espresso, steamed milk, and milk foam. Topped with a dusting of cocoa powder for an elegant finish.',
        'size' => '8 oz',
        'features' => ['Perfectly balanced', 'Steamed milk foam', 'Cocoa powder dusting', 'Classic Italian style'],
        'ingredients' => ['Espresso', 'Steamed milk', 'Milk foam', 'Cocoa powder']
    ],
    [
        'id' => 3,
        'name' => 'Citrus Black',
        'price' => 100,
        'category' => 'beverages',
        'image' => 'coffee/Circuits Black.png',
        'date_added' => '2024-06-22',
        'recommended' => 7,
        'description' => 'A sweet and indulgent coffee drink featuring vanilla-flavored steamed milk, marked with espresso and finished with our signature caramel drizzle.',
        'size' => '12 oz',
        'features' => ['Vanilla steamed milk', 'Signature caramel drizzle', 'Sweet and creamy', 'Instagram-worthy presentation'],
        'ingredients' => ['Espresso', 'Steamed milk', 'Vanilla syrup', 'Caramel sauce']
    ],
    [
        'id' => 4,
        'name' => 'Dirty Matcha',
        'price' => 120,
        'category' => 'beverages',
        'image' => 'coffee/Dirty Matcha.jpg',
        'date_added' => '2024-06-15',
        'recommended' => 6,
        'description' => 'Refreshing cold-brewed coffee served over ice with your choice of milk. Perfect for hot summer days when you need your caffeine fix.',
        'size' => '16 oz',
        'features' => ['Cold-brewed', 'Served over ice', 'Choice of milk', 'Refreshing'],
        'ingredients' => ['Cold-brew coffee', 'Ice', 'Milk (optional)', 'Simple syrup (optional)']
    ],
    [
        'id' => 5,
        'name' => 'Iced Latte',
        'price' => 100,
        'category' => 'beverages',
        'image' => 'coffee/Iced Latte.jpg',
        'date_added' => '2024-06-25',
        'recommended' => 9,
        'description' => 'A blended frozen coffee drink combining rich espresso with chocolate syrup, milk, and ice. Topped with whipped cream and chocolate drizzle.',
        'size' => '16 oz',
        'features' => ['Blended frozen drink', 'Rich chocolate flavor', 'Whipped cream topping', 'Perfect summer treat'],
        'ingredients' => ['Espresso', 'Chocolate syrup', 'Milk', 'Ice', 'Whipped cream']
    ],
    [
        'id' => 6,
        'name' => 'Matcha',
        'price' => 150,
        'category' => 'beverages',
        'image' => 'coffee/matcha.jpg',
        'date_added' => '2024-06-12',
        'recommended' => 8,
        'description' => 'Smooth and creamy latte infused with premium vanilla syrup. The perfect balance of rich espresso and sweet vanilla flavoring.',
        'size' => '12 oz',
        'features' => ['Premium vanilla syrup', 'Smooth and creamy', 'Perfect balance', 'Comforting warmth'],
        'ingredients' => ['Espresso', 'Steamed milk', 'Vanilla syrup', 'Milk foam']
    ],
    [
        'id' => 7,
        'name' => 'Sea Salt Latte',
        'price' => 120,
        'category' => 'beverages',
        'image' => 'coffee/Sea Salt Latte.jpg',
        'date_added' => '2024-06-10',
        'recommended' => 7,
        'description' => 'A simple yet sophisticated coffee drink made by diluting espresso with hot water. Clean taste that highlights the coffee\'s natural flavors.',
        'size' => '12 oz',
        'features' => ['Clean taste', 'Highlights natural flavors', 'Simple preparation', 'Strong caffeine'],
        'ingredients' => ['Espresso', 'Hot water']
    ],
    [
        'id' => 8,
        'name' => 'Strawberry Matcha',
        'price' => 120,
        'category' => 'beverages',
        'image' => 'coffee/strawberry matcha.jpg',
        'date_added' => '2024-06-08',
        'recommended' => 6,
        'description' => 'Traditional Turkish coffee brewed in a special pot (cezve) with finely ground coffee beans. Served with a rich foam and unique cultural heritage.',
        'size' => '3 oz',
        'features' => ['Traditional preparation', 'Finely ground beans', 'Rich foam', 'Cultural heritage'],
        'ingredients' => ['Finely ground Turkish coffee', 'Water', 'Sugar (optional)']
    ],
    
    // Pastries and Baked Goods (6 items)
    [
        'id' => 9,
        'name' => 'Spanich Latte',
        'price' => 2.50,
        'category' => 'beverages',
        'image' => 'coffee/Spanich latte.jpg',
        'date_added' => '2024-06-23',
        'recommended' => 8,
        'description' => 'Buttery, flaky croissant filled with rich dark chocolate. Baked fresh daily using traditional French techniques for the perfect pastry experience.',
        'size' => 'Regular (4 inches)',
        'features' => ['Fresh daily baking', 'Traditional French technique', 'Rich dark chocolate', 'Buttery and flaky'],
        'ingredients' => ['Wheat flour', 'Butter', 'Dark chocolate', 'Eggs', 'Milk', 'Sugar', 'Yeast']
    ],
    [
        'id' => 10,
        'name' => 'Black Curant',
        'price' => 2.25,
        'category' => 'beverages',
        'image' => 'coffee/Black Curant.jpg',
        'date_added' => '2024-06-21',
        'recommended' => 7,
        'description' => 'Moist and fluffy muffin packed with fresh blueberries. Made with real fruit and a hint of lemon zest for a delightful morning treat.',
        'size' => 'Large (3.5 inches)',
        'features' => ['Fresh blueberries', 'Moist and fluffy', 'Lemon zest', 'Morning favorite'],
        'ingredients' => ['Fresh blueberries', 'Wheat flour', 'Sugar', 'Eggs', 'Butter', 'Milk', 'Lemon zest']
    ],
    [
        'id' => 11,
        'name' => 'Cappucinno',
        'price' => 3.00,
        'category' => 'beverages',
        'image' => 'coffee/Iced Biscoff Latte.jpg',
        'date_added' => '2024-06-19',
        'recommended' => 9,
        'description' => 'Warm, spiral-shaped pastry with cinnamon sugar filling and cream cheese glaze. The perfect balance of sweet and spicy flavors.',
        'size' => 'Large (4 inches)',
        'features' => ['Cinnamon sugar filling', 'Cream cheese glaze', 'Warm and fresh', 'Sweet and spicy'],
        'ingredients' => ['Wheat flour', 'Cinnamon', 'Brown sugar', 'Butter', 'Cream cheese', 'Vanilla', 'Yeast']
    ],
    [
        'id' => 12,
        'name' => 'Latte',
        'price' => 2.75,
        'category' => 'beverages',
        'image' => 'coffee/Latte.jpg',
        'date_added' => '2024-06-17',
        'recommended' => 6,
        'description' => 'Delicate puff pastry topped with cinnamon-spiced apple filling and a light glaze. A perfect combination of textures and autumn flavors.',
        'size' => 'Regular (4 inches)',
        'features' => ['Puff pastry base', 'Cinnamon-spiced apples', 'Light glaze', 'Autumn flavors'],
        'ingredients' => ['Puff pastry', 'Fresh apples', 'Cinnamon', 'Sugar', 'Butter', 'Vanilla glaze']
    ],
    [
        'id' => 13,
        'name' => 'Lemon',
        'price' => 1.75,
        'category' => 'beverages',
        'image' => 'coffee/Lemon.jpg',
        'date_added' => '2024-06-14',
        'recommended' => 8,
        'description' => 'Classic chocolate chip cookie with a soft center and slightly crispy edges. Made with premium chocolate chips and pure vanilla extract.',
        'size' => 'Large (3 inches)',
        'features' => ['Soft center', 'Crispy edges', 'Premium chocolate chips', 'Classic recipe'],
        'ingredients' => ['Wheat flour', 'Chocolate chips', 'Butter', 'Brown sugar', 'Eggs', 'Vanilla extract']
    ],
    [
        'id' => 14,
        'name' => 'Banana Bread Slice',
        'price' => 2.00,
        'category' => 'pastries',
        'image' => 'pastry/Banana Bread.jpg',
        'date_added' => '2024-06-11',
        'recommended' => 7,
        'description' => 'Moist banana bread made with ripe bananas and a touch of cinnamon. Each slice is dense, flavorful, and perfect with coffee.',
        'size' => 'Thick slice (1 inch)',
        'features' => ['Made with ripe bananas', 'Touch of cinnamon', 'Dense and moist', 'Perfect with coffee'],
        'ingredients' => ['Ripe bananas', 'Wheat flour', 'Sugar', 'Eggs', 'Butter', 'Cinnamon', 'Vanilla']
    ],
    
    // Coffee Beans and Products (4 items)
    [
        'id' => 15,
        'name' => 'Brownies',
        'price' => 12.99,
        'category' => 'pastries',
        'image' => 'pastry/Brownies.jpg',
        'date_added' => '2024-06-24',
        'recommended' => 9,
        'description' => 'Our signature house blend featuring a perfect balance of Central and South American beans. Medium roast with notes of chocolate, caramel, and a smooth finish.',
        'size' => '12 oz bag',
        'features' => ['Signature blend', 'Medium roast', 'Chocolate and caramel notes', 'Smooth finish'],
        'ingredients' => ['100% Arabica beans from Central and South America']
    ],
    [
        'id' => 16,
        'name' => 'Cake',
        'price' => 15.99,
        'category' => 'pastries',
        'image' => 'pastry/cake.jpg',
        'date_added' => '2024-06-16',
        'recommended' => 8,
        'description' => 'Premium Ethiopian coffee beans from the Yirgacheffe region. Light roast with bright acidity, floral notes, and a wine-like complexity.',
        'size' => '12 oz bag',
        'features' => ['Single origin', 'Light roast', 'Floral notes', 'Wine-like complexity'],
        'ingredients' => ['100% Ethiopian Arabica beans from Yirgacheffe region']
    ],
    [
        'id' => 17,
        'name' => 'Cookies',
        'price' => 14.50,
        'category' => 'pastries',
        'image' => 'pastry/cookies.jpg',
        'date_added' => '2024-06-13',
        'recommended' => 7,
        'description' => 'Bold and robust dark roast coffee beans with intense flavor and low acidity. Perfect for espresso or French press brewing methods.',
        'size' => '12 oz bag',
        'features' => ['Bold and robust', 'Intense flavor', 'Low acidity', 'Great for espresso'],
        'ingredients' => ['100% Arabica beans, dark roasted']
    ],
    [
        'id' => 18,
        'name' => 'Salted Cream Cheese',
        'price' => 11.99,
        'category' => 'pastries',
        'image' => 'pastry/Salted Cream Cheese.jpg',
        'date_added' => '2024-06-09',
        'recommended' => 6,
        'description' => 'Pre-ground French roast coffee with a smoky, intense flavor profile. Ideal for drip coffee makers and delivers a strong, full-bodied cup.',
        'size' => '12 oz bag',
        'features' => ['Pre-ground convenience', 'Smoky flavor', 'Intense profile', 'Full-bodied'],
        'ingredients' => ['100% Arabica beans, French roasted and ground']
    ]
];

// Get product ID from URL parameter
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Find the product by ID
$current_product = null;
foreach ($products as $product) {
    if ($product['id'] == $product_id) {
        $current_product = $product;
        break;
    }
}

// If product not found, default to first product
if (!$current_product) {
    $current_product = $products[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($current_product['name']); ?> - Momento Coffee Shop</title>
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

  .breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 30px;
  }

  .breadcrumb-item a {
    color: #6f4e37;
    text-decoration: none;
  }

  .breadcrumb-item a:hover {
    color: #4b2e2e;
  }

  .breadcrumb-item.active {
    color: #8b4513;
  }

  .product-image-container {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .product-main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease;
  }

  .product-main-image:hover {
    transform: scale(1.05);
  }

  .product-info {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #4b2e2e;
    margin-bottom: 10px;
    line-height: 1.2;
  }

  .product-price {
    font-size: 2rem;
    font-weight: 700;
    color: #6f4e37;
    margin-bottom: 20px;
  }

  .category-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 20px;
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

  .product-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #5c4033;
    margin-bottom: 25px;
  }

  .product-details {
    background: #fffaf3;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
  }

  .detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e8dcd3;
  }

  .detail-row:last-child {
    border-bottom: none;
  }

  .detail-label {
    font-weight: 600;
    color: #4b2e2e;
  }

  .detail-value {
    color: #6f4e37;
    font-weight: 500;
  }

  .features-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .features-list li {
    padding: 8px 0;
    border-bottom: 1px solid #e8dcd3;
    color: #5c4033;
  }

  .features-list li:last-child {
    border-bottom: none;
  }

  .features-list li i {
    color: #6f4e37;
    margin-right: 10px;
  }

  .ingredients-list {
    background: #f8f4f0;
    border-radius: 8px;
    padding: 15px;
    margin-top: 15px;
  }

  .ingredients-list h6 {
    color: #4b2e2e;
    margin-bottom: 10px;
    font-weight: 600;
  }

  .ingredients-list p {
    color: #6f4e37;
    margin: 0;
    font-size: 0.95rem;
  }

  .btn-add-to-cart {
    background-color: #6f4e37;
    border: none;
    color: white;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 15px;
  }

  .btn-add-to-cart:hover {
    background-color: #543828;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
  }

  .btn-back {
    background-color: transparent;
    border: 2px solid #6f4e37;
    color: #6f4e37;
    padding: 10px 30px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
  }

  .btn-back:hover {
    background-color: #6f4e37;
    color: white;
  }

  .quantity-selector {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  .quantity-selector label {
    font-weight: 600;
    color: #4b2e2e;
    margin-right: 15px;
  }

  .quantity-input {
    width: 80px;
    text-align: center;
    border: 2px solid #d3c1b0;
    border-radius: 8px;
    padding: 8px;
    font-weight: 600;
  }

  .quantity-input:focus {
    border-color: #a57c5b;
    outline: none;
    box-shadow: 0 0 0 0.15rem rgba(165, 124, 91, 0.25);
  }

  .recommended-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
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
    .product-title {
      font-size: 2rem;
    }
    
    .product-price {
      font-size: 1.5rem;
    }
    
    .product-main-image {
      height: 300px;
    }
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
  <main class="container flex-grow-1 my-4">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
        <li class="breadcrumb-item"><a href="offerings.php">What We Offer</a></li>
        <li class="breadcrumb-item active"><?php echo htmlspecialchars($current_product['name']); ?></li>
      </ol>
    </nav>

    <div class="row">
      <!-- Product Image -->
      <div class="col-lg-6">
        <div class="product-image-container position-relative">
          <?php if ($current_product['recommended'] >= 8): ?>
            <div class="recommended-badge">
              <i class="fas fa-star me-1"></i>Recommended
            </div>
          <?php endif; ?>
          <img src="<?php echo $current_product['image']; ?>" 
               alt="<?php echo htmlspecialchars($current_product['name']); ?>" 
               class="product-main-image">
        </div>
      </div>

      <!-- Product Information -->
      <div class="col-lg-6">
        <div class="product-info">
          <div class="category-badge badge-<?php echo $current_product['category']; ?>">
            <?php 
              $categoryNames = [
                'beverages' => 'Beverage',
                'pastries' => 'Pastry', 
                'beans' => 'Coffee Beans'
              ];
              echo $categoryNames[$current_product['category']];
            ?>
          </div>
          
          <h1 class="product-title"><?php echo htmlspecialchars($current_product['name']); ?></h1>
          <div class="product-price">$<?php echo number_format($current_product['price'], 2); ?></div>
          
          <p class="product-description"><?php echo htmlspecialchars($current_product['description']); ?></p>
          
          <!-- Product Details -->
          <div class="product-details">
            <div class="detail-row">
              <span class="detail-label">Size:</span>
              <span class="detail-value"><?php echo htmlspecialchars($current_product['size']); ?></span>
            </div>
            <div class="detail-row">
              <span class="detail-label">Category:</span>
              <span class="detail-value"><?php echo ucfirst($current_product['category']); ?></span>
            </div>
            <div class="detail-row">
              <span class="detail-label">Recommended Score:</span>
              <span class="detail-value">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <i class="fas fa-star <?php echo $i <= ($current_product['recommended'] / 2) ? 'text-warning' : 'text-muted'; ?>"></i>
                <?php endfor; ?>
                (<?php echo $current_product['recommended']; ?>/10)
              </span>
            </div>
          </div>
          
          <!-- Features -->
          <div class="mt-4">
            <h5 class="mb-3" style="color: #4b2e2e;">Features</h5>
            <ul class="features-list">
              <?php foreach ($current_product['features'] as $feature): ?>
                <li><i class="fas fa-check"></i><?php echo htmlspecialchars($feature); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          
          <!-- Ingredients -->
          <div class="ingredients-list">
            <h6>Ingredients</h6>
            <p><?php echo implode(', ', array_map('htmlspecialchars', $current_product['ingredients'])); ?></p>
          </div>
          
          <!-- Quantity and Add to Cart -->
          <div class="quantity-selector">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="10">
          </div>
          
          <button class="btn btn-add-to-cart" onclick="addToCart()">
            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
          </button>
          
          <a href="offerings.php" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
          </a>
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

    function addToCart() {
      const quantity = parseInt(document.getElementById('quantity').value);
      const productId = <?php echo $current_product['id']; ?>;
      const productName = <?php echo json_encode($current_product['name']); ?>;
      const productPrice = <?php echo $current_product['price']; ?>;
      
      let cart = getCart();
      const existingItemIndex = cart.findIndex(item => item.id === productId);
      
      if (existingItemIndex !== -1) {
        // Item already in cart, update quantity
        cart[existingItemIndex].quantity += quantity;
        if (cart[existingItemIndex].quantity > 10) {
          cart[existingItemIndex].quantity = 10;
        }
      } else {
        // New item, add to cart
        cart.push({
          id: productId,
          quantity: quantity
        });
      }
      
      saveCart(cart);
      
      // Show success message
      alert(`Added ${quantity} x ${productName} to cart!`);
    }

    // Initialize cart badge when page loads
    document.addEventListener('DOMContentLoaded', function() {
      updateCartBadge();
    });
  </script>
</body>
</html>