<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "borrower_comaker".
 *
 * @property integer $id
 * @property integer $borrower_id
 * @property integer $comaker_id
 */
class BorrowerComaker extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrower_id', 'comaker_id'], 'required'],
            [['borrower_id', 'comaker_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'borrower_comaker';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'borrower_id' => 'Borrower ID',
            'comaker_id' => 'Comaker ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\BorrowerComakerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BorrowerComakerQuery(get_called_class());
    }
}
