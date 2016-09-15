<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "loanscheme_values".
 *
 * @property integer $id
 * @property integer $loanscheme_id
 * @property double $daily
 * @property integer $term
 * @property double $gross_amt
 * @property double $interest
 * @property double $vat
 * @property double $admin_fee
 * @property double $notary_fee
 * @property double $misc
 * @property double $doc_stamp
 * @property double $gas
 * @property double $total_deductions
 * @property integer $add_days
 * @property double $add_coll
 * @property double $net_proceeds
 * @property double $penalty
 * @property integer $pen_days
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\Loanscheme $loanscheme
 */
class LoanschemeValues extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanscheme_id', 'daily', 'term', 'gross_amt', 'interest', 'vat', 'admin_fee', 'notary_fee', 'misc', 'doc_stamp', 'gas', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'pen_days'], 'required'],
            [['loanscheme_id', 'term', 'add_days', 'pen_days'], 'integer'],
            [['daily', 'gross_amt', 'interest', 'vat', 'admin_fee', 'notary_fee', 'misc', 'doc_stamp', 'gas', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loanscheme_values';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loanscheme_id' => 'Loanscheme ID',
            'daily' => 'Daily',
            'term' => 'Term',
            'gross_amt' => 'Gross Amt',
            'interest' => 'Interest',
            'vat' => 'Vat',
            'admin_fee' => 'Admin Fee',
            'notary_fee' => 'Notary Fee',
            'misc' => 'Misc',
            'doc_stamp' => 'Doc Stamp',
            'gas' => 'Gas',
            'total_deductions' => 'Total Deductions',
            'add_days' => 'Add Days',
            'add_coll' => 'Add Coll',
            'net_proceeds' => 'Net Proceeds',
            'penalty' => 'Penalty',
            'pen_days' => 'Pen Days',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanscheme()
    {
        return $this->hasOne(\app\models\Loanscheme::className(), ['id' => 'loanscheme_id']);
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
     * @return \app\models\LoanschemeValuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanschemeValuesQuery(get_called_class());
    }
}
