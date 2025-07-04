<?php
require_once 'create-table.php';
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>User App</title>
  <style>
    /* Same styles as before */
  </style>
</head>
<body>

<?php include 'form.php'; ?>

<?php if ($users): ?>
<div class="table-container" style="margin-top: 40px;">
  <h2>Submitted Users</h2>
  <table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Name</th>
        <th>Weight</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['name']) ?></td>
          <td><?= $user['weight'] ?></td>
          <td><?= htmlspecialchars($user['address']) ?></td>
          <td><?= htmlspecialchars($user['phone_number']) ?></td>
          <td><?= $user['created_at'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php endif; ?>

</body>
</html>
