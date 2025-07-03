<?php
session_start(); // Start the session

$DBConnect = mysqli_connect("localhost", "root", "", "momento");
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$errors = [];
$values = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = ['fullname', 'gender', 'dob', 'phone', 'email', 'street', 'city', 'state', 'zipcode', 'country', 'username', 'password', 'confirm_password'];
    foreach ($fields as $field) {
        $values[$field] = trim($_POST[$field] ?? '');
    }

    if (!preg_match("/^[A-Za-z ]{2,50}$/", $values['fullname'])) {
        $errors['fullname'] = "Full name must be 2-50 characters long and contain letters and spaces only.";
    }

    if (empty($values['gender'])) {
        $errors['gender'] = "Please select a gender.";
    }

    $dob = DateTime::createFromFormat('Y-m-d', $values['dob']);
    if (!$dob || $dob->diff(new DateTime())->y < 18) {
        $errors['dob'] = "You must be at least 18 years old.";
    }

    if (!preg_match("/^09\d{9}$/", $values['phone'])) {
        $errors['phone'] = "Phone number must start with '09' and be 11 digits.";
    }

    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.(com|net|org|edu)$/", $values['email'])) {
        $errors['email'] = "Enter a valid email ending in .com, .net, .org, or .edu.";
    }

    if (!preg_match("/^[\w\s.,'#-]{5,100}$/", $values['street'])) {
        $errors['street'] = "Street must be 5-100 characters and contain valid address characters.";
    }

    foreach (['city', 'state'] as $loc) {
        if (!preg_match("/^[A-Za-z ]{2,50}$/", $values[$loc])) {
            $errors[$loc] = ucfirst($loc) . " must be 2-50 letters and spaces only.";
        }
    }

    if (!preg_match("/^\d{4}$/", $values['zipcode'])) {
        $errors['zipcode'] = "Zip code must be exactly 4 digits.";
    }

    if (!preg_match("/^[A-Za-z ]+$/", $values['country'])) {
        $errors['country'] = "Country must contain letters and spaces only.";
    }

    if (!preg_match("/^\w{5,20}$/", $values['username'])) {
        $errors['username'] = "Username must be 5-20 characters (letters, numbers, underscore).";
    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $values['password'])) {
        $errors['password'] = "Password must be at least 8 characters and include uppercase, lowercase, digit, and special character.";
    }

    if ($values['password'] !== $values['confirm_password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
    // Check if username already exists
    $file = "user.txt";
    $usernameExists = false;

    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $parts = explode("|", $line);
            if (isset($parts[11]) && $parts[11] === $values['username']) {
                $usernameExists = true;
                break;
            }
        }
    }

    if ($usernameExists) {
        $errors['username'] = "Username already exists. Please choose another.";
    } else {
        // Save user data
        $data = implode("|", [
            $values['fullname'], $values['gender'], $values['dob'],
            $values['phone'], $values['email'], $values['street'],
            $values['city'], $values['state'], $values['zipcode'],
            $values['country'], $values['username'], $values['password']
        ]);

        file_put_contents($file, $data . PHP_EOL, FILE_APPEND);

        $_SESSION['username'] = $values['username'];
        header("Location: welcome.php");
        exit;
    }
        if (empty($errors)) {
        $username = mysqli_real_escape_string($DBConnect, $values['username']);
        $check = mysqli_query($DBConnect, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            $errors['username'] = "Username already exists. Please choose another.";
        } else {

            $stmt = mysqli_prepare($DBConnect, "INSERT INTO users (fullname, gender, dob, phone, email, street, city, state, zipcode, country, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssssssssss",
                $values['fullname'], $values['gender'], $values['dob'],
                $values['phone'], $values['email'], $values['street'],
                $values['city'], $values['state'], $values['zipcode'],
                $values['country'], $values['username'],$values['password'],
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['username'] = $values['username'];
                header("Location: welcome.php");
                exit;
            } else {
                $message = "Database error: " . mysqli_error($DBConnect);
            }
        }
    }  
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Momento Coffee Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fffaf3;
    }
    .navbar, footer {
      background-color: #6f4e37;
    }
    .navbar-brand, .nav-link, footer p {
      color: #fff !important;
    }
    .nav-link.btn {
      color: #fff !important;
      background-color: #5c4033;
      margin-left: 10px;
    }
    label {
      font-weight: 600;
    }
    .form-section {
      background: linear-gradient(135deg, #fffaf3, #f5e6d3);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(111, 78, 55, 0.2);
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <img src="picture/pic1.png" alt="Logo" style="width:60px;height:40px; margin-left: 10px;">
    <a class="navbar-brand" href="#">Momento</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#">What We Offer</a></li>
        <li class="nav-item"><a class="nav-link btn" href="login.php">Log In</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-5 flex-grow-1">
  <div class="row justify-content-center">
    <div class="col-md-8 form-section">
      <h2 class="mb-4 text-center">Register an Account</h2>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          Please correct the errors below.
        </div>
      <?php endif; ?>

      <form method="post" action="">
        <h5 class="mb-3">Personal Information</h5>
        <!-- Full Name -->
        <div class="mb-3">
          <label for="fullname" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullname" name="fullname"
                 value="<?= htmlspecialchars($values['fullname'] ?? '') ?>" required />
          <?php if (isset($errors['fullname'])): ?>
            <small class="text-danger"><?= $errors['fullname'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Gender -->
        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select" id="gender" name="gender" required>
            <option value="" disabled <?= empty($values['gender']) ? 'selected' : '' ?>>Choose...</option>
            <option value="Male" <?= ($values['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= ($values['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= ($values['gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
          </select>
          <?php if (isset($errors['gender'])): ?>
            <small class="text-danger"><?= $errors['gender'] ?></small>
          <?php endif; ?>
        </div>

        <!-- DOB -->
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob"
                 value="<?= htmlspecialchars($values['dob'] ?? '') ?>" required />
          <?php if (isset($errors['dob'])): ?>
            <small class="text-danger"><?= $errors['dob'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Phone -->
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone"
                 value="<?= htmlspecialchars($values['phone'] ?? '') ?>" required />
          <?php if (isset($errors['phone'])): ?>
            <small class="text-danger"><?= $errors['phone'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email"
                 value="<?= htmlspecialchars($values['email'] ?? '') ?>" required />
          <?php if (isset($errors['email'])): ?>
            <small class="text-danger"><?= $errors['email'] ?></small>
          <?php endif; ?>
        </div>

        <h5 class="mb-3 mt-4">Address Details</h5>

        <!-- Street -->
        <div class="mb-3">
          <label for="street" class="form-label">Street</label>
          <input type="text" class="form-control" id="street" name="street"
                 value="<?= htmlspecialchars($values['street'] ?? '') ?>" required />
          <?php if (isset($errors['street'])): ?>
            <small class="text-danger"><?= $errors['street'] ?></small>
          <?php endif; ?>
        </div>

        <!-- City -->
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" name="city"
                 value="<?= htmlspecialchars($values['city'] ?? '') ?>" required />
          <?php if (isset($errors['city'])): ?>
            <small class="text-danger"><?= $errors['city'] ?></small>
          <?php endif; ?>
        </div>

        <!-- State -->
        <div class="mb-3">
          <label for="state" class="form-label">Province/State</label>
          <input type="text" class="form-control" id="state" name="state"
                 value="<?= htmlspecialchars($values['state'] ?? '') ?>" required />
          <?php if (isset($errors['state'])): ?>
            <small class="text-danger"><?= $errors['state'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Zipcode -->
        <div class="mb-3">
          <label for="zipcode" class="form-label">Zip Code</label>
          <input type="text" class="form-control" id="zipcode" name="zipcode"
                 value="<?= htmlspecialchars($values['zipcode'] ?? '') ?>" required />
          <?php if (isset($errors['zipcode'])): ?>
            <small class="text-danger"><?= $errors['zipcode'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Country -->
        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <input type="text" class="form-control" id="country" name="country"
                 value="<?= htmlspecialchars($values['country'] ?? '') ?>" required />
          <?php if (isset($errors['country'])): ?>
            <small class="text-danger"><?= $errors['country'] ?></small>
          <?php endif; ?>
        </div>

        <h5 class="mb-3 mt-4">Account Details</h5>

        <!-- Username -->
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username"
                 value="<?= htmlspecialchars($values['username'] ?? '') ?>" required />
          <?php if (isset($errors['username'])): ?>
            <small class="text-danger"><?= $errors['username'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required />
          <?php if (isset($errors['password'])): ?>
            <small class="text-danger"><?= $errors['password'] ?></small>
          <?php endif; ?>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
          <?php if (isset($errors['confirm_password'])): ?>
            <small class="text-danger"><?= $errors['confirm_password'] ?></small>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-dark w-100 mt-3">Register</button>
        
      </form>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="text-white text-center py-3 mt-auto">
  <div class="container">
    <p class="mb-0">© 2025 Momento Coffee Shop. Brewing joy daily.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
