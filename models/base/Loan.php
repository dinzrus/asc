<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "loan".
 *
 * @property integer $id
 * @property string $loan_no
 * @property integer $loan_type
 * @property integer $borrower
 * @property integer $unit
 * @property string $release_date
 * @property string $maturity_date
 * @property integer $daily
 * @property integer $term
 * @property double $gross_amount
 * @property double $interest_bdays
 * @property double $gas
 * @property double $doc_stamp
 * @property double $misc
 * @property double $admin_fee
 * @property double $notarial_fee
 * @property double $additional_fee
 * @property double $total_deductions
 * @property integer $add_days
 * @property double $add_coll
 * @property double $net_proceeds
 * @property double $penalty
 * @property string $collaterals
 * @properyt string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $ci_date
 * @property integer $ci_officer
 *
 * @property \app\models\LoanType $loanType
 * @property \app\models\Unit $unit0
 */
class Loan extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_no', 'loan_type', 'borrower', 'unit', 'release_date', 'maturity_date', 'daily', 'term', 'gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'collaterals', 'ci_date', 'ci_officer', 'status'], 'required'],
            [['loan_type', 'borrower', 'unit', 'daily', 'term', 'add_days', 'ci_officer'], 'integer'],
            [['release_date', 'maturity_date', 'created_at', 'updated_at', 'ci_date'], 'safe'],
            [['gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['loan_no'], 'string', 'max' => 50],
            [['collaterals', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_no' => 'Loan No',
            'loan_type' => 'Loan Type',
            'borrower' => 'Borrower',
            'unit' => 'Unit',
            'release_date' => 'Release Date',
            'maturity_date' => 'Maturity Date',
            'daily' => 'Daily',
            'term' => 'Term',
            'gross_amount' => 'Gross Amount',
            'interest_bdays' => 'Interest Bdays',
            'gas' => 'Gas',
            'doc_stamp' => 'Doc Stamp',
            'misc' => 'Misc',
            'admin_fee' => 'Admin Fee',
            'notarial_fee' => 'Notarial Fee',
            'additional_fee' => 'Additional Fee',
            'total_deductions' => 'Total Deductions',
            'add_days' => 'Add Days',
            'add_coll' => 'Add Coll',
            'net_proceeds' => 'Net Proceeds',
            'penalty' => 'Penalty',
            'collaterals' => 'Collaterals',
            'status' => 'Status',
            'ci_date' => 'Ci Date',
            'ci_officer' => 'Ci Officer',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanType()
    {
        return $this->hasOne(\app\models\LoanType::className(), ['loan_id' => 'loan_type']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit0()
    {
        return $this->hasOne(\app\models\Unit::className(), ['unit_id' => 'unit']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\LoanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanQuery(get_called_class());
    }
}
