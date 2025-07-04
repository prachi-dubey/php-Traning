<!-- views/quiz-view.php -->
<!DOCTYPE html>
<html>
<head>
  <title>PHP Quiz</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      padding: 20px;
    }
    .quiz-container {
      background: white;
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }
    h2 {
      text-align: center;
      color: #2f3640;
    }
    .question {
      margin-bottom: 20px;
    }
    .question p {
      font-weight: bold;
      color: #192a56;
    }
    label {
      display: block;
      margin: 5px 0;
      cursor: pointer;
    }
    input[type="submit"] {
      background-color: #44bd32;
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }
    input[type="submit"]:hover {
      background-color: #4cd137;
    }
    hr {
      border: 0;
      border-top: 1px solid #eee;
      margin: 25px 0;
    }
  </style>
</head>
<body>

<div class="quiz-container">
  <h2>Welcome <span style="color: #44bd32;"><?= htmlspecialchars($username) ?></span>, Take Your Quiz!</h2>

  <form method="POST" action="/my-first-php/quizPhp/controller/submit.php">
    <?php foreach ($questions as $index => $q): ?>
      <div class="question">
        <p>Q<?= $index + 1 ?>. <?= htmlspecialchars($q['question']) ?></p>
        <?php for ($i = 1; $i <= 4; $i++): ?>
          <label>
            <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $i ?>" required>
            <?= htmlspecialchars($q["option$i"]) ?>
          </label>
        <?php endfor; ?>
      </div>
      <hr>
    <?php endforeach; ?>
    <input type="submit" value="Submit Quiz">
  </form>
</div>

</body>
</html>
