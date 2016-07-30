<?php

namespace app\models;

use Yii;
use \app\models\base\Log as BaseLog;

/**
 * This is the model class for table "log".
 */
class Log extends BaseLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user'], 'integer'],
            [['log_date'], 'safe'],
            [['log_description'], 'string', 'max' => 255]
        ]);
    }
	
}
