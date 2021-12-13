<?php

class Animal
{
    public $name;
}
$dog = new Animal;
$dog->name = "Bobby";
echo $dog->name;
echo "<br>";

$dog->legs = 4;
echo $dog->legs;
echo "<br>";

print_r($dog);
echo "<br>";

abstract class Dog
{
    protected $name = "Doggy";

    public abstract function talk();

    public function run()
    {
        echo "Running...";
    }
}

class Puppey extends Animal
{
    public function talk() {
        echo $this->name . ": Woof...Woof<br>";
    }
}

$pup = new Puppey;
$pup->talk();
