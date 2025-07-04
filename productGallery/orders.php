<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your orders.");
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT p.name, p.image, o.quantity, o.order_date
  FROM orders o
  JOIN products p ON o.product_id = p.id
  WHERE o.user_id = ?
  ORDER BY o.order_date DESC
");

// error_log("Raw SQL: " . $stmt->queryString); //php log

$stmt->execute([$userId]);
$orders = $stmt->fetchAll();

echo "<script>";
echo "console.log(" . json_encode([
  'SQL' => $stmt->queryString,
  'User ID' => $orders
]) . ");";
echo "</script>";
?>

<h2>My Orders</h2>
<?php foreach ($orders as $order): ?>
  <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <h3><?= htmlspecialchars($order['name']) ?></h3>
    <img src="<?= htmlspecialchars($order['image']) ?>" width="100">
    <p>Quantity: <?= $order['quantity'] ?></p>
    <p>Order Date: <?= $order['order_date'] ?></p>
  </div>
<?php endforeach; ?>
