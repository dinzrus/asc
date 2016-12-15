<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "payment".
 *
 * @property integer $id
 * @property integer $loan_id
 * @property double $pay_amount
 * @property string $pay_date
 * @property integer $money_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Money $money
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
            [['loan_id', 'pay_amount', 'pay_date', 'money_id'], 'required'],
            [['loan_id', 'money_id', 'created_by', 'updated_by'], 'integer'],
            [['pay_amount'], 'number'],
            [['pay_date', 'created_at', 'updated_at'], 'safe']
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
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'pay_amount' => 'Pay Amount',
            'pay_date' => 'Pay Date',
            'money_id' => 'Money ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoney()
    {
        return $this->hasOne(\app\models\Money::className(), ['id' => 'money_id']);
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
                'value' => new \yii\db\Expression('Now()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => new \yii\db\Expression('Now()'),
            ],
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
