<?php

namespace app\models;

use \app\models\base\Ci as BaseCi;

/**
 * This is the model class for table "ci".
 */
class Ci extends BaseCi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['fname', 'lname', 'middlename', 'age', 'birthdate', 'address', 'branch_id'], 'required'],
            [['age', 'branch_id'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['fname', 'lname', 'middlename', 'address'], 'string', 'max' => 255]
        ]);
    }
	
}
