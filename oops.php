<?php
// Interface
interface Adoptable {
    public function getAdoptionDetails();
}

// Trait
trait CanBark {
    public function bark() {
        return "Woof! Woof!";
    }
}

// Base class
class Animal {
    protected $name;
    protected $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getDetails() {
        return "$this->name is $this->age years old.";
    }
}

// Inherited class + implements interface + uses trait
class Dog extends Animal implements Adoptable {
    use CanBark;

    private $breed;

    public function __construct($name, $age, $breed) {
        parent::__construct($name, $age);
        $this->breed = $breed;
    }

    public function getAdoptionDetails() {
        return $this->getDetails() . " Breed: $this->breed";
    }
}

// Object creation
$dog = new Dog("Buddy", 3, "Golden Retriever");
echo $dog->bark() . "\n";  // Trait method
echo "<br/>";
echo $dog->getAdoptionDetails(); // Inherited + interface
?>
