<?php
require 'config.php';

try {
  // users table
  $pdo->exec("CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100) UNIQUE,
      password VARCHAR(255) NOT NULL,
      score_percent INT DEFAULT 0,
      INDEX(name)
  ) ENGINE=InnoDB");

  // question table
  $pdo->exec("CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option1 VARCHAR(255) NOT NULL,
    option2 VARCHAR(255) NOT NULL,
    option3 VARCHAR(255) NOT NULL,
    option4 VARCHAR(255) NOT NULL,
    correct_option TINYINT NOT NULL, -- 1 to 4 indicating the correct answer
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB");

  // Create admins table
  $pdo->exec("
  CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    role ENUM('admin', 'user') DEFAULT 'admin'
  ) ENGINE=InnoDB
  ");

  // 2. Check if admin already exists
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE email = ?");
  $stmt->execute(['admin@123.com']);
  $exists = $stmt->fetchColumn();

  if (!$exists) {
    // Optional: hash the password
    $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);

    // 3. Insert admin record
    $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute(['Admin', 'admin@123.com', $hashedPassword]);
    echo "✅ Admin user created.";
  } else {
    echo "ℹ️ Admin already exists.";
  }

} catch (PDOException $e) {
    echo "Setup failed: " . $e->getMessage();
}
?>
