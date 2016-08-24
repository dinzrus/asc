<?php

namespace app\models;

use \app\models\base\Logtype as BaseLogtype;

/**
 * This is the model class for table "logtype".
 */
class Logtype extends BaseLogtype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at'], 'safe'],
            [['type_description'], 'string', 'max' => 255]
        ]);
    }
	
}
