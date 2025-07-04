<?php
require 'config.php';

$successMessage = '';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $imageUrl = trim($_POST['image_url']);
  $price = (float) $_POST['price'];

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['image']['tmp_name'];
    $originalName = basename($_FILES['image']['name']);
    $uploadDir = 'uploads/';

    // Ensure uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Unique file name
    $newFilename = uniqid() . '-' . $originalName;
    $destination = $uploadDir . $newFilename;

    // Move uploaded file
    if (move_uploaded_file($tmpName, $destination)) {
        // Save product info with image path
        $stmt = $pdo->prepare("INSERT INTO products (name, image, price) VALUES (?, ?, ?)");
        $stmt->execute([$name, $destination, $price]);

        $successMessage = "✅ Product added successfully!";
    } else {
      $successMessage = "❌ Failed to move uploaded image.";
      }
    } else {
      $successMessage = "❌ Please select an image file to upload.";
    }

  // $stmt = $pdo->prepare("INSERT INTO products (name, image, price) VALUES (?, ?, ?)");
  // $stmt->execute([$name, $imageUrl, $price]);

  // $successMessage = "✅ Product added successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"],
    .image,
    input[type="number"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #007bff;
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
    .success {
      text-align: center;
      color: green;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div>
    <?php if (!empty($successMessage)): ?>
      <div style="color: green; text-align: center; margin-bottom: 20px;">
        <?= htmlspecialchars($successMessage) ?><br>
        Redirecting to homepage in 5 seconds...
      </div>

      <script>
        setTimeout(() => {
          window.location.href = 'index.php';
        }, 5000); // 10 seconds delay
      </script>
    <?php endif; ?>

    <div class="form-container">
      <h2>Add New Product</h2>
      <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <!-- <input class="image" type="url" name="image_url" placeholder="Image URL" required> -->
        <input class="image" type="file" name="image" accept="image/*" required>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="submit" value="Add Product">
      </form>
    </div>
  </div>
</body>
</html>
