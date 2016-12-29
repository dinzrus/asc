<?php

namespace app\models;

use \app\models\base\Employee as BaseEmployee;

/**
 * This is the model class for table "employee".
 */
class Employee extends BaseEmployee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['first_name', 'last_name', 'gender'], 'required'],
            [['date_birth', 'created_at', 'updated_at'], 'safe'],
            [['age', 'created_by', 'updated_by'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'gender'], 'string', 'max' => 255]
        ]);
    }
	
    public function getFullname() {
        return $this->last_name . ', ' . $this->first_name; 
    }
}
