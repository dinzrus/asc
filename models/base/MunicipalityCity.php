<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "municipality_city".
 *
 * @property integer $id
 * @property string $municipality_city
 * @property integer $province_id
 *
 * @property \app\models\Barangay[] $barangays
 * @property \app\models\Province $province
 */
class MunicipalityCity extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['municipality_city', 'province_id'], 'required'],
            [['province_id'], 'integer'],
            [['municipality_city'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipality_city';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'municipality_city' => 'Municipality City',
            'province_id' => 'Province ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarangays()
    {
        return $this->hasMany(\app\models\Barangay::className(), ['municipality_city_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(\app\models\Province::className(), ['id' => 'province_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\MunicipalityCityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\MunicipalityCityQuery(get_called_class());
    }
}
