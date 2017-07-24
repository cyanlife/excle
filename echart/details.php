<?php
header("Content-Type: text/html; charset=UTF-8");
// echo "{$_GET['issueid']}";
// echo count(strlen("http://php.net"))."</br>";
// echo count(1,2);
// class Person
// {
//     private $name = 'Human';

//     public function getName()
//     {
//         return $this->name;
//     }
// }
// class life
// {
//     public $persons = [];

//     public function addPerson(Person $person)
//     {
//         $this->persons[] = $person;
//     }
// }

// $class = new Life();
// $class->addPerson(new Person);
// $class->addPerson(new Person);

// var_dump($class->persons);
/*
 * 类关系 -- 类继承
 */
class Car
{
    public $name;
    public function run()
    {
        return '在行驶中';
    }
}

class Bus extends Car
{
    public function __construct()
    {
        $this->name = '公交车';
    }
}

class Taxi extends Car
{
    public function __construct()
    {
        $this->name = '出租车';
    }
}

// 客户端代码
$line2 = new Bus;
echo $line2->name . $line2->run();