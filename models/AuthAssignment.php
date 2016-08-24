<?php

namespace app\models;

use \app\models\base\AuthAssignment as BaseAuthAssignment;

/**
 * This is the model class for table "auth_assignment".
 */
class AuthAssignment extends BaseAuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['item_name', 'user_id'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 64]
        ]);
    }
    	
}
