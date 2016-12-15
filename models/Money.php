<?php

namespace app\models;

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
            [['branch_id', 'unit_id', 'money_1000', 'total_1000', 'money_500', 'total_500', 'money_200', 'total_200', 'money_100', 'total_100', 'money_50', 'total_50', 'money_20', 'total_20', 'money_coin', 'money_total_amount', 'collection_date'], 'required'],
            [['branch_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['money_1000', 'total_1000', 'money_500', 'total_500', 'money_200', 'total_200', 'money_100', 'total_100', 'money_50', 'total_50', 'money_20', 'total_20', 'money_coin', 'money_bill', 'money_total_amount'], 'number'],
            [['collection_date', 'created_at', 'updated_at'], 'safe']
        ]);
    }
	
}
