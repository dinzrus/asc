<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "barangay".
 *
 * @property integer $id
 * @property string $barangay
 * @property integer $municipality_city_id
 *
 * @property \app\models\MunicipalityCity $municipalityCity
 * @property \app\models\Borrower[] $borrowers
 */
class Barangay extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['barangay', 'municipality_city_id'], 'required'],
            [['municipality_city_id'], 'integer'],
            [['barangay'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barangay';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'barangay' => 'Barangay',
            'municipality_city_id' => 'Municipality City ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalityCity()
    {
        return $this->hasOne(\app\models\MunicipalityCity::className(), ['id' => 'municipality_city_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowers()
    {
        return $this->hasMany(\app\models\Borrower::className(), ['address_barangay_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\BarangayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BarangayQuery(get_called_class());
    }
}
