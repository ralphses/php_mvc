<?php 

require_once '../vendor/autoload.php';

use src\controllers\AuthController;
use src\controllers\SiteController;
use src\core\Application;

//Create a new instance of application and pass the current directory to the constructor as the root path of the application
$app = new Application(dirname(__DIR__));

//Configure all the possible routes for your website

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/register', [AuthController::class, 'register']);

$app->router->post('/register', [AuthController::class, 'register']);

$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/login', [AuthController::class, 'login']);


$app->run();