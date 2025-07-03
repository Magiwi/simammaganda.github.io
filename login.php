<?php
session_start();



$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $found = false;

    if (file_exists("user.txt")) {
        $lines = file("user.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $fields = explode("|", $line);

            // Username is at index 10, password at index 11
            if (isset($fields[10], $fields[11]) && $username === trim($fields[10]) && $password === trim($fields[11])) {
                $_SESSION['user'] = $fields[0]; // Full name

                // Save all registration details in session for welcome.php
                $_SESSION['registration'] = [
                    'fullname' => $fields[0],
                    'gender' => $fields[1],
                    'dob' => $fields[2],
                    'phone' => $fields[3],
                    'email' => $fields[4],
                    'street' => $fields[5],
                    'city' => $fields[6],
                    'state' => $fields[7],
                    'zipcode' => $fields[8],
                    'country' => $fields[9],
                    'username' => $fields[10]
                    // Password is intentionally not stored in session
                ];

                $found = true;
                break;
            }
        }
    }

    if ($found) {
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Momento Coffee Shop - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
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
</style>


</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <img src="picture/pic1.png" alt="Logo" style="width:60px;height:40px; margin-left: 10px;">
    <a class="navbar-brand" href="homepage.php">Momento</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="offerings.php">What We Offer</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main class="container my-5 flex-grow-1">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="card-title mb-4 text-center">Customer Login</h4>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
          <?php endif; ?>

          <form method="POST" action="login.php">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
              
            </div>
            <div class="mb-3 text-center">
            <a href="register.php" class="btn btn-outline-dark w-100">Don't have an account? Register</a>
          </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="text-white text-center py-3 mt-auto">
  <div class="container">
    <h4>@ABARICO, JUSTINKIM.</h4>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
