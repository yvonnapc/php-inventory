<?php

  class Cars
  {
    private $make;
    private $year;
    private $color;
    private $id;

  function __construct($make,$year,$color,$id = NULL)
  {
    $this->make = $make;
    $this->year = $year;
    $this->color = $color;
    $this->id = $id;
  }
  function setMake($new_make)
  {
    $this->make = $make;
  }
  function getMake()
  {
    return $this->make;
  }
  function setYear($new_year)
  {
    $this->year = $year;
  }
  function getYear()
  {
    return $this->year;
  }
  function setColor($new_color)
  {
    $this->color = $color;
  }
  function getColor()
  {
    return $this->color;
  }
  function getId()
  {
    return $this->id;
  }
  function save()
  {
      $GLOBALS['DB']->exec("INSERT INTO cars (make,year,color) VALUES ('{$this->getMake()}',{$this->getYear()},'{$this->getColor()}');");
      $this->id= $GLOBALS['DB']->lastInsertId();
  }
  static function getAll()
  {
    $returned_cars = $GLOBALS['DB']->query("SELECT * FROM cars;");
    $cars = array();
    foreach($returned_cars as $car)
    {
      $make = $car['make'];
      $year = $car['year'];
      $color = $car['color'];
      $id = $car['id'];
      $new_car = new Cars($make, $year, $color, $id);
      array_push($cars, $new_car);
    }
    return $cars;
  }
  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM cars;");
  }
  static function find($search_id)
 {
    $found_car = null;
    $cars = Cars::getAll();
    foreach($cars as $car) {
        $car_id = $car->getId();
        if ($car_id == $search_id) {
          $found_car = $car;
        }
    }
    return $found_car;
 }

}
 ?>
