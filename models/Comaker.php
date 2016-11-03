<?php

namespace app\models;

use \app\models\base\Comaker as BaseComaker;

/**
 * This is the model class for table "comaker".
 */
class Comaker extends BaseComaker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['first_name', 'last_name', 'middle_name', 'birthdate', 'age', 'birthplace', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_street_house_no', 'civil_status', 'contact_no', 'gender'], 'required'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'branch_id'], 'integer'],
            [['attachment'], 'string'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'suffix', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'status', 'gender', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ]);
    }
	
}
