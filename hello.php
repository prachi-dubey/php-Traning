<?php
echo "Hello, PHP! My first script is working!<br>";

$name = "Radha";
$age = .5;
echo "My name is $name and I am $age years old.<br>";

$fruits = ["Apple", "Banana", "Cherry"];
echo $fruits[1] . "<br>";

$user = ["name" => "Radha", "age" => .5];
echo $user["name"] . "<br>";

function greet($name) {
  return "Hello, $name!";
}
echo greet("$name") . "<br>";

if (isset($_GET['name'])) {
  echo $_GET['name'];
} else {
  echo "No name provided in URL.<br>";
}

echo "The file name is : ". __file__;

$varName = "language";
  $$varName = "PHP";


?>