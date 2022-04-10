<?php 

namespace src\controllers;

use src\core\Request;
use src\models\User;

class AuthController extends Controller {
    
    public function register(Request $request) {

        $user = new User();

        if($request->isPost()) {

            $user->loadData($request->getBody());

            if($user->validate() and $user->register()) {
                return 'SUCCESS';
            }

            return $this->render('register', ['model' => $user]);
        }
        $this->setLayout('auth');

        return $this->render('register', ['model' => $user]);
    }

    public function login(Request $request) {
        if($request->isPost()) {
            
            return 'Handling submitted';
        }
        return $this->render('login');;
    }

}