<?php

namespace app\models;

use \app\models\base\Log as BaseLog;
use Yii;

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
            [['log_type', 'user_id', 'branch_id'], 'integer'],
            [['log_date'], 'safe'],
            [['log_description'], 'string', 'max' => 255]
        ]);
    }
    
    public function logMe($type, $description){
        $this->log_type = $type;
        $this->log_description = $description;
        $this->user_id = Yii::$app->user->identity->id;
        $this->branch_id = Yii::$app->user->identity->branch->branch_id;
        $this->save();
    }
	
}
