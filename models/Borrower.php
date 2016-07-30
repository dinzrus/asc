<?php

namespace app\models;

use Yii;
use \app\models\base\Borrower as BaseBorrower;

/**
 * This is the model class for table "borrower".
 */
class Borrower extends BaseBorrower
{
    /**
     * @inheritdoc
     */
        
    public $principal_pic;
    public $second_signatory_pic;
    public $attachfiles;
    
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['principal_first_name', 'principal_last_name', 'principal_middle_name', 'principal_birthdate', 'principal_age', 'principal_birthplace', 'principal_address_street_house', 'principal_address_barangay', 'principal_address_province', 'principal_civil_status', 'principal_contact_no', 'principal_ci_date', 'principal_canvass_date', 'principal_spouse_name', 'principal_spouse_occupation', 'principal_spouse_age', 'principal_spouse_birthdate', 'principal_no_children', 'comaker_name', 'comaker_address', 'comaker_contact', 'comaker_occupation', 'comaker_birthdate', 'comaker_age', 'comaker_relation', 'business_name', 'business_address', 'business_type', 'business_years', 'business_income', 'collaterals', 'status', 'branch'], 'required'],
            [['principal_birthdate', 'principal_ci_date', 'principal_canvass_date', 'principal_spouse_birthdate', 'principal_child1_birthdate', 'principal_child2_birthdate', 'comaker_birthdate'], 'safe'],
            [['principal_age', 'principal_spouse_age', 'principal_no_children', 'principal_child1_age', 'principal_child2_age', 'comaker_age', 'business_type', 'business_years', 'status', 'branch'], 'integer'],
            [['business_income'], 'number'],
            [['collaterals'], 'string'],
            [['principal_profile_pic', 'principal_first_name', 'principal_last_name', 'principal_middle_name', 'principal__suffix', 'principal_birthplace', 'principal_address_street_house', 'principal_address_barangay', 'principal_address_province', 'principal_civil_status', 'principal_contact_no', 'principal_tin_no', 'principal_sss_no', 'principal_ctc_no', 'principal_license_no', 'principal_spouse_name', 'principal_spouse_occupation', 'principal_child1_name', 'principal_child2_name', 'comaker_profile_pic', 'comaker_name', 'comaker_address', 'comaker_alias', 'comaker_contact', 'comaker_occupation', 'comaker_relation', 'business_name', 'business_address'], 'string', 'max' => 255],
            [['principal_pic','second_signatory_pic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],    
            [['attachfiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ]);
    }
	
}
