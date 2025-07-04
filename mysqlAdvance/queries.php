<?php
require 'config.php';

// Distinct Removes duplicate names from results.
echo "<h3>Distinct Customers</h3>";
foreach ($pdo->query("SELECT DISTINCT name FROM customers") as $row) {
    echo $row['name'] . "<br>";
}

// GROUP BY, aggregation functions, JOIN
echo "<h3>Total Spend by Customer</h3>";
$sql = "SELECT c.name, SUM(o.amount) AS total FROM customers c
        JOIN orders o ON c.id = o.customer_id
        GROUP BY c.id";
foreach ($pdo->query($sql) as $row) {
    echo "{$row['name']} - ₹{$row['total']}<br>";
}

// subqueries, MAX(), correlated subquery, Joins
echo "<h3>Latest Order Per Customer</h3>";
$sql = "SELECT c.name, o.amount, o.order_date FROM orders o
  JOIN customers c ON c.id = o.customer_id
  WHERE o.order_date = (
      SELECT MAX(order_date)
      FROM orders o2
      WHERE o2.customer_id = o.customer_id
  )";
foreach ($pdo->query($sql) as $row) {
    echo "{$row['name']} - ₹{$row['amount']} on {$row['order_date']}<br>";
}

// INNER JOIN: Returns only matched records (you already use this)
echo "<h3>INNER JOIN - Customers with Orders</h3>";
$sql = "SELECT c.name, o.amount 
        FROM customers c 
        INNER JOIN orders o ON c.id = o.customer_id";
foreach ($pdo->query($sql) as $row) {
    echo "{$row['name']} - ₹{$row['amount']}<br>";
}

// LEFT JOIN: Returns all customers, even those with no orders
echo "<h3>LEFT JOIN - All Customers (Even without Orders)</h3>";
$sql = "SELECT c.name, o.amount 
        FROM customers c 
        LEFT JOIN orders o ON c.id = o.customer_id";
foreach ($pdo->query($sql) as $row) {
    $amount = $row['amount'] ?? 'No Orders';
    echo "{$row['name']} - ₹{$amount}<br>";
}


// HAVING Clause (for filtering aggregates)
echo "<h3>Customers Who Spent More Than ₹300</h3>";
$sql = "SELECT c.name, SUM(o.amount) AS total 
        FROM customers c
        JOIN orders o ON c.id = o.customer_id
        GROUP BY c.id
        HAVING total > 300";
foreach ($pdo->query($sql) as $row) {
    echo "{$row['name']} - ₹{$row['total']}<br>";
}

?>
