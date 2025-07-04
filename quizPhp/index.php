<?php
session_start();

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     // Not logged in, redirect to login page
//     header("Location: login.php");
//     exit;
// } else {
//     // Logged in, redirect to quiz page
//     header("Location: controller/quiz.php");
//     exit;
// }

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_SESSION['is_admin'])) {
    // Admin
    header("Location: controller/admin.php");
    exit;
} else {
    // Normal user
    header("Location: controller/quiz.php");
    exit;
}
?>