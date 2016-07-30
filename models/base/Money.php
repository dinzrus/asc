<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "money".
 *
 * @property integer $money_id
 * @property integer $money_branch
 * @property integer $money_unit
 * @property double $money_1000
 * @property double $money_500
 * @property double $money_200
 * @property double $money_100
 * @property double $money_50
 * @property double $money_20
 * @property double $money_10
 * @property double $money_coin
 * @property double $money_bill
 * @property double $money_total_amount
 * @property string $money_date
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
            [['money_branch', 'money_unit'], 'integer'],
            [['money_1000', 'money_500', 'money_200', 'money_100', 'money_50', 'money_20', 'money_10', 'money_coin', 'money_bill', 'money_total_amount'], 'number'],
            [['money_date'], 'safe']
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
            'money_id' => 'Money ID',
            'money_branch' => 'Money Branch',
            'money_unit' => 'Money Unit',
            'money_1000' => 'Money 1000',
            'money_500' => 'Money 500',
            'money_200' => 'Money 200',
            'money_100' => 'Money 100',
            'money_50' => 'Money 50',
            'money_20' => 'Money 20',
            'money_10' => 'Money 10',
            'money_coin' => 'Money Coin',
            'money_bill' => 'Money Bill',
            'money_total_amount' => 'Money Total Amount',
            'money_date' => 'Money Date',
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
