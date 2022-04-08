<?php

namespace src\core;

class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response) {

        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback; //Stores all the paths and functions for get
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback; //Stores all the paths and functions for post
    }
    
    public function resolve()  {

        $path = $this->request->getPath(); //Get the current path
        $method = $this->request->method(); //Get the current method
        $callback = $this->routes[$method][$path] ?? false; //Get the function to be executed for the given method and for the given path

        //Checks if the callback for the requested path and method is defined
        if(!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderView('404');
           
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        if(is_array($callback)) {
            Application::$app->controller = new $callback[0](); //creates and stores an instance of SiteController class from the class name stored in the array
            $callback[0] = Application::$app->controller;
        }
        //Executes the method from index.php and pass request as parameter
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = []) {
        $layoutContent = $this->layoutContent();  // get the appropraite layout
        $viewContent = $this->renderOnlyView($view, $params); // Get the content of the view that is to be displayed in the layout
        return str_replace('{{content}}', $viewContent, $layoutContent); //Replace the {{content}} placeholder in the layout content with the content of the view content
    }

    //Renders the the layout
    public function layoutContent() {
        $layout = Application::$app->getController()->layout;
        ob_start();
        include_once Application::$ROOT_PATH."../src/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view,  $params = []) {
       
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_PATH."../src/views/$view.php";
        return ob_get_clean();
    }

}