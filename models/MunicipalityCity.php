<?php

namespace app\models;

use Yii;
use \app\models\base\MunicipalityCity as BaseMunicipalityCity;

/**
 * This is the model class for table "municipality_city".
 */
class MunicipalityCity extends BaseMunicipalityCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['municipality_city', 'province_id'], 'required'],
            [['province_id'], 'integer'],
            [['municipality_city'], 'string', 'max' => 255]
        ]);
    }
	
}
