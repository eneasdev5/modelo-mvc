<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

/* Controllers */
use Mvc\Controllers\HomeController;
use Mvc\Controllers\UsersController;
use Mvc\Controllers\Middleware\JsonBodyParserMiddleware;

// intance app slim
$app = AppFactory::create();

$app->get('/', HomeController::class . ":home");
$app->get('/register-users', UsersController::class . ":register");
$app->post('/register-users-store', UsersController::class . ':register_store');
$app->get('/visualizar', UsersController::class . ':visualizar');
$app->get('/user-perfil/{id}', UsersController::class . ':user_perfil');
$app->post('/login', UsersController::class . ':login')->add(new JsonBodyParserMiddleware());
// $app->get('/user-perfil/{id}', UsersController::class . ':user_perfil');



// errorMiddleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->run();
