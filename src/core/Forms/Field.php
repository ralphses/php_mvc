<?php

namespace src\core\Forms;

use\src\core\Model;
use\src\models\User;

class Field {

    private string $type;
    private string $fieldAttribute = '';
    private array $fieldAttributes = [];
    private string $label;
    private string $labelAttribute = '';
    private string $divAttribute = '';

    private $model;
    private string $fieldName = '';

    public function __construct(Model $model, string $fieldName, string $type, $attributes = [], $divAttributes = [], $labelAttributes = []) {
        $this->type = $type;
        $this->label = User::fieldLabels()[$fieldName] ?? 'invalid';
       
        $this->model = $model;
        $this->fieldName = $fieldName;
        // echo $this->fieldName;
        $this->fieldAttribute = $this->buildAttributes($this->fieldAttribute, $attributes);
        $this->labelAttribute = $this->buildAttributes($this->labelAttribute, $labelAttributes);
        $this->divAttribute = $this->buildAttributes($this->divAttribute, $divAttributes);
        
    }

    public function createField() {

        $this->fieldAttributes['value'] = $this->model->name;       
        $label = $this->createLabel();
        $err = $this->model->hasErrors($this->fieldName);
        return ($this->divAttribute !== '') ? 
            "<div $this->divAttribute>\n
            $label\n
            <$this->type $this->fieldAttribute>\n
            <div class = 'invalid-feedback'>
            $err
            </div>
            </div>" 
            : 
            "$label\n
            <$this->type $this->fieldAttribute>\n";
    }

    private function createLabel() {
        return ($this->label !== '')? "<label $this->labelAttribute>$this->label</label>" : '';
    }

    private function buildAttributes($thisAttribute, $attributes) {
    
        if($attributes) {
            foreach ($attributes as $key => $value) {
                $thisAttribute .= "$key = '$value'";
            }
        }
        return $thisAttribute;
    }
    

    
}