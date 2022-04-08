<?php 

namespace src\controllers;
use src\core\Application;

class Controller {

    public string $layout = 'main';

    public function setLayout($layout) {

        $this->layout = $layout;
    }

    public function render($path, $params =[]) {
        return Application::$app->router->renderView($path, $params);
    }
}