<?php

namespace app\models;

use \app\models\base\Collectorunit as BaseCollectorunit;

/**
 * This is the model class for table "collectorunit".
 */
class Collectorunit extends BaseCollectorunit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['collector_id', 'unit_id'], 'required'],
            [['collector_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ]);
    }
	
}
