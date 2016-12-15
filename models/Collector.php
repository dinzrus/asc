<?php

namespace app\models;

use \app\models\base\Collector as BaseCollector;

/**
 * This is the model class for table "collector".
 */
class Collector extends BaseCollector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['fname', 'lname', 'gender', 'branch_id', 'unit_id'], 'required'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'branch_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['fname', 'lname', 'middlename', 'gender'], 'string', 'max' => 255]
        ]);
    }
	
}
