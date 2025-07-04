<?php
// require 'config.php';
require_once __DIR__ . '/../config.php';
session_start();

// Simulate admin check
$isAdmin = true;
if (!$isAdmin) {
    echo "Access denied.";
    exit;
}

$message = '';

// ✅ Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->execute([$_POST['new_name'], $_POST['edit_id']]);
    $message = "User updated successfully.";
}

// ✅ Handle Delete
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $message = "User deleted successfully.";
}

// ✅ Handle Search
$searchTerm = $_GET['search'] ?? '';
if ($searchTerm !== '') {
    $stmt = $pdo->prepare("SELECT id, name, email, score_percent FROM users 
                           WHERE name LIKE ? OR email LIKE ?");
    $stmt->execute(["%$searchTerm%", "%$searchTerm%"]);
} else {
    $stmt = $pdo->query("SELECT id, name, email, score_percent FROM users");
}
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel - Search Users</title>
  <style>
    table { border-collapse: collapse; width: 80%; }
    th, td { border: 1px solid #ccc; padding: 8px; }
    form.edit-form { display: inline; }
  </style>
</head>
<body>

<h2>Admin Panel – Manage Users</h2>

<?php if (!empty($message)) : ?>
  <p style="color: green;"><?= $message ?></p>
<?php endif; ?>

<form method="GET" action="admin.php">
  <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($searchTerm) ?>">
  <input type="submit" value="Search">
  <a href="admin.php">Reset</a>
</form>

<br><br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Score (%)</th>
    <th>Actions</th>
  </tr>

  <?php if (count($users) > 0): ?>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td>
          <form method="POST" class="edit-form">
            <input type="text" name="new_name" value="<?= htmlspecialchars($user['name']) ?>" required>
            <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
            <input type="submit" value="Update">
          </form>
        </td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $user['score_percent'] ?? 'Not Taken' ?></td>
        <td>
          <a href="admin.php?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="5">No users found.</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
