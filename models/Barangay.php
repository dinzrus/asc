<?php

namespace app\models;

use Yii;
use \app\models\base\Barangay as BaseBarangay;

/**
 * This is the model class for table "barangay".
 */
class Barangay extends BaseBarangay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['barangay', 'municipality_city_id'], 'required'],
            [['municipality_city_id'], 'integer'],
            [['barangay'], 'string', 'max' => 255]
        ]);
    }
	
}
