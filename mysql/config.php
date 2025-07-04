<?php
error_reporting(0);

// MySQL configuration
$servername = "localhost";
$username = "root";       // MAMP default
$password = "root";       // MAMP default password
$dbname = "my_test_db";
$charset = "utf8mb4";

$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

// checking connection
try {
    $pdo = new PDO($dsn, $username, $password);  // Use $pdo here, not $conn
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>