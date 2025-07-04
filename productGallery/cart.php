<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
  die("Please log in to view your cart.");
}

$userId = $_SESSION['user_id'];
$cartItems = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $id = $product['id'];
        $qty = $_SESSION['cart'][$id];
        $subtotal = $product['price'] * $qty;
        $cartItems[] = [
            'id' => $id,
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $qty,
            'subtotal' => $subtotal
        ];
        $total += $subtotal;
    }

    foreach ($cartItems as $item) {
      $insert = $pdo->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
      $insert->execute([$userId, $item['id'], $item['quantity']]);
  }

  // ✅ Clear cart after placing order
  // unset($_SESSION['cart']);
}
?>

<h2>Your Cart</h2>
<?php if ($cartItems): ?>
  <ul>
    <?php foreach ($cartItems as $item): ?>
      <li>
        <?= htmlspecialchars($item['name']) ?> - ₹<?= $item['price'] ?> x <?= $item['quantity'] ?>
        = ₹<?= number_format($item['subtotal'], 2) ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <h3>Total: ₹<?= number_format($total, 2) ?></h3>
<?php else: ?>
  <p>Your cart is empty.</p>
<?php endif; ?>
<div>
  <a href="orders.php">View My Orders</a>
</div>
<div>
  <a href="index.php">Back to Products</a>
</div>
