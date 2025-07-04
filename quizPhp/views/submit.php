<!DOCTYPE html>
<html>
<head>
  <title>Quiz Results</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      padding: 40px;
      text-align: center;
    }

    .result-box {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    h2 {
      color: #2f3640;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      color: #192a56;
    }

    a {
      text-decoration: none;
      color: white;
      background: #44bd32;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 10px;
      display: inline-block;
      font-weight: bold;
    }

    a:hover {
      background: #4cd137;
    }
  </style>
</head>
<body>

<div class="result-box">
  <h2>Quiz Results</h2>
  <p>Hi <strong><?= htmlspecialchars($username) ?></strong>, you scored <strong><?= $score ?></strong> out of <strong><?= $total ?></strong>.</p>

  <a href="../quiz.php">Try Again</a>
  <a href="../logout.php">Logout</a>
</div>

</body>
</html>
