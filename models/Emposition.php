<?php

namespace app\models;

use \app\models\base\Emposition as BaseEmposition;

/**
 * This is the model class for table "emposition".
 */
class Emposition extends BaseEmposition {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['employee_id', 'branch_id'], 'required'],
            [['employee_id', 'branch_id', 'position_id', 'created_by', 'updated_by'], 'integer'],
            ['position_id', 'unique', 'targetAttribute' => ['employee_id','position_id'], 'message' => 'Employee already assigned!'],
            [['created_at', 'updated_at'], 'safe']
        ]);
    }

}
