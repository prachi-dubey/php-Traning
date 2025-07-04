<?php
require 'config.php';

// Array of questions
$questions = [
    [
        'question' => 'What does PHP stand for?',
        'option1' => 'Personal Home Page',
        'option2' => 'Private Hypertext Processor',
        'option3' => 'PHP: Hypertext Preprocessor',
        'option4' => 'Public Hosting Platform',
        'correct_option' => 3
    ],
    [
        'question' => 'Which symbol is used to declare a variable in PHP?',
        'option1' => '%',
        'option2' => '$',
        'option3' => '#',
        'option4' => '@',
        'correct_option' => 2
    ],
    [
        'question' => 'Which function is used to output data in PHP?',
        'option1' => 'echo()',
        'option2' => 'print()',
        'option3' => 'write()',
        'option4' => 'log()',
        'correct_option' => 1
    ],
    [
        'question' => 'Which of the following is a server-side language?',
        'option1' => 'HTML',
        'option2' => 'CSS',
        'option3' => 'PHP',
        'option4' => 'JavaScript',
        'correct_option' => 3
    ],
    [
        'question' => 'Which PHP superglobal is used to collect form data?',
        'option1' => '$_SERVER',
        'option2' => '$_FORM',
        'option3' => '$_POST',
        'option4' => '$_GETPOST',
        'correct_option' => 3
    ],
  [
      'question' => 'How do you start a PHP block?',
      'option1' => '<?php',
      'option2' => '<script>',
      'option3' => '<php>',
      'option4' => '{{php}}',
      'correct_option' => 1
  ],
  [
      'question' => 'What is the correct way to end a PHP statement?',
      'option1' => '.',
      'option2' => ':',
      'option3' => ';',
      'option4' => 'end',
      'correct_option' => 3
  ],
  [
      'question' => 'How do you write a comment in PHP?',
      'option1' => '// comment',
      'option2' => '# comment',
      'option3' => '/* comment */',
      'option4' => 'All of the above',
      'correct_option' => 4
  ],
  [
      'question' => 'Which of the following is used to connect PHP to MySQL?',
      'option1' => 'connect_db()',
      'option2' => 'mysql_connect()',
      'option3' => 'pdo_connect()',
      'option4' => 'db_connect()',
      'correct_option' => 2
  ],
  [
      'question' => 'Which of these is used to include one PHP file in another?',
      'option1' => 'include',
      'option2' => 'add',
      'option3' => 'require_once',
      'option4' => 'Both include and require_once',
      'correct_option' => 4
  ]
];

// Prepare and insert each question
$stmt = $pdo->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option)
                       VALUES (?, ?, ?, ?, ?, ?)");

foreach ($questions as $q) {
    $stmt->execute([
        $q['question'],
        $q['option1'],
        $q['option2'],
        $q['option3'],
        $q['option4'],
        $q['correct_option']
    ]);
}

echo "✅ Hardcoded questions inserted successfully.";
