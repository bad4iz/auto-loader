<?php


use Core\controller\FrontController;
use Slim\App;

include_once "vendor/autoload.php";

// Create and configure Slim app
$config = ['settings' => [
  'displayErrorDetails' => true,
]];

$app = new App($config);


// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($container) {

  $view = new \Slim\Views\Twig('core/view/templates', [
    'cache' => false
  ]);

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');

  $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));
  return $view;

};


/* Инициализация и запуск FrontController */
$front = FrontController::getInstance();
$front->routeInitialize($app);

// Run app
$app->run();
