<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Signup Form</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php

// --- LOGIN LOGIC ---
if (isset($_POST['login'])) {
  $u = $_POST['username'];
  $p = $_POST['password'];

  $res = $conn->query("SELECT * FROM users WHERE username='$u'");
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if ($p == $row['password']) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['status'] = "✅ Login Successful!";
      header("Location:helpdesk/dashboard.php");
      exit();
    } else {
      $_SESSION['status'] = "❌ Wrong password!";
      $_SESSION['form'] = "login";
    }
  } else {
    $_SESSION['status'] = "⚠️ User not found!";
    $_SESSION['form'] = "login";
  }

  // Refresh page to show message only once
  header("Location: std3.php");
  exit();
}

// --- REGISTER LOGIC ---
if (isset($_POST['signup'])) {
  $u = $_POST['username'];
  $e = $_POST['email'];
  $p = $_POST['password'];
  $c = $_POST['confirm_password'];

  if ($p != $c) {
    $_SESSION['status'] = "❌ Passwords do not match!";
    $_SESSION['form'] = "register";
  } else {
    $insert = $conn->query("INSERT INTO users(username,email,password) VALUES('$u','$e','$p')");
    if ($insert) {
      $_SESSION['status'] = "✅ Registered Successfully! You can now log in.";
      $_SESSION['form'] = "register";
    } else {
      $_SESSION['status'] = "⚠️ Something went wrong. Try again!";
      $_SESSION['form'] = "register";
    }
  }

  // Refresh page to show message only once
  header("Location: std3.php");
  exit();
}
?>


<div class="container <?= (isset($_POST['signup']) || (isset($_SESSION['form']) && $_SESSION['form'] === 'register')) ? 'active' : '' ?>">
 
  <!-- ===== LOGIN FORM ===== -->
  <div class="form-box login">
    <?php if (isset($_SESSION['status']) && (!isset($_SESSION['form']) || $_SESSION['form'] !== 'register')): ?>
      <div class="alert <?= (strpos($_SESSION['status'], '✅') !== false) ? 'alert-success' : 'alert-danger'; ?>">
        <?= $_SESSION['status']; ?>
      </div>
    <?php endif; ?>
    <form action="std3.php" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required />
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required />
        <i class="fa-solid fa-lock"></i>
      </div>
      <div class="forgot-link">
        <a href="forgot-password.php">Forgot Password?</a>
      </div>
      <div class="forgot-link">
        <a href="admin_login.php">Admin?</a>
      </div>
      <button type="submit" name="login" class="btn">Login</button>
      <p>or login with social platforms</p>
      <div class="social-icons">
        <a href="#"><i class="fa-brands fa-google"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-github"></i></a>
        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </form>
  </div>

  <!-- ===== REGISTER FORM ===== -->
  <div class="form-box register">
    <?php if (isset($_SESSION['status']) && isset($_SESSION['form']) && $_SESSION['form'] === 'register'): ?>
      <div class="alert <?= (strpos($_SESSION['status'], '✅') !== false) ? 'alert-success' : 'alert-danger'; ?>">
        <?= $_SESSION['status']; ?>
      </div>
    <?php endif; ?>
    <form action="std3.php" method="post">
      <h1>Registration</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required />
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" required />
        <i class="fa-solid fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required />
        <i class="fa-solid fa-eye toggle-eye"></i>
      </div>
      <div class="input-box">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
        <i class="fa-solid fa-eye toggle-eye" ></i>
      </div>
      <button type="submit" name="signup" class="btn">Register</button>
      <p>or register with social platforms</p>
      <div class="social-icons">
        <a href="#"><i class="fa-brands fa-google"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-github"></i></a>
        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </form>
  </div>

  <!-- ===== TOGGLE BOX ===== -->
  <div class="toggle-box">
    <div class="toggle-panel toggle-left">
      <h1>Hello, Welcome Students!</h1>
      <p>Don't have an account?</p>
      <button class="btn register-btn">Register</button>
    </div>
    <div class="toggle-panel toggle-right">
      <h1>Welcome Back Students!</h1>
      <p>Already have an account?</p>
      <button class="btn login-btn">Login</button>
    </div>
  </div>
</div>



<?php
// Clear session messages after showing
if (isset($_SESSION['status'])) {
  unset($_SESSION['status']);
}
if (isset($_SESSION['form'])) {
  unset($_SESSION['form']);
}
?>

<script src="script.js"></script>
</body>
</html>

