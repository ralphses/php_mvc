<?php 

namespace src\controllers;

use src\core\Request;

class AuthController extends Controller {
    
    public function register(Request $request) {
        $this->setLayout('auth');
        if($request->isPost()) {
            
            return 'Handling submitted';
        }
        return $this->render('register');
    }

    public function login(Request $request) {
        if($request->isPost()) {
            
            return 'Handling submitted';
        }
        return $this->render('login');;
    }

}