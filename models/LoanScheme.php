<?php

namespace app\models;

use Yii;
use \app\models\base\LoanScheme as BaseLoanScheme;

/**
 * This is the model class for table "loan_scheme".
 */
class LoanScheme extends BaseLoanScheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loanscheme_type', 'daily', 'term', 'gross_day', 'gross_amount', 'interest', 'interest_amount', 'gas', 'doc_percentage', 'doc_stamp', 'mis_percentage', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'vat_interest', 'vat_amount', 'processing_fee'], 'required'],
            [['loanscheme_type', 'term', 'gross_day'], 'integer'],
            [['daily', 'gross_amount', 'interest', 'interest_amount', 'gas', 'doc_percentage', 'doc_stamp', 'mis_percentage', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'vat_interest', 'vat_amount', 'processing_fee'], 'number']
        ]);
    }
	
}
