<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "business".
 *
 * @property integer $id
 * @property string $business_name
 * @property integer $business_type_id
 * @property integer $address_province_id
 * @property integer $address_city_municipality_id
 * @property integer $address_barangay_id
 * @property string $address_st_bldng_no
 * @property integer $business_years
 * @property string $permit_no
 * @property double $average_weekly_income
 * @property double $average_gross_daily_income
 * @property string $ownership
 * @property integer $borrower_id
 *
 * @property \app\models\Province $addressProvince
 * @property \app\models\MunicipalityCity $addressCityMunicipality
 * @property \app\models\Barangay $addressBarangay
 * @property \app\models\BusinessType $businessType
 */
class Business extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_name', 'business_type_id', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_st_bldng_no', 'business_years', 'permit_no', 'average_weekly_income', 'average_gross_daily_income', 'ownership', 'borrower_id'], 'required'],
            [['business_type_id', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'business_years', 'borrower_id'], 'integer'],
            [['average_weekly_income', 'average_gross_daily_income'], 'number'],
            [['business_name', 'address_st_bldng_no', 'permit_no', 'ownership'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'business_name' => 'Business Name',
            'business_type_id' => 'Business Type',
            'address_province_id' => 'Address Province',
            'address_city_municipality_id' => 'Address City Municipality',
            'address_barangay_id' => 'Address Barangay',
            'address_st_bldng_no' => 'Address St Bldng No',
            'business_years' => 'Business Years',
            'permit_no' => 'Permit No',
            'average_weekly_income' => 'Average Weekly Income',
            'average_gross_daily_income' => 'Average Gross Daily Income',
            'ownership' => 'Ownership',
            'borrower_id' => 'Borrower',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressProvince()
    {
        return $this->hasOne(\app\models\Province::className(), ['id' => 'address_province_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressCityMunicipality()
    {
        return $this->hasOne(\app\models\MunicipalityCity::className(), ['id' => 'address_city_municipality_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressBarangay()
    {
        return $this->hasOne(\app\models\Barangay::className(), ['id' => 'address_barangay_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessType()
    {
        return $this->hasOne(\app\models\BusinessType::className(), ['id' => 'business_type_id']);
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
     * @return \app\models\BusinessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BusinessQuery(get_called_class());
    }
}
