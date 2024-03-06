<?php
require __DIR__ . '/../vendor/autoload.php';


use Slim\Factory\AppFactory;

/* Controllers */
use Mvc\Controllers\HomeController;
use Mvc\Controllers\UsersController;

// intance app slim
$app = AppFactory::create();

$app->get('/', HomeController::class . ":home");
$app->get('/register-users', UsersController::class . ":register");
$app->post('/register-users-store', UsersController::class . ':register_store');


// errorMiddleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->run();
