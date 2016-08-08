<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "province".
 *
 * @property integer $id
 * @property string $province
 *
 * @property \app\models\Borrower[] $borrowers
 * @property \app\models\MunicipalityCity[] $municipalityCities
 */
class Province extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province' => 'Province',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowers()
    {
        return $this->hasMany(\app\models\Borrower::className(), ['address_province_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalityCities()
    {
        return $this->hasMany(\app\models\MunicipalityCity::className(), ['province_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\ProvinceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProvinceQuery(get_called_class());
    }
}
