<?php

namespace app\models;

use Yii;
use \app\models\base\Jumpdate as BaseJumpdate;

/**
 * This is the model class for table "jumpdate".
 */
class Jumpdate extends BaseJumpdate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jump_date', 'jump_description'], 'required'],
            [['jump_date'], 'safe'],
            [['jump_description'], 'string', 'max' => 255]
        ]);
    }
	
}
