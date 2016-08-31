<?php

namespace app\models;

use \app\models\base\Canvasser as BaseCanvasser;

/**
 * This is the model class for table "canvasser".
 */
class Canvasser extends BaseCanvasser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['fname', 'lname', 'middlename', 'age', 'birthdate', 'address', 'branch_id'], 'required'],
            ['middlename', 'unique', 'targetAttribute' => ['lname', 'fname', 'middlename']],
            [['age', 'branch_id'], 'integer'],
            [['birthdate', 'updated_at', 'created_at'], 'safe'],
            [['fname', 'lname', 'middlename', 'address'], 'string', 'max' => 255]
        ]);
    }
	
}
