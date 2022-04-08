<?php

namespace src\controllers;

use src\core\Request;

class SiteController extends Controller {

    //Handles the contact page data submission
    public function handleContact(Request $request) {
        $body = $request->getBody();
        return 'Handling contact';
    }

    //Displays the contact page
    public function contact() {
        $params = [];
        return $this->render('contact', $params);
    }

    public function home() {
        $params = ['name' => 'Raphael'];
        return $this->render('home', $params);
    }

}
