<?php

namespace src\models;

use src\core\Model;

class User extends Model{

    public string $name;
    public string $email;
    public string $password;
    public string $confirm_password;

    public function rules() : array {

    return [
        'name' => [self::RULE_REQUIRED],
        'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
    ];
    }


    public function register() {
        echo 'Creating new USer';
    }

    public function name(string $name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }
 
    public function email(string $email) {
        $this->email = $email;
    }

    public function get_email() {
        return $this->email;
    }
    
    public function password(string $password) {
        $this->password = $password;
    }

    public function get_password() {
        return $this->password;
    }
    public function confirm_password(string $confirm_password) {
        $this->confirm_password = $confirm_password;
    }

    public function get_confirm_password() {
        return $this->confirm_password;
    }
    
}
