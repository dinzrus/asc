<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "payment".
 *
 * @property integer $pay_id
 * @property string $loan_no
 * @property string $pay_amount
 * @property string $pay_date
 * @property integer $money
 */
class Payment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pay_date'], 'safe'],
            [['money'], 'integer'],
            [['loan_no', 'pay_amount'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pay_id' => 'Pay ID',
            'loan_no' => 'Loan No',
            'pay_amount' => 'Pay Amount',
            'pay_date' => 'Pay Date',
            'money' => 'Money',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PaymentQuery(get_called_class());
    }
}
