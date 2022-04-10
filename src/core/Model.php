<?php

namespace src\core;

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public array $errors = [];

    abstract public function rules(): array;

    public function loadData($data) {

        foreach($data as $key => $value) { //Iterate over the contents of the the data array
            if(method_exists($this, $key)) {
                $this->$key($value);//Assign the value of this key to the corresponding property
            }
        }
    }

    public function addError(string $attribute, string $errorType, $params = []) {
        $message = $this->errorMessages()[$errorType] ?? '';

        foreach($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages() {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email',
            self::RULE_MIN => 'Minimum length of this field must be {min}',
            self::RULE_MAX => 'Maximum length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }

    //         'name' => [self::RULE_REQUIRED],
    //         'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
    //         'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
    //         'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]

    public function validate() {
        foreach($this->rules() as $attribute => $rules) { //Iterate through all the rules for this model
         $value = $this->{$attribute}; //Take out the attribute and use it to refer to the main attribute of this model
       
            foreach($rules as $rule) { //Iterate through the current rule(s) which can be a string - self::RULE_REQUIRED or array -[self::RULE_MIN, 'min' => 8]
                $ruleName = $rule;  // Get the current rule
                if(!is_string($ruleName)) { //Check whether this rule is an array or a string
                    $ruleName = $rule[0]; //If an array, pick the item at index 0 which is the rule name
                }

                /*
                Make proper validations for each of the rules
                */
                if($ruleName === self::RULE_REQUIRED and !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if($ruleName === self::RULE_EMAIL and !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if($ruleName === self::RULE_MIN and strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if($ruleName === self::RULE_MAX and strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if($ruleName === self::RULE_MATCH and $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }

        } 
        
        return empty($this->errors);
    }

 
}