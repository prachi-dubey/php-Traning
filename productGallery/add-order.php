<?php
require 'config.php';

$cid = (int) $_POST['customer_id'];
$amount = (float) $_POST['amount'];
$date = $_POST['order_date'];

$stmt = $pdo->prepare("INSERT INTO orders (customer_id, amount, order_date)
                       VALUES (:cid, :amount, :date)");
$stmt->execute([
  'cid' => $cid,
  'amount' => $amount,
  'date' => $date
]);

header("Location: index.php");
exit();
?>
