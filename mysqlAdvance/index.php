<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer & Order System</title>
  <style>
    .form-box { margin-bottom: 30px; background: #f2f2f2; padding: 20px; width: 400px; }
    input, select { width: 100%; margin: 5px 0 10px; padding: 8px; }
    .container { margin: 0 100px; }
  </style>
</head>
<body>
  <div style="display: flex;">
    <div class="container">
      <h2>Add New Customer</h2>
      <form class="form-box" action="add-customer.php" method="POST">
        <input type="text" name="name" placeholder="Customer Name" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="submit" value="Add Customer">
      </form>

      <h2>Add New Order</h2>
      <form class="form-box" action="add-order.php" method="POST">
        <select name="customer_id" required>
          <option value="">-- Select Customer --</option>
          <?php
          require 'config.php';
          $stmt = $pdo->query("SELECT id, name FROM customers");
          foreach ($stmt as $row) {
              echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
          }
          ?>
        </select>
        <input type="number" step="0.01" name="amount" placeholder="Order Amount" required>
        <input type="date" name="order_date" required>
        <input type="submit" value="Add Order">
      </form>
    </div>
    
    <div class="container">
      <?php include 'queries.php'; ?> <!-- only once here -->
    </div>
  </div>
</body>
</html>
