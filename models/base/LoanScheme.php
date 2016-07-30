<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "loan_scheme".
 *
 * @property integer $loan_scheme_id
 * @property integer $loanscheme_type
 * @property double $daily
 * @property integer $term
 * @property integer $gross_day
 * @property double $gross_amount
 * @property double $interest
 * @property double $interest_amount
 * @property double $gas
 * @property double $doc_percentage
 * @property double $doc_stamp
 * @property double $mis_percentage
 * @property double $misc
 * @property double $admin_fee
 * @property double $notarial_fee
 * @property double $additional_fee
 * @property double $total_deductions
 * @property double $add_days
 * @property double $add_coll
 * @property double $net_proceeds
 * @property double $penalty
 * @property double $vat_interest
 * @property double $vat_amount
 * @property double $processing_fee
 *
 * @property \app\models\BranchLoanscheme[] $branchLoanschemes
 * @property \app\models\LoanschemeType $loanschemeType
 */
class LoanScheme extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanscheme_type', 'daily', 'term', 'gross_day', 'gross_amount', 'interest', 'interest_amount', 'gas', 'doc_percentage', 'doc_stamp', 'mis_percentage', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'vat_interest', 'vat_amount', 'processing_fee'], 'required'],
            [['loanscheme_type', 'term', 'gross_day'], 'integer'],
            [['daily', 'gross_amount', 'interest', 'interest_amount', 'gas', 'doc_percentage', 'doc_stamp', 'mis_percentage', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'vat_interest', 'vat_amount', 'processing_fee'], 'number']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan_scheme';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loan_scheme_id' => 'Loan Scheme ID',
            'loanscheme_type' => 'Loanscheme Type',
            'daily' => 'Daily',
            'term' => 'Term',
            'gross_day' => 'Gross Day',
            'gross_amount' => 'Gross Amount',
            'interest' => 'Interest',
            'interest_amount' => 'Interest Amount',
            'gas' => 'Gas',
            'doc_percentage' => 'Doc Percentage',
            'doc_stamp' => 'Doc Stamp',
            'mis_percentage' => 'Mis Percentage',
            'misc' => 'Misc',
            'admin_fee' => 'Admin Fee',
            'notarial_fee' => 'Notarial Fee',
            'additional_fee' => 'Additional Fee',
            'total_deductions' => 'Total Deductions',
            'add_days' => 'Add Days',
            'add_coll' => 'Add Coll',
            'net_proceeds' => 'Net Proceeds',
            'penalty' => 'Penalty',
            'vat_interest' => 'Vat Interest',
            'vat_amount' => 'Vat Amount',
            'processing_fee' => 'Processing Fee',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchLoanschemes()
    {
        return $this->hasMany(\app\models\BranchLoanscheme::className(), ['loanscheme' => 'loan_scheme_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanschemeType()
    {
        return $this->hasOne(\app\models\LoanschemeType::className(), ['loanscheme_type_id' => 'loanscheme_type']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\LoanSchemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanSchemeQuery(get_called_class());
    }
}
