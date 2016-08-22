<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "business_type".
 *
 * @property integer $id
 * @property string $business_description
 *
 * @property \app\models\Business[] $businesses
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
            'id' => 'ID',
            'business_description' => 'Business Description',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinesses()
    {
        return $this->hasMany(\app\models\Business::className(), ['business_type_id' => 'id']);
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
