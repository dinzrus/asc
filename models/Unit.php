<?php

namespace app\models;

use Yii;
use \app\models\base\Unit as BaseUnit;

/**
 * This is the model class for table "unit".
 */
class Unit extends BaseUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['unit_description', 'branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['unit_description'], 'string', 'max' => 255]
        ]);
    }
    
    public static  function idName ($id) {
        $model = self::findOne(['unit_id' => $id]);
        return $model->unit_description;
    }
	
}
