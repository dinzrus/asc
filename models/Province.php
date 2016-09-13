<?php

namespace app\models;

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
            [['province'], 'required'],
            [['province'], 'string', 'max' => 255]
        ]);
    }
	
}
