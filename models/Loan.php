<?php

namespace app\models;

use \app\models\base\Loan as BaseLoan;

/**
 * This is the model class for table "loan".
 */
class Loan extends BaseLoan {
    const NEEDAPPROVAL = 'NA';
    const APPROVED = 'A';
    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
                [['loan_no', 'loan_type', 'borrower', 'unit', 'release_date', 'maturity_date', 'daily', 'term', 'gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'collaterals', 'ci_date', 'ci_officer'], 'required'],
                [['loan_type', 'borrower', 'unit', 'daily', 'term', 'add_days', 'ci_officer'], 'integer'],
                [['release_date', 'maturity_date', 'created_at', 'updated_at', 'ci_date'], 'safe'],
                [['gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
                [['loan_no'], 'string', 'max' => 50],
                [['collaterals', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ]);
    }

    /**
     * This will return the maturity date of the loan
     */
    public static function getMaturityDate($reldate) {
        return $reldate;
    }
    
    /**
     * 
     * @param type $borrower_id
     * @param type $branch_id
     * @return type string
     */
    public static function generateLoanNumber($borrower_id, $branch_id) {    
        return str_pad($borrower_id, 2, '0', STR_PAD_LEFT) . '-' . str_pad($branch_id, 4, '0', STR_PAD_LEFT) . '-' . date('Ymd');
    }
}
