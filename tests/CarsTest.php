<?php
  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Cars.php";

  $server = 'mysql:host=localhost;dbname=inventory_test';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  class CarsTest extends PHPUnit_Framework_TestCase
  {

      protected function tearDown()
      {
        Cars::deleteAll();
      }

      function test_getMake()
      {
          //Arrange
          $make = "Honda";
          $year = 2006;
          $color = "blue";
          $id = 1;
          $test_Cars = new Cars($make,$year,$color,$id);

          //Act
          $result = $test_Cars->getMake();

          //Assert
          $this->assertEquals($make, $result);
      }
      function test_getYear()
      {
          //Arrange
          $make = "Honda";
          $year = 2006;
          $color = "blue";
          $id = 1;
          $test_Cars = new Cars($make,$year,$color,$id);

          //Act
          $result = $test_Cars->getYear();

          //Assert
          $this->assertEquals($year, $result);
      }
      function test_getColor()
      {
          //Arrange
          $make = "Honda";
          $year = 2006;
          $color = "blue";
          $id = 1;
          $test_Cars = new Cars($make,$year,$color,$id);

          //Act
          $result = $test_Cars->getColor();

          //Assert
          $this->assertEquals($color, $result);
      }
      function test_getId()
      {
          //Arrange
          $make = "Honda";
          $year = 2006;
          $color = "blue";
          $id = 123;
          $test_Cars = new Cars($make,$year,$color,$id);

          //Act
          $result = $test_Cars->getId();

          //Assert
          $this->assertEquals(123, $result);
      }
      function test_getAll()
      {
          //Arrange
          $make = "Honda";
          $make2 = "Ford";
          $year = 2006;
          $color = "blue";
          // $id = 1;
          // $id2 = 2;
          $test_Cars = new Cars($make,$year,$color);
          $test_Cars->save();
          $test_Cars2 = new Cars($make2,$year,$color);
          $test_Cars2->save();
          //Act
          $result = Cars::getAll();
          var_dump($result);
          //Assert
          $this->assertEquals([$test_Cars, $test_Cars2], $result);
      }
      function test_find()
      {
          //Arrange
          $make = "Honda";
          $make2 = "Ford";
          $year = 2006;
          $color = "blue";
          $test_Cars = new Cars($make,$year,$color);
          $test_Cars->save();
          $test_Cars2 = new Cars($make2,$year,$color);
          $test_Cars2->save();

          //Act
          $result = Cars::find($test_Cars->getId());

          //Assert
          $this->assertEquals($test_Cars, $result);
      }
    }
 ?>
