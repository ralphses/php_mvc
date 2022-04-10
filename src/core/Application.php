<?php

namespace src\core;

use src\controllers\Controller;

class Application {

    public static string $ROOT_PATH;    
    public static Application $app;

    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public function __construct($rootPath) {

        self::$app = $this;
        self::$ROOT_PATH = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,  $this->response);
    }

    public function run() {
        echo $this->router->resolve();
    }

    public function setController($controller) {
        $this->controller = $controller;
    }
    public function getController() {
        return $this->controller;
    }

}