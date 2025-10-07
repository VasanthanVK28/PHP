<html>
<head>
    <h2>Classes and Objects in PHP</h2>
</head>
<?php
class Student { //Create a class and classname => Student
    public $name;   //access modifier => public property => name
    public $grade;  //access modifier => public property => grade

    public function displayInfo() { //function_Name => displayInfo
        echo "Name: $this->name, Grade: $this->grade";  //$this keyword to access the property
    }
}

$student1 = new Student();//Create an object => $student1 and calling the class => Student
$student1->name = "Vasanthan";  //store the value in name variable
$student1->grade = "A"; //store the value in grade variable             (->) {object operator}
$student1->displayInfo()    //call the function => displayInfo; //Display the output;
?> 

<br><br>

        <h2>Using Constructor in PHP</h2>

<?php
class Students {    //Create a class and classname => Students
    public $names;  //access modifier => public property => names
    public $grades; //access modifier => public property => grades

    public function __construct($names, $grades) {  //constructor function => __construct
        $this->names = $names;  //$names is the parameter passes through constructor
        $this->grades = $grades;
    }   //names is the property of the class
        //grades is the property of the class
    //$this refers to the current object
    //property is used to stored data inside an object.
    public function display_Info() {
        echo "Name: $this->names, Grade: $this->grades";
    }
}

$student2 = new Students("Kumar", "B");//Create an object => $student2 and calling the class => Students
$student2->display_Info();//call the function => displayInfo; //Display the output;
?>
</body>

</br></br>

<h2>Using Inheritance in PHP</h2>

<?php
class Fruit {  //class_Name => Person
    public $fruit_name;   //access modifier => public ; property => name

    public function greet() {   //function_Name => greet
        echo "This is  $this->fruit_name";
    }
}

class Colors extends Fruit {    //child class=> Colors ; inheritance => extends ; parent class => Fruit
    public $color;

    public function showColor() {
        echo "Color: $this->color";
    }
}

$fruits = new Colors();   //Create an object => $student and calling the class => Student
$fruits->fruit_name = "Banana";
$fruits->color = "Blue";
$fruits->greet();       // Hello, I'm Vasanthan
$fruits->showColor();   // Grade: A+
?>

<br><br>

<h2>Using Encapsulation in PHP</h2>

<?php
class Username {    //Create a class and classname => Username
    private $uname; //access modifier => private ; property => uname

    public function setUserName($uname) {
        $this->uname = $uname;  //$uname is the parameter passes through setUserName function
    }

    public function getUserName() { //function_Name => getUserName
        return $this->uname;    //return the value of uname property
        //var_dump($this->uname);
    }
}

$student = new Username();
$student->setUserName("Vasanthan");
echo $student->getUserName();
//var_dump($student);
?>

<br><br>

<h2>Using Polymorphism in PHP</h2>

<?php
class Teacher {
    public function introduce() {   //single function name => introduce to declare . but different 
        echo "I teach students.";
    }
}

class Stu {
    public function introduce() {
        echo "I learn from teachers.";
    }
}

function showIntro($person) {
    $person->introduce();
}

showIntro(new Teacher()); // I teach students.
showIntro(new Stu()); // I learn from teachers.
?>

<br><br>

<h2>Using Abstract Class in PHP</h2>

<?php

abstract class Shape {      // create a class => Shape . use abstract keyword to declare the class as abstract
    abstract public function area();    // abstract method => area
}

class Rectangle extends Shape {  // create a class => Rectangle . use extends keyword to inherit the abstract class Shape
    public $width, $height; // properties => width, height

    public function __construct($w, $h) {   // constructor method to initialize the properties
        $this->width = $w;  // $w is the parameter passes through constructor
        $this->height = $h; // $h is the parameter passes through constructor
    }

    public function area() {
        return $this->width * $this->height;
    }
}

$rect = new Rectangle(10, 5);
echo $rect->area(); // 50
?>

<br><br>

<h2> Traits in PHP</h2>

<?php

trait Logger {      //declare methods
    public function log($msg) { //function_Name => log
        echo "[LOG]: $msg <br>";
            //echo "<br>";
            //echo $msg;
    }
}
//var_dump($msg); // return the value of string

class User {    //class name User
    use Logger; // Injects Logger methods here
}

class Product { //class name Product
    use Logger; // Reuses Logger methods here too
}

$user = new User();     //object creation
$user->log("User created");   // [LOG]: User created

$product = new Product();
$product->log("Product added"); // [LOG]: Product added
?>
</html>