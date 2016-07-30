<?php

namespace app\models;

use Yii;
use \app\models\base\Loan as BaseLoan;

/**
 * This is the model class for table "loan".
 */
class Loan extends BaseLoan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loan_no', 'loan_type', 'borrower', 'unit', 'release_date', 'maturity_date', 'daily', 'term', 'gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty'], 'required'],
            [['loan_type', 'borrower', 'unit', 'daily', 'term', 'add_days'], 'integer'],
            [['release_date', 'maturity_date'], 'safe'],
            [['gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['loan_no'], 'string', 'max' => 255]
        ]);
    }
	
}
