<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $pass]);

    echo "<script>
    alert('Signup successful! Redirecting to login...');
    window.location.href = 'login.php';
    </script>";

    echo "<div style='color: green; text-align: center;'>Signup successful. <a href='login.php'>Login</a></div>";

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .signup-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      width: 96%;
      padding: 10px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <h2>Sign Up</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Name" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Sign Up">
    </form>
  </div>
</body>
</html>
