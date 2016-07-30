<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "business_type".
 *
 * @property integer $business_id
 * @property string $business_description
 *
 * @property \app\models\Borrower[] $borrowers
 */
class BusinessType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'business_id' => 'Business ID',
            'business_description' => 'Business Description',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowers()
    {
        return $this->hasMany(\app\models\Borrower::className(), ['business_type' => 'business_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\BusinessTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BusinessTypeQuery(get_called_class());
    }
}
