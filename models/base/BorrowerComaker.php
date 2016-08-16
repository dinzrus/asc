<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "borrower_comaker".
 *
 * @property integer $id
 * @property integer $borrower_id
 * @property integer $comaker_id
 * @property string $relationship
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
            [['borrower_id', 'comaker_id', 'relationship'], 'required'],
            [['borrower_id', 'comaker_id'], 'integer'],
            [['relationship'], 'string', 'max' => 255]
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
            'relationship' => 'Relationship to Applicant',
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
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
