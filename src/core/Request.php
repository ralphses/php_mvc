<?php 

namespace src\core;

class Request {

    //Get the current url path
    public function getPath() {
        
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        return ($position === false) ? $path : substr($path, 0, $position);
    }

    //Get the current request method either Get or Post
    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']); //converts to lower case
    }

    public function getBody() {

        $body = [];

        if($this->method() === 'get') {
            foreach($_GET as $key => $value) {

                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }

        if($this->method() === 'post') {
            foreach($_POST as $key => $value) {

                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }



        return $body;

    }

    public function isGet() {
        return $this->method() === 'get';
    }

    public function isPost() {
        return $this->method() === 'post';
    }

}