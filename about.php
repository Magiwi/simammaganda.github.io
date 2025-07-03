<?php
// Handle contact form submission
$form_submitted = false;
$form_message = '';

if ($_POST && isset($_POST['contact_form'])) {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Basic validation
    if ($name && $email && $subject && $message) {
        // In a real application, you would send email or save to database
        $form_submitted = true;
        $form_message = "Thank you for contacting us! We'll get back to you within 24 hours.";
    } else {
        $form_message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us - Momento Coffee Shop</title>
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

  .page-header p {
    font-size: 1.2rem;
    opacity: 0.9;
  }

  .content-section {
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(111, 78, 55, 0.1);
    border: 1px solid #e8dcd3;
    margin-bottom: 30px;
  }

  .section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #4b2e2e;
    margin-bottom: 20px;
  }

  .section-subtitle {
    font-size: 1.3rem;
    font-weight: 600;
    color: #6f4e37;
    margin-bottom: 15px;
  }

  .content-text {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #5c4033;
    margin-bottom: 20px;
  }

  .team-member {
    text-align: center;
    margin-bottom: 30px;
  }

  .team-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 15px;
    border: 4px solid #e8dcd3;
  }

  .team-name {
    font-weight: 700;
    color: #4b2e2e;
    font-size: 1.2rem;
    margin-bottom: 5px;
  }

  .team-role {
    color: #6f4e37;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .team-bio {
    color: #5c4033;
    font-size: 0.95rem;
  }

  .contact-info {
    background: #fffaf3;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
  }

  .contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .contact-item:last-child {
    margin-bottom: 0;
  }

  .contact-icon {
    font-size: 1.2rem;
    color: #6f4e37;
    margin-right: 15px;
    width: 20px;
  }

  .contact-text {
    color: #4b2e2e;
    font-weight: 600;
  }

  .form-control, .form-select, .form-control textarea {
    border-radius: 10px;
    border: 1px solid #d3c1b0;
    padding: 12px 16px;
    margin-bottom: 20px;
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

  .btn-submit {
    background-color: #6f4e37;
    border: none;
    color: white;
    padding: 12px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #543828;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
  }

  .alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
  }

  .alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
  }

  .values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-top: 20px;
  }

  .value-item {
    text-align: center;
    padding: 20px;
    background: #fffaf3;
    border-radius: 10px;
    border: 1px solid #e8dcd3;
  }

  .value-icon {
    font-size: 3rem;
    color: #6f4e37;
    margin-bottom: 15px;
  }

  .value-title {
    font-weight: 700;
    color: #4b2e2e;
    margin-bottom: 10px;
  }

  .value-text {
    color: #5c4033;
    font-size: 0.95rem;
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
    
    .section-title {
      font-size: 1.5rem;
    }
    
    .values-grid {
      grid-template-columns: 1fr;
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
          <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
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
      <h1>About Momento</h1>
      <p>Learn about our passion for coffee and commitment to excellence</p>
    </div>
  </div>

  <!-- Main Content Area -->
  <main class="container flex-grow-1">
    
    <!-- Company Story -->
    <div class="content-section">
      <h2 class="section-title">Our Story</h2>
      <p class="content-text">
        Founded in 2020, Momento Coffee Shop began as a small dream to create the perfect gathering place for coffee lovers, students, and young professionals. Located in the heart of the city, we've grown from a single location to become a beloved community hub where people come not just for exceptional coffee, but for meaningful connections and memorable moments.
      </p>
      <p class="content-text">
        Our name "Momento" reflects our belief that every cup of coffee creates a special moment worth savoring. Whether you're starting your day with our signature espresso, meeting friends over a caramel macchiato, or finding the perfect spot to work with a smooth americano, we're here to make every visit memorable.
      </p>
      <p class="content-text">
        We source our beans directly from sustainable farms, ensuring that every cup supports both quality and ethical practices. Our skilled baristas craft each drink with care, and our freshly baked pastries are made daily using traditional recipes and the finest ingredients.
      </p>
    </div>

    <!-- Our Values -->
    <div class="content-section">
      <h2 class="section-title">Our Values</h2>
      <div class="values-grid">
        <div class="value-item">
          <i class="fas fa-heart value-icon"></i>
          <h4 class="value-title">Quality First</h4>
          <p class="value-text">We never compromise on the quality of our coffee beans, ingredients, or service. Every cup is crafted with precision and care.</p>
        </div>
        <div class="value-item">
          <i class="fas fa-users value-icon"></i>
          <h4 class="value-title">Community</h4>
          <p class="value-text">We're more than a coffee shop - we're a gathering place where relationships flourish and memories are made.</p>
        </div>
        <div class="value-item">
          <i class="fas fa-leaf value-icon"></i>
          <h4 class="value-title">Sustainability</h4>
          <p class="value-text">We believe in supporting sustainable farming practices and minimizing our environmental impact through responsible sourcing.</p>
        </div>
        <div class="value-item">
          <i class="fas fa-smile value-icon"></i>
          <h4 class="value-title">Customer Experience</h4>
          <p class="value-text">Every interaction should leave you feeling welcomed, valued, and eager to return. Your satisfaction is our priority.</p>
        </div>
      </div>
    </div>

    <!-- Team Section -->
    <div class="content-section">
      <h2 class="section-title">Meet Our Team</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="team-member">
            <img src="https://pixabay.com/get/gced7bfa6b7d5bf5eca3e2d3b5e5db99e4e5c4f5d6a7e8d3c4d2e3f4b5a6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1_1280.jpg" alt="Sarah Johnson" class="team-avatar">
            <h4 class="team-name">Sarah Johnson</h4>
            <p class="team-role">Founder & Head Barista</p>
            <p class="team-bio">With over 10 years in the coffee industry, Sarah brings passion and expertise to every cup. She personally selects our coffee beans and trains our team.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="team-member">
            <img src="https://pixabay.com/get/g02b6b3e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2c3d4e5_1280.jpg" alt="Mike Chen" class="team-avatar">
            <h4 class="team-name">Mike Chen</h4>
            <p class="team-role">Head Pastry Chef</p>
            <p class="team-bio">Mike creates all our delicious pastries and baked goods fresh daily. His culinary background brings creativity and flavor to our menu.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="team-member">
            <img src="https://pixabay.com/get/ge5f4e3d2c1b0a9f8e7d6c5b4a3f2e1d0c9b8a7f6e5d4c3b2a1f0e9d8c7b6a5f4e3d2c1b0a9f8e7d6c5b4a3f2e1d0c9b8a7f6e5d4c3b2a1f0e9d8c7b6a5f4e3d2c1b0a9f8e7d6c5b4a3f2e1d0c9b8a7f6e5d4c3b2a1f0e9d8c7b6a5f4e3d2c1b0a9f8e7d6c5b4a3f2e1_1280.jpg" alt="Emma Rodriguez" class="team-avatar">
            <h4 class="team-name">Emma Rodriguez</h4>
            <p class="team-role">Customer Experience Manager</p>
            <p class="team-bio">Emma ensures every customer feels welcome and valued. She manages our daily operations and leads our customer service initiatives.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="content-section">
      <h2 class="section-title">Visit Us</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="contact-info">
            <h3 class="section-subtitle">Store Information</h3>
            <div class="contact-item">
              <i class="fas fa-map-marker-alt contact-icon"></i>
              <span class="contact-text">123 Coffee Street, Downtown District, NY 10001</span>
            </div>
            <div class="contact-item">
              <i class="fas fa-phone contact-icon"></i>
              <span class="contact-text">(555) 123-CAFE (2233)</span>
            </div>
            <div class="contact-item">
              <i class="fas fa-envelope contact-icon"></i>
              <span class="contact-text">hello@momentocoffee.com</span>
            </div>
            <div class="contact-item">
              <i class="fas fa-clock contact-icon"></i>
              <span class="contact-text">Mon-Fri: 6:00 AM - 8:00 PM<br>Sat-Sun: 7:00 AM - 9:00 PM</span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-info">
            <h3 class="section-subtitle">Follow Us</h3>
            <div class="contact-item">
              <i class="fab fa-instagram contact-icon"></i>
              <span class="contact-text">@momentocoffee</span>
            </div>
            <div class="contact-item">
              <i class="fab fa-facebook contact-icon"></i>
              <span class="contact-text">Momento Coffee Shop</span>
            </div>
            <div class="contact-item">
              <i class="fab fa-twitter contact-icon"></i>
              <span class="contact-text">@momentocafe</span>
            </div>
            <div class="contact-item">
              <i class="fas fa-wifi contact-icon"></i>
              <span class="contact-text">Free WiFi Available</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="content-section">
      <h2 class="section-title">Get In Touch</h2>
      <p class="content-text">Have a question, suggestion, or just want to say hello? We'd love to hear from you!</p>
      
      <?php if ($form_message): ?>
        <div class="alert <?php echo $form_submitted ? 'alert-success' : 'alert-danger'; ?>">
          <?php echo $form_message; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="hidden" name="contact_form" value="1">
        <div class="row">
          <div class="col-md-6">
            <label for="name" class="form-label">Full Name *</label>
            <input type="text" class="form-control" id="name" name="name" required 
                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email Address *</label>
            <input type="email" class="form-control" id="email" name="email" required
                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone"
                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
          </div>
          <div class="col-md-6">
            <label for="subject" class="form-label">Subject *</label>
            <select class="form-select" id="subject" name="subject" required>
              <option value="">Choose a subject</option>
              <option value="general" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'general') ? 'selected' : ''; ?>>General Inquiry</option>
              <option value="feedback" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'feedback') ? 'selected' : ''; ?>>Feedback</option>
              <option value="catering" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'catering') ? 'selected' : ''; ?>>Catering Services</option>
              <option value="partnership" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'partnership') ? 'selected' : ''; ?>>Partnership Opportunity</option>
              <option value="complaint" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'complaint') ? 'selected' : ''; ?>>Complaint</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message *</label>
          <textarea class="form-control" id="message" name="message" rows="5" required 
                    placeholder="Tell us how we can help you..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        </div>
        <button type="submit" class="btn-submit">
          <i class="fas fa-paper-plane me-2"></i>Send Message
        </button>
      </form>
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