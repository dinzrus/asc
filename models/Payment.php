<?php

namespace app\models;

use \app\models\base\Payment as BasePayment;

/**
 * This is the model class for table "payment".
 */
class Payment extends BasePayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loan_id', 'pay_amount', 'pay_date', 'money_id'], 'required'],
            [['loan_id', 'money_id'], 'integer'],
            [['pay_amount'], 'number'],
            [['pay_date', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255]
        ]);
    }
	
}
