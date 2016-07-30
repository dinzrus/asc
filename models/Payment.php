<?php

namespace app\models;

use Yii;
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
            [['pay_date'], 'safe'],
            [['money'], 'integer'],
            [['loan_no', 'pay_amount'], 'string', 'max' => 255]
        ]);
    }
	
}
