<?php
include "connection.php";
session_start();

if (isset($_POST['login'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check admin credentials
  $res = $conn->query("SELECT * FROM admins WHERE name='$name' AND email='$email'");
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if ($password == $row['password']) {
      $_SESSION['status'] = "✅ Login Successful!";
      header("Location:admin_dashboard.php");
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
  header("Location: admin_login.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif; 
            background: url('pastel.jpg'), #d794f6ff;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 100px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            width: 330px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #4a148c;
        }

        /* 👇 Updated Input wrapper */
        .input-box {
            display: flex;
            align-items: center;
            background: #f4f4f4;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 8px 10px;
        }

        /* 👇 Icon outside input */
        .input-box i {
            color: #6a0dad;
            font-size: 18px;
            margin-right: 10px;
        }

        /* 👇 Input field */
        .input-box input {
            border: none;
            background: transparent;
            outline: none;
            flex: 1;
            font-size: 14px;
            padding: 8px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #6a0dad;
            border: none;
            border-radius: 9px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .login-box button:hover {
            background: #4a148c;
        }
    </style>
</head>
<body>





    <div class="login-box">
       
        <h2>Admin Login</h2>
        <form action=" " method="POST">

            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="Admin Username" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
