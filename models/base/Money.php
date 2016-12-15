<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "money".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property integer $unit_id
 * @property double $money_1000
 * @property double $total_1000
 * @property double $money_500
 * @property double $total_500
 * @property double $money_200
 * @property double $total_200
 * @property double $money_100
 * @property double $total_100
 * @property double $money_50
 * @property double $total_50
 * @property double $money_20
 * @property double $total_20
 * @property double $money_coin
 * @property double $money_bill
 * @property double $money_total_amount
 * @property string $collection_date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Payment[] $payments
 */
class Money extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'unit_id', 'money_1000', 'total_1000', 'money_500', 'total_500', 'money_200', 'total_200', 'money_100', 'total_100', 'money_50', 'total_50', 'money_20', 'total_20', 'money_coin', 'money_total_amount', 'collection_date'], 'required'],
            [['branch_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['money_1000', 'total_1000', 'money_500', 'total_500', 'money_200', 'total_200', 'money_100', 'total_100', 'money_50', 'total_50', 'money_20', 'total_20', 'money_coin', 'money_bill', 'money_total_amount'], 'number'],
            [['collection_date', 'created_at', 'updated_at'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'money';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'unit_id' => 'Unit ID',
            'money_1000' => 'Money 1000',
            'total_1000' => 'Total 1000',
            'money_500' => 'Money 500',
            'total_500' => 'Total 500',
            'money_200' => 'Money 200',
            'total_200' => 'Total 200',
            'money_100' => 'Money 100',
            'total_100' => 'Total 100',
            'money_50' => 'Money 50',
            'total_50' => 'Total 50',
            'money_20' => 'Money 20',
            'total_20' => 'Total 20',
            'money_coin' => 'Money Coin',
            'money_bill' => 'Money Bill',
            'money_total_amount' => 'Money Total Amount',
            'collection_date' => 'Collection Date',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(\app\models\Payment::className(), ['money_id' => 'id']);
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
     * @return \app\models\MoneyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\MoneyQuery(get_called_class());
    }
}
