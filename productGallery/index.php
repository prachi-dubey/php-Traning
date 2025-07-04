<?php
require 'config.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
  $productId = (int) $_POST['product_id'];
  $userId = $_SESSION['user_id'];

  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }

  if (!isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId] = 1;
  } else {
      $_SESSION['cart'][$productId]++;
  }

  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Product Listing</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 30px;
      background-color: #f0f0f0;
    }

    .auth-buttons {
      margin-bottom: 20px;
    }

    .auth-buttons a {
      text-decoration: none;
      padding: 10px 15px;
      background-color: #007BFF;
      color: white;
      border-radius: 5px;
      margin-right: 10px;
    }

    .auth-buttons a:hover {
      background-color: #0056b3;
    }

    .product {
      background: white;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      width: 300px;
    }

    img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
  <h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?> |
    <a href="logout.php">Logout</a>
  </h2>

  <a href="add-product.php" style="display:inline-block;margin:10px 0;padding:10px 15px;background:#28a745;color:#fff;text-decoration:none;border-radius:5px;">➕ Add Product</a>
  <a href="cart.php" style="float: right; margin: 10px;">🛒 View Cart</a>
  
  <div style="display: flex;flex-wrap: wrap;">
    <?php
      $stmt = $pdo->query("SELECT * FROM products");
      while ($row = $stmt->fetch()):
      ?>
        <div class="product" style="margin: 20px;">
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="max-width: 200px;">
          <p><strong>Price:</strong> ₹<?= htmlspecialchars($row['price']) ?></p>
          <form method="POST" action="index.php" style="margin-top: 10px;">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <input type="submit" value="Add to Cart">
          </form>
        </div>
    <?php endwhile; ?>
  </div>

<?php else: ?>
  <div class="auth-buttons">
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
  </div>
  <p>Please log in to view the products.</p>
<?php endif; ?>

</body>
</html>
