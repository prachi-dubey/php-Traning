<?php
require_once __DIR__ . '/../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$score = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $userAnswers = $_POST['answers'];

    // Get correct answers from DB
    $questionIds = array_keys($userAnswers);
    $placeholders = implode(',', array_fill(0, count($questionIds), '?'));

    $stmt = $pdo->prepare("SELECT id, correct_option FROM questions WHERE id IN ($placeholders)");
    $stmt->execute($questionIds);
    $correctAnswers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // [id => correct_option]

    // Calculate score
    foreach ($userAnswers as $qid => $answer) {
        if (isset($correctAnswers[$qid]) && $correctAnswers[$qid] == $answer) {
            $score++;
        }
    }

    $total = count($correctAnswers);

    $percent = round(($score / $total) * 100);
    $stmt = $pdo->prepare("UPDATE users SET score_percent = :score WHERE id = :id");
    $stmt->execute([
        ':score' => $percent,
        ':id' => $_SESSION['user_id']
    ]);
} else {
    header("Location: controller/quiz.php");
    exit;
}

$username = $_SESSION['user'];

// Load view
require_once __DIR__ . '/../views/submit.php';
?>