<?php

namespace app\models;

use Yii;
use \app\models\base\MarriageStatus as BaseMarriageStatus;

/**
 * This is the model class for table "marriage_status".
 */
class MarriageStatus extends BaseMarriageStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['status'], 'string', 'max' => 255]
        ]);
    }
	
}
