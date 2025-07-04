<?php
require 'config.php';

try {
    // Customers table
    $pdo->exec("CREATE TABLE IF NOT EXISTS customers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        city VARCHAR(50),
        INDEX(name)
    ) ENGINE=InnoDB");

    // Orders table
    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT,
        amount DECIMAL(10,2),
        order_date DATE,
        FOREIGN KEY (customer_id) REFERENCES customers(id)
    ) ENGINE=InnoDB");

    // Insert customers and get their IDs
    $pdo->exec("INSERT INTO customers (name, city) VALUES ('Alice', 'Delhi')");
    $aliceId = $pdo->lastInsertId();

    $pdo->exec("INSERT INTO customers (name, city) VALUES ('Bob', 'Mumbai')");
    $bobId = $pdo->lastInsertId();

    // Insert orders using prepared statement
    $stmt = $pdo->prepare("INSERT INTO orders (customer_id, amount, order_date) VALUES (?, ?, ?)");
    $stmt->execute([$aliceId, 200.50, '2024-06-01']);
    $stmt->execute([$aliceId, 300.00, '2024-06-02']);
    $stmt->execute([$bobId, 150.75, '2024-06-03']);

    echo "Setup complete.";
} catch (PDOException $e) {
    echo "Setup failed: " . $e->getMessage();
}
?>
