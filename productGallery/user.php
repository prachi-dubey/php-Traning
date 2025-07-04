<?php
require 'config.php';

try {
  // users table
  $pdo->exec("CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100) UNIQUE,
      password VARCHAR(255) NOT NULL,
      INDEX(name)
  ) ENGINE=InnoDB");

  // products table
  $pdo->exec("CREATE TABLE IF NOT EXISTS products (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      image VARCHAR(255),
      price DECIMAL(10,2) NOT NULL
  ) ENGINE=InnoDB");

  // order table
  $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
  ) ENGINE=InnoDB");

} catch (PDOException $e) {
    echo "Setup failed: " . $e->getMessage();
}
?>
