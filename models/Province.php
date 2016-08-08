<?php

namespace app\models;

use Yii;
use \app\models\base\Province as BaseProvince;

/**
 * This is the model class for table "province".
 */
class Province extends BaseProvince
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['province'], 'string', 'max' => 255]
        ]);
    }
	
}
