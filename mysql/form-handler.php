<?php
require_once 'config.php';

// 🔄 Handle Update FIRST
if (isset($_POST['update_user'])) {
    $name = trim($_POST['name']);
    $newWeight = (int) $_POST['new_weight'];

    $stmt = $pdo->prepare("UPDATE users SET weight = :weight WHERE name = :name");
    $stmt->execute([
        'weight' => $newWeight,
        'name' => $name
    ]);

    if ($stmt->rowCount() > 0) {
      echo "<p style='color:green'>Weight for '$name' updated successfully.</p>";
    } else {
      echo "<p style='color:red'>No user named '$name' found to update.</p>";
    }

    header("Location: index.php");
    exit();
}

// ❌ Handle Delete NEXT
else if (isset($_POST['delete_user'])) {
    $name = trim($_POST['delete_name']);

    $stmt = $pdo->prepare("DELETE FROM users WHERE name = :name");
    $stmt->execute(['name' => $name]);

    echo "<p style='color:red'>User '$name' deleted successfully.</p>";

    header("Location: index.php");
    exit();
}

// ➕ Handle Insert LAST (default)
else if (isset($_POST["name"], $_POST["weight"])) {
    $name = trim($_POST["name"]);
    $weight = (int) $_POST["weight"];
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone_number"]);

    if (preg_match("/[^A-Za-z'-]/", $name)) {
        die("Invalid name.");
    }

    // $stmt = $pdo->prepare("INSERT INTO users (name, weight, address, phone_number)
    //                        VALUES (:name, :weight, :address, :phone)");

    $stmt = $pdo->prepare("INSERT INTO users (name, weight, address, phone_number)
                           VALUES (:name, :weight, :address, :phone)
                           ON DUPLICATE KEY UPDATE
                             weight = :weight,
                             address = :address,
                             phone_number = :phone");
                             
    $stmt->execute([
        'name' => $name,
        'weight' => $weight,
        'address' => $address,
        'phone' => $phone
    ]);

    echo "<p style='color:blue'>User '$name' added successfully.</p>";

    // Redirect to avoid re-insert on refresh
    header("Location: index.php");
    exit();
}
?>




<?php
/* 
require_once 'config.php'; // Connect to database

// 🔧 Auto-create the `users` table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    weight INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$pdo->exec($sql);

try {
  $alterSql = "
      ALTER TABLE users 
      ADD COLUMN address VARCHAR(255) NOT NULL,
      ADD COLUMN phone_number VARCHAR(20) NOT NULL,
      ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
  ";
  $pdo->exec($alterSql);
} catch (PDOException $e) {
  if (strpos($e->getMessage(), 'Duplicate column') === false) {
      die("Error altering table: " . $e->getMessage());
  }
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    echo "{$user['name']} - {$user['weight']}<br>";
}

////// check ///// 
// $stmt = $pdo->prepare("INSERT INTO users (name, weight, address, phone_number) 
//                        VALUES (:name, :weight, :address, :phone)");

// $stmt->execute([
//     'name' => 'Ravi',
//     'weight' => 65,
//     'address' => 'Bangalore',
//     'phone' => '9990011122'
// ]);

// echo "Inserted successfully.";



// 💬 Handle form submission
if ($_POST["name"] || $_POST["weight"]) {
  $name = trim($_POST["name"]);
  $weight = (int) $_POST["weight"];
  $address = trim($_POST["address"]);
  $phone = trim($_POST["phone_number"]);

  // Optional: basic validation
  if (preg_match("/[^A-Za-z'-]/", $name)) {
      die("Invalid name. Name should contain only letters.");
  }

  echo "Welcome " . htmlspecialchars($name) . "<br />";
  echo "You are " . $weight . " kgs in weight.<br>";
  echo "Address: " . htmlspecialchars($address) . "<br>";
  echo "Phone: " . htmlspecialchars($phone) . "<br>";

  // Insert into DB
  $stmt = $pdo->prepare("INSERT INTO users (name, weight, address, phone_number) VALUES (:name, :weight, :address, :phone)");
  $stmt->execute([
      'name' => $name,
      'weight' => $weight,
      'address' => $address,
      'phone' => $phone
  ]);

  echo "Data inserted successfully.";
  /// Seeing duplicate entries in your table
  // exit();

   // Redirect to avoid re-insert on refresh
   header("Location: " . $_SERVER['PHP_SELF']);
   exit();
}

?>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 40px;
    background-color: #f9f9f9;
  }

  .form-container {
    max-width: 400px;
    margin: auto;
    padding: 25px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  .form-container h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .form-field {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  input[type="text"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #0066cc;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #004d99;
  }
</style>

<div class="form-container">
  <h2>User Information Form</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="form-field">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required />
    </div>
    <div class="form-field">
      <label for="weight">Weight (kg):</label>
      <input type="text" name="weight" id="weight" required />
    </div>
    <div class="form-field">
      <label for="address">Address:</label>
      <input type="text" name="address" id="address" required />
    </div>
    <div class="form-field">
      <label for="phone_number">Phone Number:</label>
      <input type="text" name="phone_number" id="phone_number" required />
    </div>
    <input type="submit" value="Submit" />
  </form>
</div>
*/

