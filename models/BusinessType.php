<?php

namespace app\models;

use Yii;
use \app\models\base\BusinessType as BaseBusinessType;

/**
 * This is the model class for table "business_type".
 */
class BusinessType extends BaseBusinessType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['business_description'], 'string', 'max' => 255]
        ]);
    }
	
}
