<?php

namespace app\models;

use Yii;
use \app\models\base\Money as BaseMoney;

/**
 * This is the model class for table "money".
 */
class Money extends BaseMoney
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['money_branch', 'money_unit'], 'integer'],
            [['money_1000', 'money_500', 'money_200', 'money_100', 'money_50', 'money_20', 'money_10', 'money_coin', 'money_bill', 'money_total_amount'], 'number'],
            [['money_date'], 'safe']
        ]);
    }
	
}
