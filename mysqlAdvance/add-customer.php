<?php
require 'config.php';

$name = trim($_POST['name']);
$city = trim($_POST['city']);

$stmt = $pdo->prepare("INSERT INTO customers (name, city) VALUES (:name, :city)");
$stmt->execute(['name' => $name, 'city' => $city]);

header("Location: index.php");
exit();
?>