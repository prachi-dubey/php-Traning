<?php
require 'config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];

         // ✅ Console log the PHP user array
    echo "<script>console.log(" . json_encode($user) . ");</script>";

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password. <a href='signup.php'>Sign up here</a> if you don't have an account.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-box input[type="email"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-box input[type="submit"] {
      width: 100%;
      padding: 10px;
      background: #007BFF;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-box input[type="submit"]:hover {
      background: #0056b3;
    }

    .error {
      color: red;
      margin-bottom: 10px;
      font-size: 0.9em;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <?php if ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Login">
  </form>
</div>

</body>
</html>
