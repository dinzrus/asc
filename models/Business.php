<?php

namespace app\models;

use Yii;
use \app\models\base\Business as BaseBusiness;

/**
 * This is the model class for table "business".
 */
class Business extends BaseBusiness
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['business_name', 'business_type_id', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_st_bldng_no', 'business_years', 'permit_no', 'average_weekly_income', 'average_gross_daily_income', 'ownership', 'borrower_id'], 'required'],
            [['business_type_id', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'business_years', 'borrower_id'], 'integer'],
            [['average_weekly_income', 'average_gross_daily_income'], 'number'],
            [['business_name', 'address_st_bldng_no', 'permit_no', 'ownership'], 'string', 'max' => 255]
        ]);
    }
    
    public function getFulladdress() {
        return $this->address_st_bldng_no . ', ' . $this->addressBarangay->barangay . ', ' . $this->addressCityMunicipality->municipality_city . ', ' . $this->addressProvince->province;
    }
	
}
