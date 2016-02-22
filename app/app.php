<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cars.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app){
      return $app['twig']->render('index.twig');
    });

    $app->get("/cars", function() use($app) {
      return $app['twig']->render('index.twig', array('cars' => Cars::getAll()));
    });

    $app->post("/cars", function() use($app) {
      $car = new Cars($_POST['make'], $_POST['year'], $_POST['color']);
      $car->save();
      return $app['twig']->render('index.twig', array('cars' => Cars::getAll()));
    });
    $app->post("/delete", function() use ($app) {
    Cars::deleteAll();
    return $app['twig']->render('index.twig');
    });
    return $app;


 ?>
