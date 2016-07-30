<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "loan_type".
 *
 * @property integer $loan_id
 * @property string $loan_description
 *
 * @property \app\models\Loan[] $loans
 */
class LoanType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_description'], 'required'],
            [['loan_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loan_id' => 'Loan ID',
            'loan_description' => 'Loan Description',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(\app\models\Loan::className(), ['loan_type' => 'loan_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\LoanTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanTypeQuery(get_called_class());
    }
}
