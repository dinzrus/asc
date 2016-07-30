<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "borrower".
 *
 * @property integer $borrower_id
 * @property string $principal_profile_pic
 * @property string $principal_first_name
 * @property string $principal_last_name
 * @property string $principal_middle_name
 * @property string $principal__suffix
 * @property string $principal_birthdate
 * @property integer $principal_age
 * @property string $principal_birthplace
 * @property string $principal_address_street_house
 * @property string $principal_address_barangay
 * @property string $principal_address_province
 * @property string $principal_civil_status
 * @property string $principal_contact_no
 * @property string $principal_ci_date
 * @property string $principal_canvass_date
 * @property string $principal_tin_no
 * @property string $principal_sss_no
 * @property string $principal_ctc_no
 * @property string $principal_license_no
 * @property string $principal_spouse_name
 * @property string $principal_spouse_occupation
 * @property integer $principal_spouse_age
 * @property string $principal_spouse_birthdate
 * @property integer $principal_no_children
 * @property string $principal_child1_name
 * @property string $principal_child2_name
 * @property string $principal_child1_birthdate
 * @property string $principal_child2_birthdate
 * @property integer $principal_child1_age
 * @property integer $principal_child2_age
 * @property string $comaker_profile_pic
 * @property string $comaker_name
 * @property string $comaker_address
 * @property string $comaker_alias
 * @property string $comaker_contact
 * @property string $comaker_occupation
 * @property string $comaker_birthdate
 * @property integer $comaker_age
 * @property string $comaker_relation
 * @property string $business_name
 * @property string $business_address
 * @property integer $business_type
 * @property integer $business_years
 * @property double $business_income
 * @property string $collaterals
 * @property integer $status
 * @property integer $branch
 *
 * @property \app\models\BusinessType $businessType
 */
class Borrower extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['principal_first_name', 'principal_middle_name', 'principal_last_name', 'principal_birthdate', 'principal_age', 'principal_birthplace', 'principal_address_street_house', 'principal_address_barangay', 'principal_address_province', 'principal_civil_status', 'principal_contact_no', 'principal_ci_date', 'principal_canvass_date', 'principal_spouse_name', 'principal_spouse_occupation', 'principal_spouse_age', 'principal_spouse_birthdate', 'principal_no_children', 'comaker_name', 'comaker_address', 'comaker_contact', 'comaker_occupation', 'comaker_birthdate', 'comaker_age', 'comaker_relation', 'business_name', 'business_address', 'business_type', 'business_years', 'business_income', 'collaterals', 'status', 'branch'], 'required'],
            [['principal_birthdate', 'principal_ci_date', 'principal_canvass_date', 'principal_spouse_birthdate', 'principal_child1_birthdate', 'principal_child2_birthdate', 'comaker_birthdate'], 'safe'],
            [['principal_age', 'principal_spouse_age', 'principal_no_children', 'principal_child1_age', 'principal_child2_age', 'comaker_age', 'business_type', 'business_years', 'status', 'branch'], 'integer'],
            [['business_income'], 'number'],
            [['collaterals'], 'string'],
            [['principal_profile_pic', 'principal_first_name', 'principal_last_name', 'principal_middle_name', 'principal__suffix', 'principal_birthplace', 'principal_address_street_house', 'principal_address_barangay', 'principal_address_province', 'principal_civil_status', 'principal_contact_no', 'principal_tin_no', 'principal_sss_no', 'principal_ctc_no', 'principal_license_no', 'principal_spouse_name', 'principal_spouse_occupation', 'principal_child1_name', 'principal_child2_name', 'comaker_profile_pic', 'comaker_name', 'comaker_address', 'comaker_alias', 'comaker_contact', 'comaker_occupation', 'comaker_relation', 'business_name', 'business_address'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'borrower';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrower_id' => 'Borrower ID',
            'principal_profile_pic' => 'Profile Picture',
            'principal_first_name' => 'First Name',
            'principal_last_name' => 'Last Name',
            'principal_middle_name' => 'Middle Name',
            'principal__suffix' => 'Suffix',
            'principal_birthdate' => 'Birthdate',
            'principal_age' => 'Age',
            'principal_birthplace' => 'Place of Birth',
            'principal_address_street_house' => 'Street/House',
            'principal_address_barangay' => 'Barangay',
            'principal_address_province' => 'Province',
            'principal_civil_status' => 'Civil Status',
            'principal_contact_no' => 'Contact No',
            'principal_ci_date' => 'CI Date',
            'principal_canvass_date' => 'Canvass Date',
            'principal_tin_no' => 'TIN No',
            'principal_sss_no' => 'SSS No',
            'principal_ctc_no' => 'CTC No',
            'principal_license_no' => 'Driver License No',
            'principal_spouse_name' => 'Spouse Name',
            'principal_spouse_occupation' => 'Occupation',
            'principal_spouse_age' => 'Age',
            'principal_spouse_birthdate' => 'Date of Birth',
            'principal_no_children' => 'No. Children',
            'principal_child1_name' => 'Name',
            'principal_child2_name' => 'Name',
            'principal_child1_birthdate' => 'Date of Birth',
            'principal_child2_birthdate' => 'Date of Birth',
            'principal_child1_age' => 'Age',
            'principal_child2_age' => 'Age',
            'comaker_profile_pic' => 'Profile Picture',
            'comaker_name' => 'Name',
            'comaker_address' => 'Address',
            'comaker_alias' => 'Alias',
            'comaker_contact' => 'Contact No.',
            'comaker_occupation' => 'Occupation',
            'comaker_birthdate' => 'Date of Birth',
            'comaker_age' => 'Age',
            'comaker_relation' => 'Relation',
            'business_name' => 'Business Name',
            'business_address' => 'Business Address',
            'business_type' => 'Business Type',
            'business_years' => 'Business Years',
            'business_income' => 'Business Income',
            'collaterals' => 'Collaterals',
            'attachments' => '',
            'status' => '',
            'branch' => 'Branch',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessType()
    {
        return $this->hasOne(\app\models\BusinessType::className(), ['business_id' => 'business_type']);
    }
    
    public function getBranch0(){
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\BorrowerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BorrowerQuery(get_called_class());
    }
}
