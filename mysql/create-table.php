<?php
require_once 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    weight INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$pdo->exec($sql);

try {
    $alter = "
        ALTER TABLE users 
        ADD COLUMN address VARCHAR(255) NOT NULL,
        ADD COLUMN phone_number VARCHAR(20) NOT NULL,
        ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
    ";
    $pdo->exec($alter);
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column') === false) {
        die("Table update failed: " . $e->getMessage());
    }
}
?>
