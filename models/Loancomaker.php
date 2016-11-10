<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loan_comaker".
 *
 * @property integer $id
 * @property integer $loan_id
 * @property integer $comaker_id
 */
class Loancomaker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan_comaker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_id', 'comaker_id'], 'required'],
            [['loan_id', 'comaker_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'comaker_id' => 'Comaker ID',
        ];
    }
}
