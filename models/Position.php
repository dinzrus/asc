<?php

namespace app\models;

use \app\models\base\Position as BasePosition;

/**
 * This is the model class for table "position".
 */
class Position extends BasePosition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['position'], 'required'],
            [['position'], 'string', 'max' => 255]
        ]);
    }
	
}
