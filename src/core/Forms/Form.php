<?php


namespace src\core\Forms;

use src\core\Model;
use src\core\Forms\Field;

class Form {

    private Model $model;

    public function __construct($attributes = [], $model) {
        $this->model = $model; 
        echo $this->begin($attributes);
    }

    public function begin($params = []) {
        if($params) {
            $attribute = '';
            foreach($params as $att => $value) {
                $attribute .= " $att = '$value'";
            }
            return "<form $attribute> \n";
        }
        return '<form action = "" method = "">';
    }

    public function createNewField(string $fieldName, $type, $fieldAttributes = [], $labelAttribute =[], $divAttribute =[]) {
       
        $newField = new Field($this->model, $fieldName, $type, $fieldAttributes, $labelAttribute, $divAttribute);
        echo $newField->createField();
       
    }

    public function createSubmit() {
        return '<input type="submit" name="submit" id="submit">';
    }

    public function end() {
        echo "</form> \n";
    }

    
}

/*
private string $attribute = '';

    public function __construct($params = []) {
        $this->buildHeader($params);

    }

    public function begin() {
        return ($this->attribute === '') ? '<form action = "" method = "">' : "<form $this->attribute >";
    }

    

    public function end() {
        return '</form>';
    }

    private function buildHeader($params) {
        if($params) {
            foreach($params as $att => $value) {
                $this->attribute .= " $att = '$value'";
            }
        }
    }  
    */