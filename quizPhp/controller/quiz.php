<?php
// require 'config.php';
require_once __DIR__ . '/../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch questions
$stmt = $pdo->query("SELECT * FROM questions LIMIT 2");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$username = $_SESSION['user']; // pass it to view

// Optional debugging
// echo "<script>console.log(" . json_encode($questions) . ");</script>";

// Include the view
// require './quiz.php';
require_once __DIR__ . '/../views/quiz.php';
?>
