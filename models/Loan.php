<?php

namespace app\models;

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
            [['loan_no', 'loan_type', 'borrower', 'unit', 'release_date', 'maturity_date', 'daily', 'term', 'gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'collaterals', 'ci_date', 'ci_officer'], 'required'],
            [['loan_type', 'borrower', 'unit', 'daily', 'term', 'add_days', 'ci_officer'], 'integer'],
            [['release_date', 'maturity_date', 'created_at', 'updated_at', 'ci_date'], 'safe'],
            [['gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['loan_no'], 'string', 'max' => 50],
            [['collaterals', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ]);
    }
	
}
