<?php

namespace app\models;

use Yii;
use \app\models\base\Status as BaseStatus;

/**
 * This is the model class for table "status".
 */
class Status extends BaseStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 255]
        ]);
    }
	
}
